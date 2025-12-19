<?php
session_start();
include 'db.php';

if (!isset($_GET['token'])) {
    $_SESSION['error'] = "Invalid request.";
    header("Location: login.php");
    exit();
}

$token = $_GET['token'];

// Verify token is valid and not expired
$stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expires > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Token expired or invalid.";
    header("Location: login.php");
    exit();
}

if (isset($_POST['reset'])) {
    $password = $_POST['password'];

    if (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        $new_password = password_hash($password, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE users SET password = ?, reset_token=NULL, reset_expires=NULL WHERE reset_token=?");
        $update->bind_param("ss", $new_password, $token);
        $update->execute();

        $_SESSION['msg'] = "Password updated successfully! You can now sign in.";
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style/login.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form method="POST">
                <h1>Reset Password</h1>

                <?php if (isset($error)) : ?>
                    <p style="color:red;"><?php echo $error; ?></p>
                <?php endif; ?>

                <p class="or-separator">Enter your new password</p>
                <input type="password" name="password" placeholder="New Password" required>

                <button type="submit" name="reset">Update Password</button>

                <p class="signup-text"><a href="login.php">Back to Login</a></p>
            </form>
        </div>
    </div>
</body>

</html>