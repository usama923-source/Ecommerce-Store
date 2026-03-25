<?php
//include('./connect.php');

function get_products(){
    global $conn;
    $select_query = "select * from products where status = 'true' order by rand() limit 0,9";
        $result = mysqli_query($conn,$select_query);
       while( $row = mysqli_fetch_assoc($result)){
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $category_id = $row['category_id'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        
                   echo " <div class='col-md-4 mb-5'>
                <div class='card bg-body-tertiary shadow mb-4 rounded' >
                <a href='product_detail.php?product_id=$product_id'>
                  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                </a>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
    <p class='card-text'>Price:<i class='text-warning'> PKR$product_price/- </i></p>
    
    <div class='d-grid'>
    <a href='product_detail.php?product_id=$product_id' class='btn btn-warning'>View More</a>
    </div>";
    
        echo"
  </div>
</div>
                </div>";             

       }
}

function get_categories(){
    global $conn;

     $cat_query = "SELECT * FROM categories";
    $cat_result = mysqli_query($conn, $cat_query);

    while ($row = mysqli_fetch_assoc($cat_result)) {
      echo '<li><a class="dropdown-item" href="category.php?category_id=' . $row['category_id'] . '">' . htmlspecialchars($row['category_title']) . '</a></li>';
    }
}

// Category page
function category_products(){
      global $conn;

      if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
    $select_query = "select * from `products` where category_id = $category_id and status = 'true'";
        $result = mysqli_query($conn,$select_query);
        $num_rows = mysqli_num_rows($result);
        if($num_rows==0){
          echo"<h2 class='text-center text-danger'>No stock for this category</h2>";
        }

       while( $row = mysqli_fetch_assoc($result)){
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $category_id = $row['category_id'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        
        echo " <div class='col-md-4 mb-5'>
                <div class='card bg-body-tertiary shadow mb-4 rounded'  >
  <a href='product_detail.php?product_id=$product_id'>
                  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                </a>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
    <p class='card-text'>Price:<i class='text-warning'> PKR$product_price/- </i></p>
   <div class='d-grid'>
    <a href='product_detail.php?product_id=$product_id' class='btn btn-warning'>View More</a>
    </div>";
    
        echo"
  </div>
</div>
                </div>"; 

       }
}
}

function display_all(){
    global $conn;
    $select_query = "select * from products where status = 'true' order by rand()";
        $result = mysqli_query($conn,$select_query);
       while( $row = mysqli_fetch_assoc($result)){
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $category_id = $row['category_id'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        
        echo " <div class='col-md-4 mb-5'>
                <div class='card bg-body-tertiary shadow mb-4 rounded' >
  <a href='product_detail.php?product_id=$product_id'>
                  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                </a>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
    <p class='card-text'>Price:<i class='text-warning'> PKR$product_price/- </i></p>
    <div class='d-grid'>
       <a href='product_detail.php?product_id=$product_id' class='btn btn-warning'>View More</a>
    </div>";
    
        echo"
  </div>
</div>
                </div>"; 

       }
}

// Search Product
function search_product(){
  global $conn;
  if(isset($_GET['search_product'])){
    $search_box = $_GET['search_box'];
  
    $search = "select * from products where product_description like '%$search_box%' OR product_title like '%$search_box%' and status = 'true'";
        $result = mysqli_query($conn,$search);

         $num_rows = mysqli_num_rows($result);
        if($num_rows==0){
          echo"<h2 class='text-center text-danger'>No results match. No products found on this category!</h2>";
        }else{
          echo"<h4 class='mb-5 text-success'>No of results: $num_rows</h4>";
        }

       while( $row = mysqli_fetch_assoc($result)){
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $category_id = $row['category_id'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        
        echo "<div class='col-md-4 mb-5'>
                <div class='card bg-body-tertiary shadow mb-4 rounded' >
  <a href='product_detail.php?product_id=$product_id'>
                  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                </a>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
    <p class='card-text'>Price:<i class='text-warning'> PKR$product_price/- </i></p>
    <div class='d-grid'>
        <a href='?add_to_cart=$product_id' class='btn btn-warning'>Add to cart</a>

    </div>";
    
        echo"
  </div>
</div>
                </div>"; 

       }
}
}

function view_details(){
   global $conn;
   if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $select_query = "select * from products where product_id = $product_id";
        $result = mysqli_query($conn,$select_query);
       while( $row = mysqli_fetch_assoc($result)){
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $category_id = $row['category_id'];
        $product_image1 = $row['product_image1'];
        $product_image2 = $row['product_image2'];
        $product_image3 = $row['product_image3'];
        $product_price = $row['product_price'];
        $small_price = $row['product_price'] * 0.9;
        
      echo "
      
      <div class='col-md-2'></div>
      <div class='col-md-4 mb-4 px-5'>
            <img src='./admin_area/product_images/$product_image1' alt='Product' class='img-fluid rounded mb-3 product-image' id='mainImage'>
            <div class='d-flex justify-content-between'>
                <img src='./admin_area/product_images/$product_image1' alt='Thumbnail 1' class='thumbnail rounded active' onclick='changeImage(event, this.src)'>
                <img src='./admin_area/product_images/$product_image2' alt='Thumbnail 2' class='thumbnail rounded' onclick='changeImage(event, this.src)'>
                <img src='./admin_area/product_images/$product_image3' alt='Thumbnail 3' class='thumbnail rounded' onclick='changeImage(event, this.src)'>
                <img src='./admin_area/product_images/$product_image2' alt='Thumbnail 4' class='thumbnail rounded' onclick='changeImage(event, this.src)'>
            </div>
        </div>
        
        <div class='col-md-6'>
            <h2 class='mb-3'>$product_title</h2>
            
            <div class='mb-3'>
            
                <span class='h4 me-2'>PKR: <b class='text-warning'>$product_price/- </b></span>"; 
                
                if (
            isset($_SESSION['cart_message']) &&
            isset($_SESSION['cart_message_id']) &&
            $_SESSION['cart_message_id'] == $product_id
        ) {
            echo "<div id='cartMsg$product_id' class='mt-2 text-danger fw-semibold'>
                    " . $_SESSION['cart_message'] . "
                  </div>
                  <script>
                    setTimeout(function() {
                        let msg = document.getElementById('cartMsg$product_id');
                        if(msg) msg.style.display = 'none';
                    }, 5000);
                  </script>";
                  unset($_SESSION['cart_message']);
        }
                
                echo "</span>
                
                
            </div>
            
            <p class='mb-4'>$product_description.</p>
            <form method='POST'>
            <div class='mb-4'>
                <h5>Size:</h5>
                <div class='btn-group' role='group' aria-label='Size selection'>";

                $size_query = "SELECT size FROM size WHERE product_id = $product_id";
                $size_result = mysqli_query($conn, $size_query);

                if (mysqli_num_rows($size_result) > 0) {
                while($row = mysqli_fetch_assoc($size_result)) {
                  
                $product_size = $row['size'];
    
echo"

                    <input type='radio' class='btn-check' name='size' value='$product_size' id='$product_size' autocomplete='off' checked>
                    <label class='btn btn-outline-warning' for='$product_size'>$product_size</label>";
                }} else{
                  echo "<p class='text-muted'>No size available for this product.</p>";
                } echo"
                   
                </div>
            </div>
            
            <div class='mb-4'>
                <label for='quantity' class='form-label'>Quantity:</label>
                <input type='hidden' class='form-control' name='product_id' id='product_id' value='$product_id' style='width: 80px;'>
                <input type='number' class='form-control' name='qty' id='quantity' value='1' min='1' style='width: 80px;'>
            </div>
             <input type='submit' class=' btn btn-warning btn-lg mb-3 me-2' name='insert_cart' value='Add To Cart' aria-describedby='basic-addon1'>
            
            </form>
            
        </div>
        
        ";

       }
}
}

function detail_cart(){
  

  if(isset($_POST['insert_cart'])){
    global $conn;
    $ip = get_client_ip();
    $product_id = $_POST['product_id'];
    
    $size = isset($_POST['size']) ? $_POST['size'] : null;
    $quantity = $_POST['qty'];
    
    $select_query = "Select * from `cart_detail` where ip_address='$ip' and product_id=$product_id";
    $result = mysqli_query($conn,$select_query);
    $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
          
           $_SESSION['cart_message'] = "This item is already inserted in the cart";
            $_SESSION['cart_message_id'] = $product_id;
            $current_url = $_SERVER['REQUEST_URI'];
            echo "<script>window.location.href='$current_url';</script>";
            exit();
            
        }
        else{
          $insert_query = "insert into cart_detail (product_id,ip_address,size,quantity) values($product_id,'$ip','$size',$quantity)";
          $result = mysqli_query($conn,$insert_query);
          

          $_SESSION['cart_message'] = "item successfully inserted in cart";
            $_SESSION['cart_message_id'] = $product_id;       
        $current_url = $_SERVER['REQUEST_URI'];
            echo "<script>window.location.href='$current_url';</script>";
            exit();

          }
        
  }
}

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


//cart function

// cart item

function cart_item(){
  if(isset($_GET['add_to_cart'])){
    global $conn;
    $ip = get_client_ip();
    $select_query = "Select * from `cart_detail` where ip_address='$ip'";
    $result = mysqli_query($conn,$select_query);
    $num_rows = mysqli_num_rows($result);
  }
        else{
          global $conn;
    $ip = get_client_ip();
    $select_query = "Select * from `cart_detail` where ip_address='$ip'";
    $result = mysqli_query($conn,$select_query);
    $num_rows = mysqli_num_rows($result);
       
        }
        echo $num_rows;

  }

function total_price() {
    global $conn;

    $ip = get_client_ip();
    $total = 0;

    $cart_query = "SELECT * FROM cart_detail WHERE ip_address = '$ip'";
    $cart_result = mysqli_query($conn, $cart_query);

    while ($cart_row = mysqli_fetch_assoc($cart_result)) {
        $product_id = $cart_row['product_id'];
        $quantity = $cart_row['quantity']; 

        $product_query = "SELECT * FROM products WHERE product_id = $product_id";
        $product_result = mysqli_query($conn, $product_query);

        while ($product_row = mysqli_fetch_assoc($product_result)) {
            $price = $product_row['product_price'];
            $total += $price * $quantity; 
        }
    }

    echo $total . " PKR"; // You can also return $total if needed
}

// cart page

?>

