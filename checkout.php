<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/includes/PHPMailer.php';
require 'phpmailer/includes/SMTP.php';
require 'phpmailer/includes/Exception.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
     <?php
    include('links.php');
    include('functions/common_function.php');
    include ('connect.php'); // or your connection file
    session_start();
    ?>

     <?php
            

    $ip = get_client_ip();
    $total = 0;
    $your_cart = "";


    $cart_query = "SELECT * FROM cart_detail WHERE ip_address = '$ip'";
    $cart_result = mysqli_query($conn, $cart_query);

    $result_count = mysqli_num_rows($cart_result);
    if($result_count>0){      

    while ($cart_row = mysqli_fetch_assoc($cart_result)) {
        $cart_product_id = $cart_row['product_id'];
        $quantity = $cart_row['quantity'];
        $size = $cart_row['size']; 

        $product_query = "SELECT * FROM products WHERE product_id = $cart_product_id";
        $product_result = mysqli_query($conn, $product_query);

        while ($product_row = mysqli_fetch_assoc($product_result)) {
            $price = $product_row['product_price'];
            $product_titles = $product_row['product_title'];
            
            
            $subtotal = $price * $quantity;
            $total += $price * $quantity; 

            $your_cart .= "<li class='list-group-item d-flex justify-content-between lh-condensed'>
                    <div>
                        <h6 class='my-0'>$product_titles</h6>
                        <small class='text-muted'>Quantity: $quantity</small>
                    </div>
                    <span class='text-muted'>PKR $subtotal</span>
                </li>";
        }}}
            ?>

<?php
if (isset($_POST['place_order'])) {
    $ip = get_client_ip();

    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $address    = $_POST['address'];
    $state      = $_POST['state'];
    $zip_code   = $_POST['zip'];

    $total = 0;
    $cart_query = "SELECT * FROM cart_detail WHERE ip_address = '$ip'";
    $cart_result = mysqli_query($conn, $cart_query);

    while ($cart_row = mysqli_fetch_assoc($cart_result)) {
        $product_id = $cart_row['product_id'];
        $quantity   = $cart_row['quantity'];
        $size   = $cart_row['size'];

        $product_query = "SELECT * FROM products WHERE product_id = $product_id";
        $product_result = mysqli_query($conn, $product_query);
        $product_row = mysqli_fetch_assoc($product_result);

        $price = $product_row['product_price'];
        $product_title = $product_row['product_title'];
        $subtotal = $price * $quantity;
        $total += $subtotal;
    }

    // 3. Generate invoice number
    $invoice = 'INV' . mt_rand(10000, 99999);

    // 4. Insert into orders table
    $insert_order = "INSERT INTO orders 
    (ip_address, first_name, last_name, email, phone, address, state, zip_code, invoice_number, total_amount)
    VALUES 
    ('$ip', '$first_name', '$last_name', '$email', '$phone', '$address', '$state', '$zip_code', '$invoice', '$total')";

    $order_result = mysqli_query($conn, $insert_order);
    $order_id = mysqli_insert_id($conn); // Get last inserted order_id

    // 5. Insert each item into order_items table
    $cart_result = mysqli_query($conn, $cart_query); // again
    while ($cart_row = mysqli_fetch_assoc($cart_result)) {
        $product_id = $cart_row['product_id'];
        $quantity   = $cart_row['quantity'];
        $size   = $cart_row['size'];

        $insert_item = "INSERT INTO order_items (order_id, product_id, quantity, size) 
                        VALUES ($order_id, $product_id, $quantity, '$size')";
        mysqli_query($conn, $insert_item);
    }

    // 6. Clear cart
    mysqli_query($conn, "DELETE FROM cart_detail WHERE ip_address = '$ip'");

    // 7. Success message or redirect
    echo "<div class='alert alert-warning text-center'>Thank you, Order Placed Successfully!.</div>";

    $mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';         
    $mail->SMTPAuth   = true;
    $mail->Username   = 'bc220214529mus@vu.edu.pk';  // your Gmail
    $mail->Password   = 'sjnm gkqn byip mzel';   // your app password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('bc220214529mus@vu.edu.pk', 'MSGM Store');
    $mail->addAddress($email, $first_name . ' ' . $last_name);  // from form

    $mail->isHTML(true);
    $mail->Subject = 'Order Confirmation - MSGM';
    $mail->Body    = "
        <h3>Thank you, $first_name!</h3>
        <p>Your order has been received successfully and is being processed.</p>
        <p><b>Invoice No:</b> $invoice</p>
        <p><b>Total Amount:</b> PKR $total</p>
    ";

    $mail->send();
} catch (Exception $e) {
    // Optional: log $mail->ErrorInfo
}

}

?>
   
</head>
<body>
    <div class="container">
   
    <div class="row p-5">
        <div class="col-md-4 order-md-2 mb-4 pb-5 ">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-dark">Your cart</span>
                <span class="badge badge-secondary badge-pill text-dark">
            <?php
                /*Select Cart count*/
                echo $result_count;     
            ?>

                </span>
            </h4>
            <ul class="list-group mb-3 sticky-top">
                <?php echo"$your_cart"?>
                
                <li class="list-group-item d-flex justify-content-between text-warning">
                    <span>Total (PKR)</span>
                    <strong><?php echo"PKR $total"?></strong>
                </li>
            </ul>
            
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" novalidate="" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" required="">
                        <div class="invalid-feedback"> Valid first name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" required="">
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required""">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                </div>
                <div class="mb-3">
                    <label for="email">Phone</label>
                    <input type="number" class="form-control" id="phone" name="phone" min="0" required""">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="">
                    <div class="invalid-feedback"> Please enter your shipping address. </div>
                </div>
                
                <div class="row">
                    
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100 form-control" name="state" id="state" required="">
                            <option value="">Choose...</option>
                            <option value="sindh">Sindh</option>
                            <option value="balochistan">Balochistan</option>
                            <option value="KPK">KPK</option>
                            <option value="Punjab">Punjab</option>
                        </select>
                        <div class="invalid-feedback"> Please provide a valid state. </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="" required="">
                        <div class="invalid-feedback"> Zip code required. </div>
                    </div>
                </div>
                <hr class="mb-4">
                
                <h4 class="mb-3">Payment</h4>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="">
                        <label class="custom-control-label" for="credit">Cash on delivery</label>
                    </div>
                    
                </div>
                
                <hr class="mb-4">
                <a href="cart.php" class="btn btn-danger btn-lg btn-block" name="place_order">Back to Cart</a>
                <button class="btn btn-warning btn-lg btn-block mx-5 px-5" type="submit" name="place_order">Place Order</button>
            </form>
        </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2025 Develop by Muhammad Usama</p>
        
    </footer>
</div>
</body>
</html>