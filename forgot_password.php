<?php
session_start();
include 'particles-background.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/login.css">
</head>

<body>
    <div class="container">
        <div class="form-container">

            <form action="processes/send_reset.php" method="POST">
                <h1>Forgot Password</h1>

                <p class="or-separator">Enter your email to receive a reset link</p>

                <input type="email" name="email" placeholder="Email" required>

                <?php
                if (isset($_SESSION['msg'])) {
                    echo '<div class="success-message">' . htmlspecialchars($_SESSION['msg']) . '</div>';
                    unset($_SESSION['msg']);
                }
                if (isset($_SESSION['error'])) {
                    echo '<div class="error-message">' . htmlspecialchars($_SESSION['error']) . '</div>';
                    unset($_SESSION['error']);
                }
                ?>

                <button type="submit">Send Reset Link</button>

                <p class="signup-text"><a href="login.php">Back to Login</a></p>
            </form>

        </div>
    </div>

    <script src="scripts/forgot_password.js"></script>

</body>

</html>