<?php
include 'particles-background.php';
session_start();

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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/login.css">
    <style>
        .error-message {
            color: #ff4d4d;
            font-size: 12px;
            margin: 10px 0;
            opacity: 1;
            transition: opacity 0.5s ease, max-height 0.5s ease, margin 0.5s ease;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form action="processes/login_process.php" method="POST">
                <h1>Sign In</h1>

                <div class="social-icons">
                    <a href="processes/google_login.php" class="social">
                        <i class="fab fa-google"></i>
                    </a>
                </div>

                <span class="or-separator">or use your email password</span>

                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>

                <?php if ($error_message): ?>
                    <div class="error-message"><?= $error_message ?></div>
                <?php endif; ?>

                <a href="forgot_password.php">Forgot your password?</a>
                <button type="submit" name="login">Sign In</button>
                <p class="signup-text">Don't have an account? <a href="signup.php">Sign Up</a></p>
            </form>
        </div>
    </div>
</body>

</html>