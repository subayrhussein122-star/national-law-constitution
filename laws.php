<?php
require 'db.php';
include 'header.php';

// Check if there's a search query
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Prevent SQL injection by escaping the input string
    $search_safe = mysqli_real_escape_string($conn, $search);
    // Simple query with WHERE clause for searching
    $sql = "SELECT * FROM laws WHERE title LIKE '%$search_safe%' ORDER BY id DESC";
} else {
    // If no search, select all laws
    $sql = "SELECT * FROM laws ORDER BY id DESC";
}

// Execute the query
$result = mysqli_query($conn, $sql);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Laws Management</h2>
    <?php if ($is_admin): ?>
        <a href="add_law.php" class="btn btn-success">+ Add New Law</a>
    <?php endif; ?>
</div>

<!-- Search Form -->
<form method="GET" action="laws.php" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search laws by title..." value="<?php echo htmlspecialchars($search); ?>">
        <button class="btn btn-primary" type="submit">Search</button>
        <?php if (!empty($search)) { ?>
            <a href="laws.php" class="btn btn-secondary">Clear</a>
        <?php } ?>
    </div>
</form>

<!-- Table to display laws -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Law Number</th>
                        <th>Category</th>
                        <th>Year</th>
                        <?php if ($is_admin): ?>
                            <th class="text-center">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if we have any records
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['law_number']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                            
                            if ($is_admin) {
                                echo "<td class='text-center'>";
                                echo "<a href='edit_law.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a> ";
                                echo "<a href='delete_law.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this law?\")'>Delete</a>";
                                echo "</td>";
                            }
                            
                            echo "</tr>";
                        }
                    } else {
                        // Message if no records are found
                        $colspan = $is_admin ? 6 : 5;
                        echo "<tr><td colspan='$colspan' class='text-center text-muted py-4'>No laws found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
