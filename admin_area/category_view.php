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
  <table id="cart" class="table table-hover table-condensed">
    <!-----Table Heading--->
    <?php
            

    $ip = get_client_ip();
    $total = 0;

    $product_query = "SELECT * FROM categories";
        $product_result = mysqli_query($conn, $product_query);

    $result_count = mysqli_num_rows($product_result);
    if($result_count>0){
      echo "<thead>
      <tr>
        <th style='width:30%'>Category Id</th>
        <th style='width:30%'>Category Title</th>
      </tr>
    </thead>";

  

       

        while ($product_row = mysqli_fetch_assoc($product_result)) {

            $category_id = $product_row['category_id'];
            $category_name = $product_row['category_title'];
            
            ?>
    <tbody>
      <tr>
        
        <td data-th="category id">
            <form action="" method="POST" enctype="multipart/form-data">
          <div class="row">
            
            <div class="col-sm-3 hidden-xs">
                 <p><?php echo $category_id; ?></p>
            </div>
        </td>
        <td data-th="Admin Username">
            <div class="col-sm-9">
         <input type="hidden" name="cat_id" class="form-control text-center" value="<?=$category_id?>" >
            <input type="text" name="category_name" class="form-control text-center" value="<?=$category_name?>" >
            </div>
          </div>
        </td>
        
       
          <?php
          
          if (isset($_POST['update_category'])) {
            $cat_id = $_POST['cat_id'];
    $cat_title = $_POST['category_name'];
    
   
    // 1. Update product info
    $update_query = "UPDATE categories SET category_title='$cat_title' WHERE category_id=$cat_id";
    mysqli_query($conn, $update_query);

   
echo "<script>window.location.href = 'index.php?category_view';</script>";
          
            }
          
////remove cart
          if (isset($_POST['remove_category'])) {
            
            $cat_id = $_POST['cat_id'];
        $delete_query = "DELETE FROM categories WHERE category_id=$cat_id";
        mysqli_query($conn, $delete_query);

        echo "<script>window.location.href = 'index.php?category_view';</script>";
    }

    
          ?>
        
        <td class="actions" data-th="">
          <!----update and remove Button------> 
          <button type="submit" name="update_category" class="btn btn-warning btn-md"><i class="fa-solid fa-cart-plus"></i></button>
          <button type="submit" name="remove_category" class="btn btn-danger btn-md"><i class="fa-solid fa-xmark"></i></button>
        </td>
       </form>
      </tr>
    </tbody>
     <?php }}
     else{
      echo "<h2 class='text-center text-danger'> NO PRODUCT IS AVAILABLE </h2>";
     }
     ?>
    <tfoot>
      
  </table>
  <!----form---->
</div>
</body>
</html>