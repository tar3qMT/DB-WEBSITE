<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli('mysql', 'root', 'root', 'budgeting_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = 1; // Replace with session later
    $goal = $_POST['goal_name'];
    $target = $_POST['target_amount'];
    $category_id = $_POST['category_id'];

    $stmt = $conn->prepare("INSERT INTO SavingsGoals (user_id, goal_name, target_amount, category_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isdi", $user_id, $goal, $target, $category_id);
    $stmt->execute();

    echo "Savings Goal added!";
    $stmt->close();
}
$conn->close();
?>
