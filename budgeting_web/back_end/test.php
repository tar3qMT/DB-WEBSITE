<?php
try {
    $conn = new PDO('mysql:host=mysql;dbname=budgeting_db', 'root', 'root');
    echo "Database connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>