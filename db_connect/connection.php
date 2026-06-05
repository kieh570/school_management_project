<?php
$databaseName = "mdf_database";
$serverName = "localhost";
$userName = "root";
$password = ""; // semicolon added

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName;charset=utf8mb4", $userName, $password);
    
    // Set error mode so PDO throws exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connection Successful ✅";
    
} catch (PDOException $e) { // spelling fixed
    echo "Connection failed ❌ Error: " . $e->getMessage();
}
