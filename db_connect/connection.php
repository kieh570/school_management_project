<?php
session_start();
require_once 'db_connect/connection.php';

// Security Checks
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    header("Location: teachers_login.php");
    exit();
}

// Session Timeout (30 minutes)
if (time() - $_SESSION['last_activity'] > 1800) {
    session_destroy();
    header("Location: teachers_login.php");
    exit();
}
$_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - MDF</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">
                👨🏫 <?= htmlspecialchars($_SESSION['full_name']) ?> 
                (<?= htmlspecialchars($_SESSION['login_id']) ?>)
            </span>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Teacher Dashboard</h2>
        <p><strong>Subject:</strong> <?= htmlspecialchars($_SESSION['subject'] ?? 'N/A') ?></p>

        <!-- You can freely query ANY table here -->
        <?php
        // Example 1: All Students
        $students = $conn->query("SELECT * FROM students ORDER BY id DESC LIMIT 15");
        
        echo "<h5>All Students</h5>";
        echo "<pre>";
        while($row = $students->fetch(PDO::FETCH_ASSOC)) {
            print_r($row);   // You can print or format anything you want
        }
        echo "</pre>";
        ?>
    </div>
</body>
</html>
