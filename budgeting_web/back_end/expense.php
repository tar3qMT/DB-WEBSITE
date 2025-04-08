<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli('mysql', 'root', 'root', 'budgeting_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $expenseName = trim($_POST["expense_name"]);
    $expenseAmount = $_POST["expense_amount"];

    $stmt = $conn->prepare("INSERT INTO Transactions (name, amount) VALUES (?, ?)");
    $stmt->bind_param("sd", $expenseName, $expenseAmount);

    if ($stmt->execute()) {
        echo "Expense added! <a href='../front_end/expense.html'>Back</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
