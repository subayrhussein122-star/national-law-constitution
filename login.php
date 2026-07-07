<?php
session_start();
require 'db.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Set your custom username and password right here in the code!
    // (This completely ignores the database)
    if ($username === 'admin' && $password === '123') {
        // Success! Set session variables
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Law Library</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Center the login box on the screen */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card shadow-lg login-card">
            <div class="card-header bg-primary text-white text-center py-4">
                <h3 class="mb-0">🏛️ Admin Login</h3>
            </div>
            <div class="card-body p-4">
                <?php if ($error) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required placeholder="Enter username">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="text" name="password" pattern="[0-9]+" class="form-control" required placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                </form>
            </div>
            <div class="card-footer text-center text-muted py-3 bg-transparent">
                <small>National Law and Constitution Library</small>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
    <a href="#">Forgot Password?</a>
</div>
</body>
</html>
