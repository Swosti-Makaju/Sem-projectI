<?php
session_start();
require_once '../config.php'; // Include database connection

if (isset($_POST['submit'])) {
    // Sanitize input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Prepare SQL statement
    $stmt = mysqli_prepare($conn, "SELECT * FROM Users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, 's', $email); // 's' specifies the variable type => 'string'
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store user information in session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header("Location: ./user_page.php"); // Redirect to home page
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VeloRent</title>
    <link rel="stylesheet" href="../../css/login_form.css">
</head>
<body>

    <div class="logo">
        <h2>VeloRent</h2>
    </div>

    <div class="navbar">
        <a class="nav" href="../../pages/home.html">Home</a>
        <a class="nav" href="../../pages/about.html">About</a>
        <a class="nav" href="../../pages/contact.html">Contact</a>
        <a class="nav" href="../../pages/faq.html">FAQ</a>
        <a class="nav" href="login_form.php">Login</a>
    </div>

    <div class="form-container">
        <form action="" method="post">
            <h3>Login Now</h3>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="submit" name="submit" value="Login Now" class="form-btn">

            <p>Don't have an account? <a href="../register_form.php">Register now</a></p>
            <p><a href="./forgot_password.php">Forgot Password</a></p>
            <p>Login as <a href="../admin/admin_login_form.php">Admin</a></p>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2024 VeloRent. All rights reserved.</p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
    </div>

</body>
</html>
