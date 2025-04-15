<?php
session_start();
require_once '../back_end/session_check.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: ../front_end/signin.html");
    exit;
}
