<nav class="navbar navbar-expand-lg bg-body-tertiary shadow mb-4 rounded">
  <div class="container-fluid px-5">
    <a class="navbar-brand fw-bolder fs-1 logo" href="index.php">MSGM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse px-5" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
       
      <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Categories
  </a>
  <ul class="dropdown-menu">
    <?php
    get_categories();
    ?>
  </ul>
</li>


        <li class="nav-item">
          <a class="nav-link" href="shop.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><b><sup class="text-warning fs-6"><?php cart_item(); ?></sup></b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <i class="text-warning"><b><?php total_price(); ?></b></i></a>
        </li>
      </ul>
      <form class="d-flex w-100 w-auto" role="search" action="search_product.php" method="get">
        <input class="form-control me-2" type="search" name="search_box" placeholder="Search" aria-label="Search"/>
        
        <input type="submit" value="Search" class="btn btn-outline-warning" name="search_product">
      </form>
    </div>
  </div>
</nav> 

<!-----second child---->

