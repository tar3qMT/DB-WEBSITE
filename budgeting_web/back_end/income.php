<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check session
if (!isset($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
    die("User not logged in.");
}
$user_id = $_SESSION['user_id'];

// Connect to database
$conn = new mysqli('mysql', 'root', 'root', 'budgeting_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $source = trim($_POST['income_source']);
    $amount = $_POST['amount'];

    // Prepare and insert
    $stmt = $conn->prepare("INSERT INTO Income (user_id, income_source, income_amount) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $user_id, $source, $amount);
    if ($stmt->execute()) {
        echo "<p> Income added successfully! <a href='../front_end/home.html'>Go to Dashboard</a></p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
