<?php
// Start the session to keep track of logged-in users
session_start();

// Check if the session variable 'admin_logged_in' is NOT set or NOT true
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // If they are not logged in, redirect them to the login page immediately
    header("Location: login.php");
    exit(); // Stop executing any further code
}
?>
