<?php
require 'auth.php';
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and escape it for security
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // INSERT query for constitutions table
    $sql = "INSERT INTO constitutions (title, year, description) 
            VALUES ('$title', '$year', '$description')";

    if (mysqli_query($conn, $sql)) {
        header("Location: constitutions.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

include 'header.php';
?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add New Constitution</h4>
            </div>
            <div class="card-body">
                
                <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                <form action="add_constitution.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year Established</label>
                        <input type="number" name="year" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Constitution</button>
                    <a href="constitutions.php" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
