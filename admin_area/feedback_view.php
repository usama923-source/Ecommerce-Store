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
            

    $product_query = "SELECT * FROM feedback";
        $product_result = mysqli_query($conn, $product_query);

    $result_count = mysqli_num_rows($product_result);
    if($result_count>0){
      echo "<thead>
      <tr>
      
      
        


        <th style='width:10%'>Id</th>
        <th style='width:20%'>Name</th>
        <th style='width:20%'>Email</th>
        <th style='width:40%'>Message</th>
        
        
      </tr>
    </thead>";

  

       

        while ($product_row = mysqli_fetch_assoc($product_result)) {

            $feedback_id = $product_row['feedback_id'];
            $name = $product_row['name'];
            $email = $product_row['email'];
            $message = $product_row['message'];
            
            ?>
    <tbody>
      <tr>
        
        <td data-th="feedback ID">
          
          
                 <p> <?php echo $feedback_id; ?></p>
           
        </td>
        <td data-th="name">
            <p>
            <?=$name?>
          </p>
        </td>
        
        <td data-th="Email">
         <p>
            <?=$email?>
          </p>
         
               
        </td>
         
        <td class="actions" data-th="">
          <!----update and remove Button------> 
          <p>
            <?=$message?>
          </p>
        </td>
       </form>
      </tr>
    </tbody>
     <?php }}
     else{
      echo "<h2 class='text-center text-danger'> NO Feedback IS AVAILABLE </h2>";
     }
     ?>
    <tfoot>
      
  </table>
  <!----form---->
</div>
</body>
</html>