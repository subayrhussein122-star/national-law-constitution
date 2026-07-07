<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// db.php
// This file handles the connection to the MySQL database.
// It uses procedural PHP (mysqli_connect) for simplicity.

$servername = "localhost:3307"; // Database host (usually localhost)
$username = "root";        // Database username (default for XAMPP is root)
$password = "";            // Database password (default for XAMPP is empty)
$dbname = "national-law-constitution";   // The name of the database we created

// Create the connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection failed
if (!$conn) {
    // If it fails, stop the script and print the error
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database Connected!";
?>