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
body {
    overflow-x: hidden;
}

</style>

    <title>MSGM</title>
</head>
<body>
     <?php
    include('navbar.php');
    ?>

<!------Third child----->
<div class="bg-light mt-4 mb-5 pb-4 pt-4">
    <h2 class="text-center">MSGM Store</h2>
    <p class="text-center">Communications is at the heart of E-Commerce and community</p>
</div>

<!----forth child---->
<div class="row">
    <!----products---->
   <div class="col-md-1  p-0">

    </div>

    <div class="col-md-10">
        <div class="row">

        <?php
      search_product();
      
        ?>
      
        </div> <!-----row---->
    </div> <!-----col md 10 ----end-->
<!---------------------->

<!-------Side bar-------->

    <div class="col-md-1 p-0">
     
    </div>
</div>


<!----------footer------->
<footer class=" footer bg-warning p-3 text-center mt-5">
  <p>All rights reserved @- designed by Muhammad Usama</p>
</footer>


    </div>
</body>
</html>


