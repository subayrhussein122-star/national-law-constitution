<?php
require 'db.php';
include 'header.php';

// 1. Basic Counts
$sql_laws_count = "SELECT COUNT(*) as total FROM laws";
$total_laws = mysqli_fetch_assoc(mysqli_query($conn, $sql_laws_count))['total'];

$sql_const_count = "SELECT COUNT(*) as total FROM constitutions";
$total_const = mysqli_fetch_assoc(mysqli_query($conn, $sql_const_count))['total'];

// 2. Number of laws per category
$sql_category = "SELECT category, COUNT(*) as count FROM laws GROUP BY category ORDER BY count DESC";
$result_category = mysqli_query($conn, $sql_category);

// 3. Number of laws added per year (using the 'year' field as when they were enacted/added)
$sql_year = "SELECT year, COUNT(*) as count FROM laws GROUP BY year ORDER BY year DESC";
$result_year = mysqli_query($conn, $sql_year);
?>

<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="text-primary">System Reports</h2>
        <p class="lead">Overview of data in the Law Library System.</p>
    </div>
</div>

<div class="row">
    <!-- General Statistics -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">General Statistics</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total Laws
                    <span class="badge bg-primary rounded-pill"><?php echo $total_laws; ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total Constitutions
                    <span class="badge bg-success rounded-pill"><?php echo $total_const; ?></span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Laws by Category -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Laws by Category</h5>
            </div>
            <ul class="list-group list-group-flush">
                <?php
                if (mysqli_num_rows($result_category) > 0) {
                    while ($row = mysqli_fetch_assoc($result_category)) {
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                        echo htmlspecialchars($row['category']);
                        echo '<span class="badge bg-secondary rounded-pill">' . $row['count'] . '</span>';
                        echo '</li>';
                    }
                } else {
                    echo '<li class="list-group-item text-muted">No categories found.</li>';
                }
                ?>
            </ul>
        </div>
    </div>

    <!-- Laws by Year -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Laws by Year</h5>
            </div>
            <ul class="list-group list-group-flush">
                <?php
                if (mysqli_num_rows($result_year) > 0) {
                    while ($row = mysqli_fetch_assoc($result_year)) {
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                        echo htmlspecialchars($row['year']);
                        echo '<span class="badge bg-dark rounded-pill">' . $row['count'] . '</span>';
                        echo '</li>';
                    }
                } else {
                    echo '<li class="list-group-item text-muted">No year data found.</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
