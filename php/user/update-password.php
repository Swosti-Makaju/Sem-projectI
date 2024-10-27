<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $password = $_POST['password'];

    // Validate token and email
    $conn = require __DIR__ . "/config.php";
    $token_hash = hash("sha256", $token);

    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ? AND reset_token_hash = ? AND reset_token_expires_at > NOW()");
    $stmt->bind_param("ss", $email, $token_hash);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Invalid or expired token.";
        exit;
    }

    // Update the password (hash the password)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE Users SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    $stmt->execute();

    if ($stmt->affected_rows) {
        echo "Password has been reset successfully.";
    } else {
        echo "Failed to reset password.";
    }
}
?>
