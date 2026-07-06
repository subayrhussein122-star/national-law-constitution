<?php
require 'auth.php';
require 'db.php';

// First, we need to load the existing data to populate the form
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Get the specific law by ID
    $sql = "SELECT * FROM laws WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    // Check if the law exists
    if (mysqli_num_rows($result) == 1) {
        $law = mysqli_fetch_assoc($result);
    } else {
        die("Law not found.");
    }
} else {
    // If no ID is provided, go back to laws.php
    header("Location: laws.php");
    exit();
}

// Next, handle the form submission to update the data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $law_number = mysqli_real_escape_string($conn, $_POST['law_number']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Create the SQL UPDATE query
    $sql_update = "UPDATE laws SET 
                   title = '$title', 
                   law_number = '$law_number', 
                   category = '$category', 
                   year = '$year', 
                   description = '$description' 
                   WHERE id = $id";

    // Execute the query
    if (mysqli_query($conn, $sql_update)) {
        header("Location: laws.php");
        exit();
    } else {
        $error = "Error updating record: " . mysqli_error($conn);
    }
}

include 'header.php';
?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Law</h4>
            </div>
            <div class="card-body">

                <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                <!-- Form to edit the law -->
                <form action="edit_law.php?id=<?php echo $law['id']; ?>" method="POST">
                    <!-- Hidden field to pass the ID to the POST request -->
                    <input type="hidden" name="id" value="<?php echo $law['id']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($law['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Law Number</label>
                        <input type="text" name="law_number" class="form-control" value="<?php echo htmlspecialchars($law['law_number']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($law['category']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year Enacted</label>
                        <input type="number" name="year" class="form-control" value="<?php echo htmlspecialchars($law['year']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($law['description']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">Update Law</button>
                    <a href="laws.php" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
