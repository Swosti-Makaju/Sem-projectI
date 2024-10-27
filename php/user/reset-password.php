<?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['token'], $_GET['email'])) {
    $token = $_GET['token'];
    $email = $_GET['email'];

    // Validate token
    $conn = require __DIR__ . "../config.php";
    $token_hash = hash("sha256", $token);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND reset_token_hash = ? AND reset_token_expires_at > NOW()");
    $stmt->bind_param("ss", $email, $token_hash);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Invalid or expired token.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>

    <form method="post" action="update-password.php">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <label for="password">New Password</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
