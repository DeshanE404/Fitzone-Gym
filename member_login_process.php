<?php
session_start();
include('config.php'); // $dbh is PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['member_email'], $_POST['member_password'])) {
    $email = trim($_POST['member_email']);
    $password = trim($_POST['member_password']);

    try {
        $stmt = $dbh->prepare("SELECT * FROM members WHERE email = ?");
        $stmt->execute([$email]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($member && password_verify($password, $member['password'])) {
            // Login successful
            $_SESSION['member_logged_in'] = true;
            $_SESSION['member_email'] = $member['email'];
            $_SESSION['member_name'] = $member['name'];
            $_SESSION['member_gym_id'] = $member['gym_id'];

            header("Location: userdashboard.php");
            exit();
        } else {
            // Invalid credentials
            $_SESSION['login_error'] = "Invalid email or password.";
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['login_error'] = "Database error: " . $e->getMessage();
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
