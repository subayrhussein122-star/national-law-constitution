<?php
require 'auth.php';
require 'db.php';

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form and prevent SQL injection
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $law_number = mysqli_real_escape_string($conn, $_POST['law_number']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Create the SQL INSERT query
    $sql = "INSERT INTO laws (title, law_number, category, year, description) 
            VALUES ('$title', '$law_number', '$category', '$year', '$description')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // If successful, redirect back to the laws list
        header("Location: laws.php");
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
                <h4 class="mb-0">Add New Law</h4>
            </div>
            <div class="card-body">
                
                <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                <!-- Form to add a law -->
                <form action="add_law.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Law Number</label>
                        <input type="text" name="law_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year Enacted</label>
                        <input type="number" name="year" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Law</button>
                    <a href="laws.php" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
