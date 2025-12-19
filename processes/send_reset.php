<?php
session_start();
include '../db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer manually
require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

if (!isset($_POST['email'])) {
    header("Location: ../forgot_password.php");
    exit();
}

$email = $_POST['email'];

// Check if email exists
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Always show a generic message for security
    $_SESSION['msg'] = "If the email exists, a reset link has been sent.";
    header("Location: ../forgot_password.php");
    exit();
}

// Generate reset token
$token = bin2hex(random_bytes(50));
$expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

// Save token and expiration
$update = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
$update->bind_param("sss", $token, $expires, $email);
$update->execute();

// Reset link
$link = "http://localhost/MyPortfolio/reset_password.php?token=$token";

// PHPMailer setup
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'timayroselloza24@gmail.com'; // your Gmail
    $mail->Password = 'epgt ppev czyu shnv';       // app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // **Important:** Avoid PSR-3 logger
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'echo';

    $mail->setFrom('timayroselloza24@gmail.com', 'MyPortfolio');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';
    $mail->Body = "
        <h3>Password Reset</h3>
        <p>Click the link below to reset your password:</p>
        <a href='$link'>$link</a>
        <p>This link expires in 1 hour.</p>
    ";
    $mail->AltBody = "Copy this link to reset your password: $link";

    $mail->send();

    $_SESSION['msg'] = "If the email exists, a reset link has been sent.";
} catch (Exception $e) {
    $_SESSION['error'] = "Email sending failed: " . $mail->ErrorInfo;
}

header("Location: ../forgot_password.php");
exit();
