<?php
// google_login.php
session_start();

// Your Google app credentials
$client_id = "YOUR_GOOGLE_CLIENT_ID";
$client_secret = "YOUR_GOOGLE_CLIENT_SECRET";
$redirect_uri = "http://localhost/MyPortfolio/processes/google_callback.php";
// Google OAuth URL
$params = [
    "client_id" => $client_id,
    "redirect_uri" => $redirect_uri,
    "response_type" => "code",
    "scope" => "email profile",
    "access_type" => "offline",
    "prompt" => "select_account"  // ensures user can choose account
];

// Build Google auth URL
$auth_url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query($params);

// Redirect user to Google login
header("Location: " . $auth_url);
exit();
