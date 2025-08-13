<?php
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Determine current page for active link styling (optional)
    $currentPage = basename($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'FitZone Gym'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
<header class="header">
    <nav class="navbar">
        <a href="index.php" class="logo">FitZone Gym</a>
        <ul class="nav-links">
            <li><a href="index.php" <?php if($currentPage=='index.php') echo 'class="active"'; ?>>Home</a></li>
            <li><a href="services.php" <?php if($currentPage=='services.php') echo 'class="active"'; ?>>Services</a></li>
            <li><a href="about.php" <?php if($currentPage=='about.php') echo 'class="active"'; ?>>About</a></li>
            <li><a href="trainers.php" <?php if($currentPage=='trainers.php') echo 'class="active"'; ?>>Trainers</a></li>
            <li><a href="contact.php" <?php if($currentPage=='contact.php') echo 'class="active"'; ?>>Contact</a></li>
        </ul>
        <div class="header-buttons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php" class="cta-btn">Dashboard</a>
                <a href="logout.php" class="cta-btn">Logout</a>
            <?php else: ?>
                <a href="enroll.php" class="cta-btn">Join Now</a>
                <a href="login.php" class="cta-btn">Login</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<main>
