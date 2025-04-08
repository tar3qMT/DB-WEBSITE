<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../front_end/signin.html");
    exit();
}

// Connect to DB
$conn = new mysqli('mysql', 'root', 'root', 'budgeting_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $bill_name = $_POST['bill_name'];
    $bill_amount = $_POST['bill_amount'];
    $due_date = $_POST['due_date'];
    $paid_status = (int)$_POST['paid_status'];
    $payment_date = $paid_status ? ($_POST['payment_date'] ?? date('Y-m-d')) : null;

    // Insert into Bills table
    $stmt = $conn->prepare("INSERT INTO Bills 
        (user_id, bill_name, bill_amount, due_date, payment_date, paid_status) 
        VALUES (?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("isdsii", 
        $user_id, 
        $bill_name, 
        $bill_amount, 
        $due_date, 
        $payment_date, 
        $paid_status
    );

    if ($stmt->execute()) {
        header("Location: ../front_end/add_bill.html?success=1");
    } else {
        header("Location: ../front_end/add_bill.html?error=" . urlencode($stmt->error));
    }
    
    $stmt->close();
}
$conn->close();
?>