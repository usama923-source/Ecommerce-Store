<?php


if (!isset($_SESSION['admin_username'])) {
    // Redirect to login page if admin not logged in
    header("Location: login.php");
    exit();
}

include('../connect.php');

if(isset($_POST['insert_admin'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
   
   
    if($username =='' or $email =='' or $password =='' or $confirm_password ==''){
        echo "<div id='successMsg' style='color: red;'>Please fill all the available fields</div>";
    echo "<script>
            setTimeout(function() {
                document.getElementById('successMsg').style.display = 'none';
            }, 5000); // hides after 5 seconds
          </script>";
          return;
          
    }
    if ($password !== $confirm_password) {
        echo "<div id='successMsg' style='color: red;'>Password do not match with confirm password</div>";
    echo "<script>
            setTimeout(function() {
                document.getElementById('successMsg').style.display = 'none';
            }, 5000); // hides after 5 seconds
          </script>";
          return;
    }
     
         $hashed = password_hash($password, PASSWORD_DEFAULT);
    

    $insert_admin = "insert into `admin` (admin_username,admin_email,admin_password) values('$username','$email','$hashed')";
    $result_query = mysqli_query($conn,$insert_admin);

    if($result_query){
          echo "<div class='alert alert-warning text-center'>Successfully inserted the admin.</div>";
    }
    else{
          echo "<div class='alert alert-warning text-center'>Failed to Admin.</div>";
          
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
 
    <title>Insert Admin</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">
INSERT NEW ADMIN  
        </h1>
        <!----form----->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter  Username" autocomplete="off" required="Required">
            </div>
            <!-------email--------->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" autocomplete="off" required="Required">
            </div>
            <!-----password--->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" autocomplete="off" required="Required">
            </div>
            <!------confirm password----->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="confirm_password" class="form-label">Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" autocomplete="off" required="Required">
            </div>
           
                        <!-----Button--->
            <div class="form-outline mb-4 w-50 m-auto">
               <input type="submit" name="insert_admin" class="btn btn-warning btn-lg" value="Insert">
            </div>


        </form>


    </div>
</body>
</html>