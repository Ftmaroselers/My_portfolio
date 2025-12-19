<?php
session_start();
include 'db.php';
include 'particles-background.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/index.css">
</head>

<body>
    <div class="nav-container">
        <nav class="navbar">
            <ul>
                <li><a href="index.php" id="navHome">Home</a></li>
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
                    echo '<img src="' . htmlspecialchars($_SESSION['profile_image']) . '" alt="Profile" class="profile-icon">';
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

    <div id="page-content">
        <section class="home" id="home">
            <div class="home-content">
                <h1 class="portfolio-title">
                    <span class="my-box">MY</span>
                    <div class="portfolio-box">
                        PORTF
                        <img src="assets/logo.png" alt="Logo" class="title-image">
                        LIO
                    </div>
                </h1>

                <h3>Discover my projects and skills.</h3>
                <p>Welcome to my personal portfolio website where I showcase my work and expertise.</p>
                <div class="btn-box">
                    <a href="https://github.com/Ftmaroselers" class="icon-btn"><i class="fab fa-github"></i></a>
                    <a href="https://linkedin.com" class="icon-btn"><i class="fab fa-linkedin"></i></a>
                </div>

                <a href="#" id="aboutBtn" class="btn next-btn">About Me</a>

            </div>

            <div class="home-image">
                <img src="assets/image.png" alt="Fatima Illustration">
            </div>
        </section>
        <main>
            <section class="intro" id="intro">
                <h2>About Me</h2>
                <p>
                    My name is Fatima Arnado, and I am a student at the University of the Visayas – Main Campus.
                    I am passionate about learning new things and continuously improving my skills.
                    <br><br>
                    I enjoy working on web development, UI design, and interactive digital experiences that blend
                    creativity with functionality.
                    <br><br>
                    In my free time, I explore new technologies, experiment with design ideas, and build projects
                    that push my abilities further.
                </p>
            </section>

        </main>

    </div>
    <?php include 'footer.php'; ?>

    <script src="scripts/index.js"></script>


</body>

</html>