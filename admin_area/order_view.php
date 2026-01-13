<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
      <?php

   if (!isset($_SESSION['admin_username'])) {
    // Redirect to login page if admin not logged in
    header("Location: login.php");
    exit();
}

include('../connect.php');
include('../links.php');
    include('../functions/common_function.php');

    ?>

    
</head>
<body class="cart_page">
    <div class="container">
  <!----form---->
  <table class="table w-100 table-hover table-condensed">
    <!-----Table Heading--->
    <?php
            

    $ip = get_client_ip();
    $total = 0;

    $product_query = "SELECT * FROM orders ORDER BY order_status DESC";
        $product_result = mysqli_query($conn, $product_query);

    $result_count = mysqli_num_rows($product_result);
    if($result_count>0){
      echo "<thead>
      <tr>

        <th>O.ID</th>
        <th>Invoice</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>order Date</th>
        <th>Amount</th>
        <th>Status</th>
        
      </tr>
    </thead>";

  

       

        while ($product_row = mysqli_fetch_assoc($product_result)) {

            $order_id = $product_row['order_id'];
            $ip_address = $product_row['ip_address'];
            $first_name = $product_row['first_name'];
            $last_name = $product_row['last_name'];
            $email = $product_row['email'];
            $phone = $product_row['phone'];
            $address = $product_row['address'];
            $state = $product_row['state'];
            $zip_code = $product_row['zip_code'];
            $invoice_number = $product_row['invoice_number'];
            $total_amount = $product_row['total_amount'];
            $order_status = $product_row['order_status'];
            $order_date = $product_row['order_date'];
            
            ?>
    <tbody>
      <tr>
        <form action="" method="POST">
        <td data-th="Admin ID">
                 <p> <?php echo $order_id; ?></p>
        </td>
        <td data-th="Admin ID">
                 <p> <?php echo $invoice_number; ?></p>
        </td>
        <td data-th="customer name">
              <p> <?php echo $first_name." ".$last_name; ?></p>
        </td>
        <td data-th="email">
              <p> <?php echo $email; ?></p>
        </td>
        <td data-th="Phone">
              <p> <?php echo $phone; ?></p>
        </td>
        <td data-th="Address">
              <p> <?php echo $address; ?></p>
        </td>
        <td data-th="Order date">
              <p> <?php echo $order_date; ?></p>
        </td>
        <td data-th="Admin Username">
              <p> <?php echo $total_amount; ?></p>
        </td>
        <td data-th="order status">     
            <input type="hidden" name="o_id" class="form-control text-center" value="<?=$order_id?>" > 
         <select name="status" id="" class="form-select">
                    <?php
                    if($order_status == 'completed'){
                        echo"<option value='completed'>completed</option>";
                        echo"<option value='pending'>pending</option>";
                    }else{
                        echo"<option value='pending'>pending</option>";
                        echo"<option value='completed'>completed</option>";
                    }
                  
                   
                   ?>
                    
                </select>
        </td>
        
<?php
          
          if (isset($_POST['update_status'])) {
           $o_id = $_POST['o_id'];
            $status = $_POST['status'];
    
        
   
    // 1. Update product info
    $update_query = "UPDATE orders SET order_status='$status' WHERE order_id=$o_id";
    mysqli_query($conn, $update_query);

   
echo "<script>window.location.href = 'index.php?orders';</script>";
}
          
          ?>

        <td class="actions" data-th="">
          <!----update and View Button------> 
          <button type="submit" name="update_status" class="btn btn-warning btn-md" title="Update Status"><i class="fa-solid fa-cart-plus"></i></button>
          <a href="index.php?page=item_view&order_id=<?= $order_id ?>" type="submit" title="View Item"  class="btn btn-danger btn-md"><i class="bi bi-eye"></i></a>
        </td>
</form>
      </tr>
    </tbody>
     <?php }}
     else{
      echo "<h2 class='text-center text-danger'> NO Order IS AVAILABLE </h2>";
     }
     ?>
    <tfoot>
      
  </table>
  <!----form---->
</div>
</body>
</html>