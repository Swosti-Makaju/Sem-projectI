<?php
@include './config.php';

// Initialize variables
$error = [];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get user inputs
    $username = $_POST['username']; // Change from 'name' to 'username'
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validate inputs
    if (empty($username) || empty($email) || empty($password) || empty($cpassword)) {
        $error[] = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Invalid email format.';
    } elseif (strlen($password) < 8) {
        $error[] = 'Password must be at least 8 characters long.';
    } elseif ($password !== $cpassword) {
        $error[] = 'Passwords do not match.';
    } else {
        // Check if the email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error[] = 'Email already exists. Please use a different email.';
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO Users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                // Registration successful, redirect to login page or home page
                header("Location: ./user/login_form.php");
                exit();
            } else {
                $error[] = 'Registration failed. Please try again.';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form - VeloRent</title>
   <link rel="stylesheet" href="../css/register_form.css">
</head>
<body>
   
<div class="logo">
    <h2>VeloRent</h2>
</div>

<div class="navbar">
    <a class="nav" href="../pages/home.html">Home</a>
    <a class="nav" href="../pages/about.html">About</a>
    <a class="nav" href="../pages/contact.html">Contact</a>
    <a class="nav" href="../pages/faq.html">FAQ</a>
    <a class="nav" href="login_form.php">Login</a>
</div>

<div class="form-container">
   <form action="" method="post">
      <h3>Register Now</h3>
      <?php
      // Display error messages
      if (!empty($error)) {
         foreach ($error as $err) {
            echo '<span class="error-msg">' . $err . '</span>';
         }
      }
      ?>
      <input type="text" name="username" required placeholder="Enter your username"> <!-- Change 'name' to 'username' -->
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="password" name="cpassword" required placeholder="Confirm your password">
     
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="./user/login_form.php">Login now</a></p>
   </form>
</div>

<div class="footer">
    <p>&copy; 2024 ValoRent. All rights reserved.</p>
    <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
</div>

</body>
</html>
