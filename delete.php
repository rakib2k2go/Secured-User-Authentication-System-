<?php
session_start(); 

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['user']['role'] !== 'Admin') {
    header("Location: index.php"); 
    exit();
}

include("connection.php");

if (!isset($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$id = $_GET['id'];

$query = "DELETE FROM products WHERE id='$id'";
mysqli_query($conn, $query);

header("Location: admin_dashboard.php");
exit();

