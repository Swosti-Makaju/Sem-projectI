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

if (!$user) {
    echo "User not found!";
    exit();
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- custom css file link  -->
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
            <p>Welcome to your vehicle rental dashboard. Here you can view and manage your bookings, orders, fines, and rental status.</p>
        </section>

        <section id="booking_details">
            <h2>Booking Details</h2>
            <?php
            $user_id = $user['user_id'];
            $bookingQuery = "SELECT * FROM bookings WHERE user_id = ?";
            $stmt = $conn->prepare($bookingQuery);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $bookings = $stmt->get_result();
            ?>
            <table>
                <tr>
                    <th>Booking ID</th>
                    <th>Vehicle</th>
                    <th>Pickup Date</th>
                    <th>Return Date</th>
                </tr>
                <?php while($booking = $bookings->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $booking['booking_id']; ?></td>
                    <td><?php echo htmlspecialchars($booking['vehicle_name']); ?></td>
                    <td><?php echo $booking['pickup_date']; ?></td>
                    <td><?php echo $booking['return_date']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </section>

        <section id="order_page">
            <h2>Order Page</h2>
            <p>List of all your orders will appear here.</p>
            <!-- Fetch and display user orders from database here -->
        </section>

        <section id="fine_page">
            <h2>Fine Page</h2>
            <p>Details about any fines or penalties.</p>
            <!-- Fetch and display user fines from database here -->
        </section>

        <section id="status_page">
            <h2>Status Page</h2>
            <p>Current status of your rentals, including active and completed rentals.</p>
            <!-- Fetch and display rental statuses from database here -->
        </section>
    </main>
</body>
</html>
