<?php
session_start();
include 'db.php';

if (!isset($_GET['token'])) {
    echo "Invalid request.";
    exit();
}

$token = $_GET['token'];

// Validate token
$stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expires > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Token expired or invalid.";
    exit();
}

if (isset($_POST['reset'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Update password
    $update = $conn->prepare("UPDATE users SET password = ?, reset_token=NULL, reset_expires=NULL WHERE reset_token=?");
    $update->bind_param("ss", $password, $token);
    $update->execute();

    $_SESSION['msg'] = "Password updated! You can now login.";
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>
    <h2>Enter new password</h2>

    <form method="POST">
        <input type="password" name="password" placeholder="New password" required>
        <button type="submit" name="reset">Update Password</button>
    </form>
</body>

</html>