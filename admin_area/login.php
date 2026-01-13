<?php
include('../connect.php');


session_start(); // Starts session to remember login

if (isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //  Look for the username in the admin table
    $select_query = "Select * from admin WHERE admin_username = '$username'";
    $result = mysqli_query($conn, $select_query);

    if (mysqli_num_rows($result) > 0) {
        // If admin exists, fetch the row
        $admin_data = mysqli_fetch_assoc($result);
        $hashed_password = $admin_data['admin_password']; // Get hashed password from DB

        // Verify entered password against hashed one
        if (password_verify($password, $hashed_password)) {
            // Login success — store session and redirect
            $_SESSION['admin_username'] = $username;
            echo "<script>window.open('index.php?product_view','_self')</script>";
        } else {
            // 
            $error = "<div class='text-danger'>Incorrect password</div>";
        }
    } else {
        // 
        $error = "<div class='text-danger'>Admin not found</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <?php
    include('../links.php');
    ?>

    <style>
    .login_body {
      background-color: #eeeeee;
    }
    .login-box {
      max-width: 400px;
      margin: 60px auto;
      background: #fff;
      padding: 40px 30px;
      border-radius: 10px;
    }
    .login-box h3 {
      font-weight: 600;
      margin-bottom: 30px;
    }
    .form-control:focus {
      border-color: #ffeeba !important;
      box-shadow: none;
    }
    .btn-warning {
      border-radius: 30px;
      padding: 10px 30px;
      font-weight: 600;
    }
   .form-check-input:checked {
    background-color: #ffc107;
    
    }
  </style>

</head>
<body class="login_body">

      <div class="login-box shadow-sm">
    <h3 class="text-center">ACCOUNT LOGIN</h3>
    <form method="post" action="#">
      <div class="mb-3">
        <label for="username" class="form-label text-uppercase fw-bold small">Username</label>
        <input type="text" class="form-control border-warning" id="username" name="username" required />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label text-uppercase fw-bold small">Password</label>
        <div class="input-group">
          <input type="password" class="form-control border-warning" id="password" name="password" required />
         
        </div>
        <?php if (!empty($error)) echo "<div class='text-danger'>$error</div>"; ?>
      </div>

       
       
      

      <div class="d-grid">
        <button type="submit" name="admin_login" class="btn btn-warning">Login</button>
      </div>
    </form>
  </div>

</body>
</html>