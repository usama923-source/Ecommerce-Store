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

if (!isset($_GET['order_id'])) {
    echo "Order ID is missing.";
    exit;
}
    ?>

    
</head>
<body class="cart_page">
    <div class="container">
  <!----form---->
  <table class="table w-100 table-hover table-condensed">
    <!-----Table Heading--->
    <?php
            
    $order_id = $_GET['order_id'];
            
    $query = "SELECT oi.*, p.product_title, p.product_image1 
          FROM order_items oi
          JOIN products p ON oi.product_id = p.product_id
          WHERE oi.order_id = $order_id";

$result = mysqli_query($conn, $query);
$result_count = mysqli_num_rows($result);
    if($result_count>0){
      echo "<thead>
      <tr>

        <th style='width:10%'>Item ID</th>
        <th style='width:40%'>Product Title</th>
        <th style='width:20%'>Product Image</th>
        <th style='width:15%'>Quantity</th>
        <th style='width:15%'>size</th>
        
      </tr>
    </thead>";

  

       

        while  ($row = mysqli_fetch_assoc($result)) {

            $item_id = $row['item_id'];
            $product_title = $row['product_title'];
            $image = $row['product_image1'];
            $quantity = $row['quantity'];
            $size = $row['size'];
            
            
            ?>
    <tbody>
      <tr>
        
        <td data-th="Item id">
                 <p> <?php echo $item_id; ?></p>
        </td>
        <td data-th="Product Title">
                 <p> <?php echo $product_title; ?></p>
        </td>
        <td data-th="Product Image">
              <img class=" w-25" src="../admin_area/product_images/<?php echo $image?>" alt="..." class="img-responsive" />
        </td>
        
        <td data-th="Quantity">
              <p> <?php echo $quantity; ?></p>
        </td>
        <td data-th="Size">
              <p> <?php echo $size; ?></p>
        </td>
        <td class="actions" data-th="">
          <!----update and View Button------> 
          <a href="index.php?orders" type="submit"  class="btn btn-danger btn-md" title="Back to Orders"><i class="bi bi-arrow-left"></i></a>
        </td>

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