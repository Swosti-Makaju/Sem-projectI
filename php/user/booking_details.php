<?php
@include '../config.php';
session_start();

if(!isset($_SESSION['username'])){
   header('location:login_form.php');
   exit();
}

// Fetch user details and booking data
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$user_id = $user['user_id'];
$bookingQuery = "SELECT * FROM bookings WHERE user_id = ?";
$stmt = $conn->prepare($bookingQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$bookings = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
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
        <section id="booking_details">
            <h2>Booking Details</h2>
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
    </main>
</body>
</html>
