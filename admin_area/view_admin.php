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
    include('../functions/common_function.php inclue');

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

    $product_query = "SELECT * FROM admin";
        $product_result = mysqli_query($conn, $product_query);

    $result_count = mysqli_num_rows($product_result);
    if($result_count>0){
      echo "<thead>
      <tr>
        <th style='width:10%'>Admin Id</th>
        <th style='width:40%'>Admin Username</th>
        <th style='width:40%'>Admin Email</th>
      </tr>
    </thead>";

  

       

        while ($product_row = mysqli_fetch_assoc($product_result)) {

            $admin_id = $product_row['admin_id'];
            $admin_username = $product_row['admin_username'];
            $admin_email = $product_row['admin_email'];
            
            ?>
    <tbody>
      <tr>
        
        <td data-th="Admin ID">
            <form action="" method="POST" enctype="multipart/form-data">
          <div class="row">
            
            <div class="col-sm-3 hidden-xs">
                 <p> <?php echo $admin_id; ?></p>
            </div>
        </td>
        <td data-th="Admin Username">
            <div class="col-sm-9">
              
              <input type="text" name="admin_username" class="form-control text-center" value="<?=$admin_username?>" >
            </div>
          </div>
        </td>
        
        <td data-th="Admin Email">
         
         <input type="hidden" name="ad_id" class="form-control text-center" value="<?=$admin_id?>" >     
         <input type="email" name="admin_email" class="form-control text-center" value="<?=$admin_email?>" >

               
        </td>
          <?php
          
          if (isset($_POST['update_admin'])) {
            $ad_id = $_POST['ad_id'];
    $username = $_POST['admin_username'];
    $email = $_POST['admin_email'];
    
   
    // 1. Update product info
    $update_query = "UPDATE admin SET admin_username='$username',admin_email='$email' WHERE admin_id=$ad_id";
    mysqli_query($conn, $update_query);

   
echo "<script>window.location.href = 'index.php?admin_view';</script>";
          
            }
          
////remove cart
          if (isset($_POST['remove_admin'])) {
            
            $ad_id = $_POST['ad_id'];
        $delete_query = "DELETE FROM admin WHERE admin_id=$ad_id";
        mysqli_query($conn, $delete_query);

        echo "<script>window.location.href = 'index.php?admin_view';</script>";
    }

    
          ?>
        
        <td class="actions" data-th="">
          <!----update and remove Button------> 
          <button type="submit" name="update_admin" class="btn btn-warning btn-md" title="Update Record"><i class="fa-solid fa-cart-plus"></i></button>
          <button type="submit" name="remove_admin" class="btn btn-danger btn-md" title="Delete Record"><i class="fa-solid fa-xmark"></i></button>
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