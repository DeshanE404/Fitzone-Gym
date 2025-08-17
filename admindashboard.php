<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Not logged in → send back to login page
    header("Location: login.php");
    exit();
}
?>

<?php include('header.php'); ?>

<section id="dashboard" class="hero">
    <div class="overlay"></div>
    <div class="hero-content">
    <div class="admindashboard">
               <div class="container info-box">
        <h2>FitZone Gym Enrollment</h2>
                <div class="mini-info-box">
        <h3>To obtain a FitZone Gym subscription, kindly transfer your payment to the bank.Fill out the enrollment form, attach the receipt, and submit it after the transaction.Below are the bank's information!</h3>
        <p style="color: rgba(148, 226, 236, 1);">Gym membership prices are , 2500Rs/month (For Adult), 1000Rs/month (For Students)</p>
        </div>
        <div class="list-container">
        <h1>Admin Dashboard</h1>
        <p>Manage your gym efficiently</p>
    </div>
        </div>

    </section>



    <a href="logout.php">Logout</a>
</section>

<?php include('footer.php'); ?>

