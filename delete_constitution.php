<?php
require 'auth.php';
require 'db.php';

// Check if an ID was passed in the URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Create the SQL DELETE query for constitutions table
    $sql = "DELETE FROM constitutions WHERE id = $id";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header("Location: constitutions.php");
        exit();
    } else {
        die("Error deleting record: " . mysqli_error($conn));
    }
} else {
    header("Location: constitutions.php");
    exit();
}
?>
