<?php
session_start(); // Start session at the very top
include 'db.php';
include 'particles-background.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Featured Projects</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/project.css">
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

    <!-- ACCOUNT DROPDOWN -->
    <div class="account-dropdown">
        <a href="#" class="account-btn">
            <?php
            if (isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])) {
                echo '<img src="' . $_SESSION['profile_image'] . '" alt="Profile" class="profile-icon">';
            } else {
                echo '<i class="fas fa-user-circle"></i>';
            }
            ?>
        </a>

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

    <main>
        <section class="projects" id="projects">
            <h2>Featured Projects</h2>

            <div class="carousel">
                <div class="list">
                    <div class="item active">
                        <img src="assets/car.jpg" alt="Car Finder">
                        <div class="content">
                            <div class="author">Solo Project</div>
                            <div class="title">Car Finder</div>
                            <div class="topic">Utility App</div>
                            <div class="des">A user-friendly application that assists in tracking your car.</div>
                            <div class="buttons">
                                <a href="https://github.com/Ftmaroselers/Activity3.1_CarsLocation" target="_blank">
                                    <button><i class="fab fa-github"></i> View on GitHub</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <img src="assets/fc.jpg" alt="Flood Control">
                        <div class="content">
                            <div class="author">Group Project</div>
                            <div class="title">Flood Control: The Mystic Shadow</div>
                            <div class="topic">Game</div>
                            <div class="des">A group project game about corruption and disaster.</div>
                            <div class="buttons">
                                <a href="https://johnweakii.itch.io/flood-control" target="_blank">
                                    <button><img src="https://static.itch.io/images/itchio-textless-black.svg" class="itch-icon"> View on itch.io</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- progress bar -->
                <div class="time"></div>

            </div>
            <!-- arrows -->
            <div class="arrows">
                <button id="prev"><i class="fas fa-chevron-left"></i></button>
                <button id="next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
    <script src="scripts/project.js"></script>
</body>

</html>