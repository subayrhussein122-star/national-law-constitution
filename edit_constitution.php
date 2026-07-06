<?php
require 'auth.php';
require 'db.php';

// Check if an ID was passed
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $sql = "SELECT * FROM constitutions WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $constitution = mysqli_fetch_assoc($result);
    } else {
        die("Constitution not found.");
    }
} else {
    header("Location: constitutions.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql_update = "UPDATE constitutions SET 
                   title = '$title', 
                   year = '$year', 
                   description = '$description' 
                   WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: constitutions.php");
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
                <h4 class="mb-0">Edit Constitution</h4>
            </div>
            <div class="card-body">

                <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                <form action="edit_constitution.php?id=<?php echo $constitution['id']; ?>" method="POST">
                    <input type="hidden" name="id" value="<?php echo $constitution['id']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($constitution['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year Established</label>
                        <input type="number" name="year" class="form-control" value="<?php echo htmlspecialchars($constitution['year']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5"><?php echo htmlspecialchars($constitution['description']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">Update Constitution</button>
                    <a href="constitutions.php" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
