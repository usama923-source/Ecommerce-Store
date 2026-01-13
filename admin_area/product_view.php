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
<style>

.cart_page{


  .cart_img{
  width: 100%;
  height: 80px;
  object-fit: fill;
}
  
        .form-check-input:focus {
  border-color: #ffc107 !important;  /* Bootstrap warning color */
  box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25) !important; 
  background-color: #ffc107; 
}
.form-check-input:checked {
  background-color: #ffc107 !important;  /* yellow fill */
  border-color: #ffc107 !important;      /* yellow border */
}
    </style>
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

    $product_query = "SELECT * FROM products";
        $product_result = mysqli_query($conn, $product_query);

    $result_count = mysqli_num_rows($product_result);
    if($result_count>0){
      echo "<thead>
      <tr>
      
      
        


        <th style='width:40%'>Product</th>
        <th style='width:10%'>Size</th>
        <th style='width:10%'>Category ID</th>
        <th style='width:10%'>Price</th>
        <th style='width:8%'>Status</th>
        
      </tr>
    </thead>";

  

       

        while ($product_row = mysqli_fetch_assoc($product_result)) {

            $product_id = $product_row['product_id'];
            $product_titles = $product_row['product_title'];
            $product_description = $product_row['product_description'];
            
            $category_id = $product_row['category_id'];
            $product_image1 = $product_row['product_image1'];
            $product_image2 = $product_row['product_image2'];
            $product_image3 = $product_row['product_image3'];
            $price = $product_row['product_price'];
            $status = $product_row['status'];
            
          
        
            ?>
    <tbody>
      <tr>
        
        <td data-th="Product">
            <form action="" method="POST" enctype="multipart/form-data">
          <div class="row">
            
            <div class="col-sm-3 hidden-xs"><img class="cart_img" src="../admin_area/product_images/<?php echo $product_image1?>" alt="..." class="img-responsive" />
            <div class="mb-2"></div>
        <img class="cart_img" src="../admin_area/product_images/<?php echo $product_image2?>" alt="..." class="img-responsive" />
        <div class="mb-2"></div>
        <img class="cart_img" src="../admin_area/product_images/<?php echo $product_image3?>" alt="..." class="img-responsive" />
        
        </div>
            <div class="col-sm-9">
              <p>ID: <?php echo $product_id; ?></p>
              <input type="text" name="product_title" class="form-control text-center" value="<?=$product_titles?>" >
              
              <label for="description" class="form-label">Description :</label>
              <textarea type="textarea" name="description" class="form-control text-center" ><?=$product_description?></textarea>
              <label for="description" class="form-label">Images :</label>
              <input type="file" name="product_image1" class="form-control mt-2">
              <input type="file" name="product_image2" class="form-control mt-2">
              <input type="file" name="product_image3" class="form-control mt-2">
            </div>
          </div>
        </td>
        <td data-th="Price">
      <?php
$selected_sizes = []; // ✅ Initialize the array first

$size_query = "SELECT size FROM size WHERE product_id = $product_id";
$size_result = mysqli_query($conn, $size_query);

while ($row = mysqli_fetch_assoc($size_result)) {
    $selected_sizes[] = strtolower(trim($row['size']));
}

$all_sizes = ['small', 'medium', 'large'];

foreach ($all_sizes as $size) {
    $isChecked = in_array($size, $selected_sizes) ? 'checked' : '';
    echo "
              <div class='form-check form-check-inline'>
                  <input class='form-check-input' type='checkbox' name='size[]' id='size_$size' value='$size' $isChecked>
                  <label class='form-check-label' for='size_$size'>" . ucfirst($size) . "</label>
             </div>";
              }
                ?>
              </td>
        
        <td data-th="category">
          <select name="category_id" id="" class="form-select">
                    
                   
                   <?php
                   echo "<option value='$category_id'>$category_id</option>";
                   if($category_id == 1){
                    $select_query = "Select * from categories where category_id > 1";
                    $result_query = mysqli_query($conn, $select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $category_title = $row['category_title'];
                        $category_ids = $row['category_id'];
                        echo "<option value='$category_ids'>$category_ids</option>";
                    }
                  }
                  else if($category_id == 2){
                    $select_query = "Select * from categories where category_id < 2";
                    $result_query = mysqli_query($conn, $select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $category_title = $row['category_title'];
                        $category_ids = $row['category_id'];
                        echo "<option value='$category_ids'>$category_ids</option>";
                    }
                  }
                    ?>
                    
                </select>

               
        </td>
        <td data-th="price">
          <input type="hidden" name="products_id" class="form-control text-center" value="<?=$product_id?>" min="1" >
          <input type="number" name="price" class="form-control text-center" value="<?=$price?>" min="1" >
        </td>
        <td data-th="Subtotal" class="text-center">
             <select name="status" id="" class="form-select">
                    <?php
                    if($status == 'true'){
                        echo"<option value='true'>True</option>";
                        echo"<option value='false'>False</option>";
                    }else{
                   echo"<option value='false'>False</option>";
                   echo"<option value='true'>True</option>";   
                    }
                  
                   
                   ?>
                    
                </select>
        </td>
          <?php
          
          if (isset($_POST['update_product'])) {
            $p_id = $_POST['products_id'];
    $title = $_POST['product_title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    
    $sizes = isset($_POST['size']) ? $_POST['size'] : [];


    $image1 = $_FILES['product_image1']['name'];
$image2 = $_FILES['product_image2']['name'];
$image3 = $_FILES['product_image3']['name'];

$tmp1 = $_FILES['product_image1']['tmp_name'];
$tmp2 = $_FILES['product_image2']['tmp_name'];
$tmp3 = $_FILES['product_image3']['tmp_name'];

    // 1. Update product info
    $update_query = "UPDATE products SET product_title='$title',product_description='$description',category_id='$category_id', product_price='$price', status='$status' WHERE product_id=$p_id";
    mysqli_query($conn, $update_query);

    // 2. Remove old sizes
    $delete_sizes = "DELETE FROM size WHERE product_id=$p_id";
    mysqli_query($conn, $delete_sizes);

    // 3. Insert new selected sizes
    foreach ($sizes as $size) {
        $size = strtolower(trim($size));
        $insert_size = "INSERT INTO size (product_id, size) VALUES ($p_id, '$size')";
        mysqli_query($conn, $insert_size);
    }

    if(!empty($image1)) {
    move_uploaded_file($tmp1, "./product_images/$image1");
    $update_query = "UPDATE products SET product_image1='$image1' WHERE product_id=$p_id";
    mysqli_query($conn, $update_query);
}
if(!empty($image2)) {
    move_uploaded_file($tmp2, "./product_images/$image2");
    $update_query = "UPDATE products SET product_image2='$image2' WHERE product_id=$p_id";
    mysqli_query($conn, $update_query);
}
if(!empty($image3)) {
    move_uploaded_file($tmp3, "./product_images/$image3");
    $update_query = "UPDATE products SET product_image3='$image3' WHERE product_id=$p_id";
    mysqli_query($conn, $update_query);
}
echo "<script>window.location.href = 'index.php?product_view';</script>";
          
            }
          
////remove cart
          if (isset($_POST['remove_product'])) {
            
            $p_id = $_POST['products_id'];
        $delete_query = "DELETE FROM products WHERE product_id=$p_id";
        mysqli_query($conn, $delete_query);

        $delete_sizes = "DELETE FROM size WHERE product_id=$p_id";
    mysqli_query($conn, $delete_sizes);

        echo "<script>window.location.href = 'index.php?product_view';</script>";
    }

    // Redirect to avoid form resubmission
   

          ?>
        
        <td class="actions" data-th="">
          <!----update and remove Button------> 
          <button type="submit" name="update_product" class="btn btn-warning btn-md" title="Update Record"><i class="fa-solid fa-cart-plus"></i></button>
          <button type="submit" name="remove_product" class="btn btn-danger btn-md" title="Delete Record"><i class="fa-solid fa-xmark"></i></button>
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