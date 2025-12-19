<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Fetch user
    $stmt = $conn->prepare("SELECT id, username, password, auth_type FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        $_SESSION['error'] = "Invalid credentials.";
        header("Location: ../login.php");
        exit();
    }

    // Check login type
    if ($user['auth_type'] === 'google') {
        $_SESSION['error'] = "Please log in with Google.";
        header("Location: ../login.php");
        exit();
    }

    // Verify password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../index.php");
    } else {
        $_SESSION['error'] = "Invalid credentials.";
        header("Location: ../login.php");
    }
}
