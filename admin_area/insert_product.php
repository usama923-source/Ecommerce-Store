<?php


if (!isset($_SESSION['admin_username'])) {
    // Redirect to login page if admin not logged in
    header("Location: login.php");
    exit();
}

include('../connect.php');

if(isset($_POST['insert_product'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_categories = $_POST['product_categories'];
    //accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];
    //accessing tmp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';
   
    if($product_title =='' or $product_description =='' or $product_categories =='' or $product_image1 =='' or $product_image2 =='' or $product_image3 =='' or $product_price ==''){
        echo "<div id='successMsg' style='color: red;'>Please fill all the available fields</div>";
    echo "<script>
            setTimeout(function() {
                document.getElementById('successMsg').style.display = 'none';
            }, 5000); // hides after 3 seconds
          </script>";
          
    } else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");
    }

    $insert_products = "insert into `products` (product_title,product_description,category_id,product_image1,product_image2,product_image3,product_price,date,status) values('$product_title','$product_description','$product_categories','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status')";
    $result_query = mysqli_query($conn,$insert_products);

    $product_id = mysqli_insert_id($conn); // Get last inserted product

foreach ($_POST['sizes'] as $size) {
    $insert_size = "INSERT INTO size (product_id, size) VALUES ($product_id, '$size')";
    mysqli_query($conn, $insert_size);
}

    if($result_query){

          echo "<div class='alert alert-warning text-center'>Successfully inserted the product.</div>";

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
    include('../links.php');
    ?>
 
    <title>Insert Products</title>
    <style>
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
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">
Insert Products
        </h1>
        <!----form----->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">PRODUCT TITLE</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off" required="Required">
            </div>
            <!-------Description--------->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">PRODUCT DESCRITPTION</label>
                <input type="text" name="product_description" id="product_title" class="form-control" placeholder="Enter Product description" autocomplete="off" required="Required">
            </div>
            
            <!--------Categories--------->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">CATEGORY</label>
                <select name="product_categories" id="" class="form-select">
                    
                   
                   <?php
                    $select_query = "Select * from categories";
                    $result_query = mysqli_query($conn, $select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                    
                </select>
            </div>

            <!-----SIZE--->
            <div class="form-outline mb-4 w-50 m-auto">
                <label>Available Sizes:</label><br>
                <input type="checkbox" name="sizes[]" class="form-check-input mx-2" value="Small"> Small
                <input type="checkbox" name="sizes[]" class="form-check-input mx-2" value="Medium"> Medium
                <input type="checkbox" name="sizes[]" class="form-check-input mx-2" value="Large"> Large
                
            </div>
            
            <!-----Image1--->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">PRODUCT IMAGE 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="Required">
            </div>
             <!-----Image2--->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">PRODUCT IMAGE 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required="Required">
            </div>
             <!-----Image3--->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">PRODUCT IMAGE 2</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required="Required">
            </div>

            <!-----Price--->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">PRODUCT PRICE</label>
                <input type="number" name="product_price" id="product_price" class="form-control" placeholder="Enter Product price" autocomplete="off" required="Required">
            </div>
             <!-----Button--->
            <div class="form-outline mb-4 w-50 m-auto">
               <input type="submit" name="insert_product" class="btn btn-warning btn-lg" value="Insert Product">
            </div>


        </form>


    </div>
</body>
</html>