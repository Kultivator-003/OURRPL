<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login_register.php");
    exit();
}

// Include database configuration
include('../db/config.php');

try {
    // Get the logged-in user's ID from the session
    $user_id = $_SESSION['user_id'];

    // Fetch user details from the database
    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch user record
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Extract the username for display
        $user_name = $user['username'];
    } else {
        // If no user found, destroy session and redirect
        session_destroy();
        header("Location: login_register.php");
        exit();
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/courses.css">
</head>
<body>
<header class="header">
    <section class="flex">
        <a href="home.php" class="logo">ZonaCerdas 
        </a>

        <div class="icons">
            <!-- Menu button for opening sidebar -->
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile">
          <img src="../images/pic-1.png" class="image" alt="" />
         <h3 class="name"><?php echo htmlspecialchars($user_name); ?></h3>
          <p class="role">studen</p>
          <a href="profile.php" class="btn">view profile</a>
          <div class="flex-btn">
            <a href="login_register.php" class="option-btn">logout</a>
          </div>
          <div class="flex-btn">
            <a href="update.php" class="option-btn">lUpdate</a>
          </div>
        </div>
      </section>
    </header>


    <div class="side-bar">
    <!-- Close button inside the sidebar -->
    <div id="close-btn">
        <i class="fas fa-times"></i>
    </div>

    <div class="profile">
        <img src="../images/pic-1.png" class="image" alt="">
        <h3 class="name"><?php echo htmlspecialchars($user_name); ?></h3>
        <p class="role">student</p>
        <a href="profile.php" class="btn">view profile</a>
    </div>

    <nav class="navbar">
        <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
        <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
        <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
        <a href="teachers.php"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a>
        <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
    </nav>
</div>

<section class="home-grid">
    <h1 class="heading">quick options</h1>

    <div class="box-container">

        <div class="box">
            <h3 class="title">top categories</h3>
            <div class="flex">
                <a href="#"><i class="fas fa-code"></i><span>development</span></a>
                <a href="index.html"><i class="fas fa-chart-simple"></i><span>Test Your Knowledge</span></a>
                <a href="https://open.spotify.com/playlist/4nLTHoBe6O9URrHV2LiqXB?si=13527ec869fe4d48"><i class="fas fa-music"></i><span>music</span></a>
            </div>
        </div>

        <div class="box">
            <h3 class="title">give us feedback!</h3>
            <div class="flex">
                <a href="contact.php"><i class="fa-solid fa-hashtag"></i><span>Via Email</span></a>
                <a href="https://forms.gle/unA7Qfc1zTE8iGmt7"><i class="fab fa-js"></i><span>Form Tanggapan</span></a>
        </div>
    </div>
</section>

<section class="courses">
    <h1 class="heading">our courses</h1>

    <div class="box-container">
        <!-- Example course boxes -->
        <div class="box">
            <div class="tutor">
                <img src="../images/pic-2.jpg" alt="">
                <div class="info">
                    <h3>John Deo</h3>
                    <span>21-10-2022</span>
                </div>
            </div>
            
            <div class="thumb">
                <img src="../images/MathT.png" alt="">
                <span>10 videos</span>
            </div>
            <h3 class="title">Complete HTML Tutorial</h3>
            <a href="../Mapel/playlist_MTK.php" class="inline-btn">view playlist</a>
        </div>
    </div>

    <div class="more-btn">
        <a href="courses.php" class="inline-option-btn">view all courses</a>
    </div>
</section>

<!-- Custom JS File -->
<script src="../js/script.js"></script>
</body>
</html>