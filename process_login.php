<?php
session_start();
include("connection.php");

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        $_SESSION['user'] = $user;

        if($user['role'] == 'Admin') {
            header("Location: admin_dashboard.php");
            exit();
        } elseif($user['role'] == 'Entry') {
            header("Location: entry_dashboard.php");
            exit();
        } elseif($user['role'] == 'View') {
            header("Location: view_dashboard.php");
            exit();
        } else {
            header("Location: default_dashboard.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Invalid email or password";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

