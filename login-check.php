<?php
session_start();

// Dummy admin credentials
$admin_username = "admin";
$admin_password = "admin123";

if ($_POST['username'] === $admin_username && $_POST['password'] === $admin_password) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: dashboard.php");
} else {
    header("Location: login.php?error=Invalid credentials");
}
?>
