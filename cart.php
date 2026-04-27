<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
      <?php
    include('links.php');
    include('functions/common_function.php');
    include ('connect.php'); // or your connection file
    session_start();

    ?>
<style>

.cart_page{
  margin-top: 40px; 

  .cart_img{
  width: 100%;
  height: 80px;
  object-fit: fill;
}
</style>    
    
</head>
<body class="cart_page">
    <div class="container">
  <!----form---->
  <table id="cart" class="table table-hover table-condensed">
    <!-----Table Heading--->
    <?php
            

    $ip = get_client_ip();
    $total = 0;

    $cart_query = "SELECT * FROM cart_detail WHERE ip_address = '$ip'";
    $cart_result = mysqli_query($conn, $cart_query);

    $result_count = mysqli_num_rows($cart_result);
    if($result_count>0){
      echo "<thead>
      <tr>
        <th style='width:50%'>Product</th>
        <th style='width:10%'>Price</th>
        <th style='width:8%'>Quantity</th>
        <th style='width:22%' class='text-center'>Subtotal</th>
        <th style='width:10%'></th>
      </tr>
    </thead>";

    while ($cart_row = mysqli_fetch_assoc($cart_result)) {
        $cart_product_id = $cart_row['product_id'];
        $quantity = $cart_row['quantity'];
        $size = $cart_row['size']; 

        $product_query = "SELECT * FROM products WHERE product_id = $cart_product_id";
        $product_result = mysqli_query($conn, $product_query);

        while ($product_row = mysqli_fetch_assoc($product_result)) {
            $price = $product_row['product_price'];
            $product_titles = $product_row['product_title'];
            $product_image1 = $product_row['product_image1'];
            
            $subtotal = $price * $quantity;
            $total += $price * $quantity; 
        
            ?>
    <tbody>
      <tr>
        
        <td data-th="Product">
          <div class="row">
            
            <div class="col-sm-2 hidden-xs"><img class="cart_img" src="./admin_area/product_images/<?php echo $product_image1?>" alt="..." class="img-responsive" /></div>
            <div class="col-sm-10">
              <h4 class="nomargin"><?php echo $product_titles; ?></h4>
              <p>Size: <?php echo $size; ?></p>
            </div>
          </div>
        </td>
        <td data-th="Price">PKR:  <?php echo $price; ?></td>
        <form action="" method="POST">
        <td data-th="Quantity">
          <input type="hidden" name="p_id" value="<?=$cart_product_id ?>">
          <input type="number" name="qty" class="form-control text-center" value="<?=$quantity?>" min="1" >
        </td>
          <?php
          
          if(isset($_POST['update_cart'])){
            $ip = get_client_ip();

            $p_id = $_POST['p_id'];
            $quantities = $_POST['qty'];
            
            if($quantities>0){
            $update_cart = "update cart_detail set quantity=$quantities where ip_address='$ip' and product_id=$p_id";
            $results = mysqli_query($conn, $update_cart);

            header("Location: cart.php");
            exit();
            }
          }
////remove cart
          if (isset($_POST['remove_cart'])) {
            $ip = get_client_ip();
            $p_id = $_POST['p_id'];
        $delete_query = "DELETE FROM cart_detail WHERE ip_address='$ip' AND product_id=$p_id";
        mysqli_query($conn, $delete_query);
         header("Location: cart.php");
    exit();
    }

    // Redirect to avoid form resubmission
   

          ?>
        <td data-th="Subtotal" class="text-center">PKR: <?php echo $subtotal; ?></td>
        <td class="actions" data-th="">
          <!----update and remove Button------> 
          <button type="submit" name="update_cart" class="btn btn-warning btn-md"><i class="fa-solid fa-cart-plus"></i></button>
          <button type="submit" name="remove_cart" class="btn btn-danger btn-md"><i class="fa-solid fa-xmark"></i></button>
        </td>
       </form>
      </tr>
    </tbody>
     <?php }}}
     else{
      echo "<h2 class='text-center text-danger'> Cart is Empty </h2>";
     }
     ?>
    <tfoot>
      <tr class="visible-xs">
        <td class="text-center"><strong>Total PKR <?php echo $total; ?></strong></td>
      </tr>
      <tr>
        <td><a href="index.php" class="btn btn-danger"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
        <td colspan="2" class="hidden-xs"></td>
        <td class="hidden-xs text-center"><strong>Total PKR <?php echo $total; ?></strong></td>
        <td><a href="checkout.php" class="btn btn-warning btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
      </tr>
    </tfoot>
  </table>
  <!----form---->
</div>
</body>
</html>