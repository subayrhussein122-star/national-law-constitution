<?php $is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Law and Constitution Library</title>
    <!-- Include Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Include Bootstrap 5 CSS from CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link to custom premium stylesheet -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <!-- System Title / Logo -->
        <a class="navbar-brand" href="index.php">🏛️ Law Library</a>
        
        <!-- Toggle button for mobile devices -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="laws.php">Laws</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="constitutions.php">Constitutions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reports.php">Reports</a>
                </li>
            </ul>
            <!-- Login/Logout Button on the right -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php if ($is_admin): ?>
                        <a class="btn btn-sm btn-outline-light ms-2 mt-1" href="logout.php">Logout</a>
                    <?php else: ?>
                        <a class="btn btn-sm btn-outline-light ms-2 mt-1" href="login.php">Admin Login</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Container for page content -->
<div class="container">
