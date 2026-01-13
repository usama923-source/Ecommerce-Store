<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    session_start();

if (!isset($_SESSION['admin_username'])) {
    // Redirect to login page if admin not logged in
    header("Location: login.php");
    exit();
}
    include('../links.php');
    ?>


     <title>Admin Dashboard</title>
</head>

<body>
    <div class="container-fluid p-0">
        <!-------------First Navbar------->
            <?php
    include('./admin_navbar.php');
    ?>
        

<div class="container my-5">
    <?php
    if(isset($_GET['insert_category'])){
        include('insert_categories.php');
    }
    if(isset($_GET['insert_brand'])){
        include('insert_brands.php');
    }
    if(isset($_GET['insert_product'])){
        include('insert_product.php');
    }
    if(isset($_GET['insert_admin'])){
        include('insert_admin.php');
    }
    if(isset($_GET['product_view'])){
        include('product_view.php');
    }
    if(isset($_GET['admin_view'])){
        include('view_admin.php');
    }
    if(isset($_GET['category_view'])){
        include('category_view.php');
    }
    if(isset($_GET['orders'])){
        include('order_view.php');
    }
    if(isset($_GET['feedback'])){
        include('feedback_view.php');
    }
    if (isset($_GET['page'])) {
    $page = $_GET['page'];

    if ($page == 'item_view') {
        include('item_view.php');
    }
    
    // add other pages as needed
}

    
    ?>
</div>


    </div>
</body>
</html>