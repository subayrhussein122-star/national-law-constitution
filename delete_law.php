<?php
require 'auth.php';
require 'db.php';

// Check if an ID was passed in the URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Create the SQL DELETE query
    $sql = "DELETE FROM laws WHERE id = $id";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Redirect back to laws page upon success
        header("Location: laws.php");
        exit();
    } else {
        // Display an error message if something goes wrong
        die("Error deleting record: " . mysqli_error($conn));
    }
} else {
    // If no ID provided, just redirect
    header("Location: laws.php");
    exit();
}
?>
