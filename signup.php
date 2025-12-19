<?php
session_start();
include 'particles-background.php';

if (isset($_SESSION['error'])) {
    $error_message = htmlspecialchars($_SESSION['error']);
    unset($_SESSION['error']);
} else {
    $error_message = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/signup.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form action="processes/signup_process.php" method="POST">
                <h1>Sign Up</h1>

                <?php if (!empty($error_message)) {
                    echo "<div class='error-message'>{$error_message}</div>";
                } ?>

                <input type="text" name="username" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit">Sign Up</button>
                <p class="signup-text">Already have an account? <a href="login.php">Sign In</a></p>
            </form>
        </div>
    </div>
</body>

</html>