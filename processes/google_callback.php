<?php
// google_callback.php
session_start();
include '../db.php';  // your database connection

$client_id = "YOUR_GOOGLE_CLIENT_ID";
$client_secret = "YOUR_GOOGLE_CLIENT_SECRET";
$redirect_uri = "http://localhost/MyPortfolio/processes/google_callback.php";

// STEP 1: Get access token
$token_url = "https://oauth2.googleapis.com/token";
$data = [
    "code" => $_GET["code"],
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "redirect_uri" => $redirect_uri,
    "grant_type" => "authorization_code"
];

$curl = curl_init($token_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

$token = json_decode($response, true);

// STEP 2: Get user info
$user_info = file_get_contents("https://www.googleapis.com/oauth2/v2/userinfo?access_token=" . $token["access_token"]);
$user = json_decode($user_info, true);

$email = $user['email'];
$name = $user['name'];
$google_id = $user['id'];
$profile_image = $user['picture'] ?? null; // Google profile image

// STEP 3: Check if user already exists in database
$stmt = $conn->prepare("SELECT id, username, email FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Existing user → log in
    $db_user = $result->fetch_assoc();
    $_SESSION['user_id'] = $db_user['id'];
    $_SESSION['username'] = $db_user['username'];
    $_SESSION['email'] = $db_user['email'];
    $_SESSION['profile_image'] = $profile_image;

    // Optional: update google_id if missing
    $update_stmt = $conn->prepare("UPDATE users SET google_id=? WHERE id=? AND google_id IS NULL");
    $update_stmt->bind_param("si", $google_id, $db_user['id']);
    $update_stmt->execute();
    $update_stmt->close();
} else {
    // New user → insert into database
    $stmt_insert = $conn->prepare("INSERT INTO users (username, email, google_id) VALUES (?, ?, ?)");
    $stmt_insert->bind_param("sss", $name, $email, $google_id);
    $stmt_insert->execute();

    $_SESSION['user_id'] = $stmt_insert->insert_id;
    $_SESSION['username'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['profile_image'] = $profile_image;

    $stmt_insert->close();
}

$stmt->close();

// STEP 4: Merge guest content if it exists
if (isset($_SESSION['temp_content'])) {
    $user_id = $_SESSION['user_id'];
    $content = $_SESSION['temp_content']['about_me'] ?? '';

    if ($content) {
        // Check if user already has portfolio content
        $stmt_check = $conn->prepare("SELECT id FROM portfolio_content WHERE user_id=?");
        $stmt_check->bind_param("i", $user_id);
        $stmt_check->execute();
        $res_check = $stmt_check->get_result();

        if ($res_check->num_rows > 0) {
            // Update existing record
            $stmt_update = $conn->prepare("UPDATE portfolio_content SET content=? WHERE user_id=?");
            $stmt_update->bind_param("si", $content, $user_id);
            $stmt_update->execute();
            $stmt_update->close();
        } else {
            // Insert new record
            $stmt_insert = $conn->prepare("INSERT INTO portfolio_content (user_id, content) VALUES (?, ?)");
            $stmt_insert->bind_param("is", $user_id, $content);
            $stmt_insert->execute();
            $stmt_insert->close();
        }

        // Clear temporary content
        unset($_SESSION['temp_content']);
    }

    $stmt_check->close();
}

$conn->close();

// STEP 5: Redirect to index
header("Location: ../index.php");
exit();
