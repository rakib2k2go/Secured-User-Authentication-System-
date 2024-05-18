<?php
session_start();
include("connection.php");

if(isset($_GET['token'])) {
    $token = $_GET['token'];

    $query = "SELECT verification_token, verified FROM users WHERE verification_token='$token' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if($row['verified'] == 0) {
            $created_at = $row['created_at'];
            $expiration_time = date('Y-m-d H:i:s', strtotime($created_at . '+24 hours'));
            if ($expiration_time >= date('Y-m-d H:i:s')) {
                $update_query = "UPDATE users SET verified=1 WHERE verification_token='$token'";
                $update_result = mysqli_query($conn, $update_query);
                if($update_result) {
                    $_SESSION['status'] = "Email verification successful. You can now login.";
                    header("Location: login.php");
                    exit();
                } else {
                    $_SESSION['status'] = "Failed to verify email. Please try again later.";
                    header("Location: login.php");
                    exit();
                }
            } else {
                $_SESSION['status'] = "Verification token has expired. Please register again.";
                header("Location: register.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Email already verified. You can now login.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Invalid verification token.";
        header("Location: login.php");
        exit();
    }    
} else {
    $_SESSION['status'] = "Verification token not provided.";
    header("Location: login.php");
    exit();
}

