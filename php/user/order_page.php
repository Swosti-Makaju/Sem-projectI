<?php
@include '../config.php';
session_start();

if(!isset($_SESSION['username'])){
   header('location:login_form.php');
   exit();
}

// Fetch user details
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
    <link rel="stylesheet" href="../../css/user_page.css">
</head>
<body>
    <header>
        <h1>Welcome <?php echo htmlspecialchars($user['username']); ?>!</h1>
        <nav>
            <a href="user_dashboard.php">Dashboard</a>
            <a href="booking_details.php">Booking Details</a>
            <a href="order_page.php">Order Page</a>
            <a href="fine_page.php">Fine Page</a>
            <a href="status_page.php">Status Page</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <section id="order_page">
            <h2>Order Page</h2>
            <p>Your order details will be displayed here.</p>
            <!-- Fetch and display user orders from the database here -->
        </section>
    </main>
</body>
</html>
