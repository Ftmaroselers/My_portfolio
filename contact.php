<?php
session_start();
include 'db.php';
include 'particles-background.php';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($name) || empty($email) || empty($message)) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } else {

        // Insert into database instead of email
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $success = "Thank you! Your message has been saved.";
        } else {
            $error = "Failed to save message. Try again later.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/contact.css">
</head>

<body>

    <div class="nav-container">

        <nav class="navbar">
            <div class="logo">
                <img src="assets/logo.png" alt="Logo" class="title-image">MYPORTFOLIO
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="project.php">Projects</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </div>
    <div class="account-dropdown">
        <div class="account-container">
            <a href="#" class="account-btn">
                <?php
                if (isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])) {
                    echo '<img src="' . $_SESSION['profile_image'] . '" alt="Profile" class="profile-icon">';
                } else {
                    echo '<i class="fas fa-user-circle"></i>';
                }
                ?>
            </a>
        </div>
        <ul class="dropdown-menu">
            <?php if (isset($_SESSION['username'])): ?>
                <li class="dropdown-username"><?php echo htmlspecialchars($_SESSION['username']); ?></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <?php else: ?>
                <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <li><a href="signup.php"><i class="fas fa-user-plus"></i> Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <!-- CONTACT FORM -->
    <div class="contact-container">
        <h2>Get in Touch</h2>
        <?php if ($success) echo "<div class='message success'>$success</div>"; ?>
        <?php if ($error) echo "<div class='message error'>$error</div>"; ?>
        <form method="post" action="">
            <div class="form-group">
                <input type="text" name="name" id="name" placeholder=" " required>
                <label for="name">Your Name</label>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder=" " required>
                <label for="email">Your Email</label>
            </div>
            <div class="form-group">
                <textarea name="message" id="message" placeholder=" " required></textarea>
                <label for="message">Your Message</label>
            </div>
            <button type="submit" class="btn-submit">Send Message <i class="fas fa-paper-plane"></i></button>
        </form>
    </div>
    <script src="scripts/contact.js"></script>
    <?php include 'footer.php'; ?>

</body>

</html>