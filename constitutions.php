<?php
require 'db.php';
include 'header.php';

// Fetch all constitutions from the database
$sql = "SELECT * FROM constitutions ORDER BY year DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Constitutions Management</h2>
    <?php if ($is_admin): ?>
        <a href="add_constitution.php" class="btn btn-success">+ Add Constitution</a>
    <?php endif; ?>
</div>

<!-- Table to display constitutions -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Description</th>
                        <?php if ($is_admin): ?>
                            <th class="text-center">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                            // Show a short preview of the description if it's too long
                            $desc_preview = strlen($row['description']) > 50 ? substr($row['description'], 0, 50) . "..." : $row['description'];
                            echo "<td>" . htmlspecialchars($desc_preview) . "</td>";
                            
                            if ($is_admin) {
                                echo "<td class='text-center'>";
                                echo "<a href='edit_constitution.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a> ";
                                echo "<a href='delete_constitution.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this constitution?\")'>Delete</a>";
                                echo "</td>";
                            }
                            
                            echo "</tr>";
                        }
                    } else {
                        $colspan = $is_admin ? 5 : 4;
                        echo "<tr><td colspan='$colspan' class='text-center text-muted py-4'>No constitutions found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
