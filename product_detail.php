<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php
    include('links.php');
    include('functions/common_function.php');
    include ('connect.php'); // or your connection file
           session_start();
    ?>
    
<style>
  .card-img-top {
   
   height: 450px;
   object-fit: fill;
 
    
}
.product-image {
            max-height: 450px;
            object-fit: cover;
            
        }
        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }
        .thumbnail:hover, .thumbnail.active {
            opacity: 1;
        }
        body {
    overflow-x: hidden;
}

</style>

    <title>MSGM</title>
</head>
<body>
    <div class="">
     <?php
     include('navbar.php');
     ?>

<!------Third child----->
<div class="bg-light mt-4 mb-5 pb-4 pt-4">
    <h2 class="text-center">Hidden Store</h2>
    <p class="text-center">Communications is at the heart of E-Commerce and community</p>
</div>

<!----forth child---->
<div class="row">
    <!----products---->
   <?php

    get_client_ip();
   detail_cart();
   view_details();
   
   ?>
       <script>
    function changeImage(event, src) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
            event.target.classList.add('active');
        }
</script>
</div>


<!----------footer------->
<div class="bg-warning p-3 text-center mt-5">
  <p>All rights reserved @- designed by Muhammad Usama</p>
</div>


    </div>
</body>
</html>


