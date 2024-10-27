<?php
// Database configuration
$conn = mysqli_connect('localhost', 'root', '', 'user_db', 80443);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

return $conn;
