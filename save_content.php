<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    exit("Not logged in");
}

$about = $_POST['about_me'] ?? '';

$sql = "INSERT INTO portfolio_content (user_id, about_me)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE about_me = VALUES(about_me)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $_SESSION['user_id'], $about);
$stmt->execute();
