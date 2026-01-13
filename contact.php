<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include('links.php');
    include('functions/common_function.php');
    include ('connect.php');
    
    if (isset($_POST['submit_feedback'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message =$_POST['message'];

    $insert_query = "INSERT INTO feedback (name, email, message) 
                     VALUES ('$name', '$email', '$message')";
    $result = mysqli_query($conn, $insert_query);
    
    echo "<div class='alert alert-warning text-center'>Thank you, <strong>$name</strong>! Your message has been received.</div>";
    
}

    
    
    ?>
    <title>Contact Us</title>

    <style>
    body {
      background-color: #f8f9fa;
    }
    .contact-form {
      background-color: #fff8e1;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 0 40px rgba(255, 193, 7, 0.3);
    }
  </style>
  <?php
    include('navbar.php');
    ?>
</head>
<body>
    <div class="container mt-5 mb-5">
  <div class="text-center mb-4">
    <h2 class="text-warning">Contact Us</h2>
    <p class="text-muted">Have a question, feedback, or concern? Let us know!</p>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="contact-form">
        <form action="" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label text-warning">Name</label>
            <input type="text" name="name" class="form-control border-warning" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label text-warning">Email</label>
            <input type="email" name="email" class="form-control border-warning" required>
          </div>

          <div class="mb-3">
            <label for="message" class="form-label text-warning">Message</label>
            <textarea name="message" class="form-control border-warning" rows="5" required></textarea>
          </div>

          <div class="text-center">
            <button type="submit" name="submit_feedback" class="btn btn-warning px-4">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<footer class="bg-warning p-3 text-center mt-5">
  <p>All rights reserved @- designed by Muhammad Usama</p>
</footer>

</body>
</html>