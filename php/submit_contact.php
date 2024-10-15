<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection details
    $servername = "localhost";
    $username = "root"; // Default username for XAMPP/WAMP/MAMP
    $password = ""; // Default password for XAMPP/WAMP/MAMP (usually empty)
    $dbname = "contact_messages";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Execute the statement
    if ($stmt->execute()) {
        echo "<div style='text-align:center; padding:20px; background-color:#d4edda; color:#155724; font-size:18px;'>Your message has been sent successfully. Thank you for contacting us!</div>";
    } else {
        echo "<div style='text-align:center; padding:20px; background-color:#f8d7da; color:#721c24; font-size:18px;'>There was an error sending your message. Please try again later.</div>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
