<?php
// Include the database connection file
require 'db.php';

// Include the header file for the navigation bar and HTML setup
include 'header.php';

// 1. Query to count total laws
$sql_laws = "SELECT COUNT(*) as total FROM laws";
$result_laws = mysqli_query($conn, $sql_laws);
$row_laws = mysqli_fetch_assoc($result_laws);
$total_laws = $row_laws['total'];

// 2. Query to count total constitutions
$sql_const = "SELECT COUNT(*) as total FROM constitutions";
$result_const = mysqli_query($conn, $sql_const);
$row_const = mysqli_fetch_assoc($result_const);
$total_const = $row_const['total'];

// 3. Query to count total unique categories of laws
$sql_cat = "SELECT COUNT(DISTINCT category) as total FROM laws";
$result_cat = mysqli_query($conn, $sql_cat);
$row_cat = mysqli_fetch_assoc($result_cat);
$total_categories = $row_cat['total'];
?>

<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="text-primary">Dashboard</h2>
        <p class="lead">Welcome to the National Law and Constitution Library System.</p>
    </div>
</div>

<!-- Use Bootstrap grid system for responsive cards -->
<div class="row">
    <!-- Card for Total Laws -->
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-primary shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Total Laws</h5>
                <h1 class="display-4"><?php echo $total_laws; ?></h1>
                <p class="card-text">Laws currently recorded in the system.</p>
            </div>
            <div class="card-footer bg-transparent border-light">
                <a href="laws.php" class="text-white text-decoration-none">View All Laws &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Card for Total Constitutions -->
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-success shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Total Constitutions</h5>
                <h1 class="display-4"><?php echo $total_const; ?></h1>
                <p class="card-text">Constitutions recorded in the system.</p>
            </div>
            <div class="card-footer bg-transparent border-light">
                <a href="constitutions.php" class="text-white text-decoration-none">View Constitutions &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Card for Total Categories -->
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-warning shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Total Categories</h5>
                <h1 class="display-4"><?php echo $total_categories; ?></h1>
                <p class="card-text">Different categories of laws.</p>
            </div>
            <div class="card-footer bg-transparent border-light">
                <a href="reports.php" class="text-white text-decoration-none">View Reports &rarr;</a>
            </div>
        </div>
    </div>
</div>

<?php 
// Include the footer file
include 'footer.php'; 
?>
