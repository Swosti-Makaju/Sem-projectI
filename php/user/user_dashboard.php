<?php
@include '../config.php';
session_start();

if(!isset($_SESSION['username'])){
   header('location:login_form.php');
   exit();
}

// Fetch user details from the database
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
    <title>User Dashboard</title>
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
        <section id="dashboard">
            <h2>Dashboard</h2>
            <p>This is your dashboard. You can view and manage your bookings, orders, fines, and more.</p>
        </section>
    </main>
</body>
</html>
