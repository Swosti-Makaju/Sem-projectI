<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = "SELECT * FROM user_form WHERE email = '$email' AND password = '$pass'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'Incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login - ValoRent</title>
   <link rel="stylesheet" href="css/login_form.css">
</head>
<body>
   
<div class="logo">
   <h2>VeloRent</h2>
</div>

<div class="navbar">
   <a class="nav" href="home.html">Home</a>
   <a class="nav" href="about.html">About</a>
   <a class="nav" href="contact.html">Contact</a>
   <a class="nav" href="faq.html">FAQ</a>
   <a class="nav" href="login.html">Login</a>
</div>

<div class="form-container">
   <form action="" method="post">
      <h3>Login Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="Login Now" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register now</a></p>
   </form>
</div>

<div class="footer">
   <p>&copy; 2024 ValoRent. All rights reserved.</p>
   <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
</div>

</body>
</html>
