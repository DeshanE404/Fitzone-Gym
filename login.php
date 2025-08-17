<?php
session_start();
include('config.php'); 
$pageTitle = 'Login';
include('header.php');
?>

<section id="home" class="hero">
    <div class="overlay"></div>
    <div class="hero-content"></div>
    <div class="info-container">
        
        <!-- Admin Login -->
        <div class="info-box">
            <h2>Admin Login</h2>
            <form method="POST" action="admin_login_process.php">
                <div class="form-group">
                    <input type="email" name="admin_email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="admin_password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
        </div>

        <!-- Member Login -->
        <div class="info-box">
            <h2>Member Login</h2>
            <form method="POST" action="member_login_process.php">
                <div class="form-group">
                    <input type="email" name="member_email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="member_password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
        </div>

    </div>
</section>

<?php include('footer.php'); ?>
