<?php 
session_start();
include('config.php'); 
$pageTitle = 'Login';
include('header.php');

// Hardcoded admin credentials
$admin_email = "adminfitzonegym@gmail.com";
$admin_password = "fitzone@1234";

// Handle Admin Login when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_email'], $_POST['admin_password'])) {
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];

    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header("Location: admindashboard.php");
        exit();
    } else {
        $login_error = "Invalid admin credentials.";
    }
}
?>
<section id="home" class="hero">
    <div class="overlay"></div>
    <div class="hero-content"></div>
    <div class="info-container">
        
        <!-- Admin Login -->
        <div class="info-box">
            <h2>Admin Login</h2>
            <?php if (!empty($login_error)): ?>
                <p style="color:red;"><?php echo $login_error; ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <input type="email" name="admin_email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="admin_password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
        </div>

        <!-- Member Login (can be disabled or hidden for now) -->
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
