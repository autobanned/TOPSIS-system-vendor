<?php
// No whitespace before this tag!
session_start();
include 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'SPK Pemilihan Vendor Cloud'; ?></title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .user-bar { background-color: #343a40; color: white; padding: 8px 20px; text-align: right; }
        .hero { background-color: #007bff; color: white; padding: 60px 20px; margin-bottom: 20px; border-radius: 0 0 5px 5px; }
        .card { margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .table-responsive { margin-top: 20px; }
    </style>
</head>
<body>
    <!-- User Info Bar -->
    <div class="user-bar">
        <?php if (isset($_SESSION['username'])): ?>
            <span><i class="fas fa-user"></i> Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
            <a href="logout.php" class="btn btn-sm btn-outline-light ml-2"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php endif; ?>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-cloud"></i> SPK Vendor Cloud
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar_vendor.php"><i class="fas fa-list"></i> Daftar Vendor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rekomendasi.php"><i class="fas fa-balance-scale"></i> Rekomendasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
