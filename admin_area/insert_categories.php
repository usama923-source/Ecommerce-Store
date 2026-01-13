<?php


if (!isset($_SESSION['admin_username'])) {
    // Redirect to login page if admin not logged in
    header("Location: login.php");
    exit();
}

include('../connect.php');


if(isset($_POST['insert_cat'])){
  $category_title = $_POST['cat_title'];

  $select_query = "select * from categories where category_title = '$category_title'";
  $result_select = mysqli_query($conn, $select_query);
  $number = mysqli_num_rows($result_select);
  if($number>0){
          echo "<div class='alert alert-warning text-center'>This category is already in inserted.</div>";

  }else{


  $insert_query = "insert into categories (category_title) values ('$category_title')";
  $result = mysqli_query($conn, $insert_query);

  if ($result) {
          echo "<div class='alert alert-warning text-center'>Category has been inserted successfully.</div>";

}
  }
}

?>

<h1 class="text-center my-4">Insert Categories</h1>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
  <span class="input-group-text bg-warning" id="basic-addon1"> <i class="fa-solid fa-receipt"></i> @</span>
  <input type="text" class="form-control border border-warning" name="cat_title" placeholder="Insert Category" aria-label="Category" aria-describedby="basic-addon1">
</div>

 <div class="input-group w-10 mb-2">
  
  <input type="submit" class=" btn btn-warning my-2" name="insert_cat" value="Insert Category" aria-label="Category" aria-describedby="basic-addon1">
</div>

</form>