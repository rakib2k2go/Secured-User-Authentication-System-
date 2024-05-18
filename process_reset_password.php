<?php
session_start();
include("connection.php");

if(isset($_POST['reset_password_btn'])) {
    if(isset($_POST['password'], $_POST['confirm_password'], $_GET['token'])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $token = $_GET['token'];

        if($password !== $confirm_password) {
            $_SESSION['reset_password_error'] = "Passwords do not match.";
            header("Location: reset_password.php?token=$token");
            exit();
        }

        $check_token_query = "SELECT * FROM password_change_requests WHERE verification_token = '$token' LIMIT 1";
        $check_token_result = mysqli_query($conn, $check_token_query);

        if(mysqli_num_rows($check_token_result) > 0) {
            $row = mysqli_fetch_assoc($check_token_result);
            $expiration_time = strtotime($row['expiration_time']);
            
            if($expiration_time >= time()) {
                $email = $row['email'];

                $update_password_query = "UPDATE users SET password = '$password' WHERE email = '$email'";
                $update_password_result = mysqli_query($conn, $update_password_query);

                if($update_password_result) {
                    $delete_token_query = "DELETE FROM password_change_requests WHERE verification_token = '$token'";
                    $delete_token_result = mysqli_query($conn, $delete_token_query);

                    $_SESSION['reset_password_success'] = "Your password has been reset successfully. You can now login with your new password.";
                    header("Location: login.php");
                    exit();
                } else {
                    $_SESSION['reset_password_error'] = "Failed to update password. Please try again later.";
                    header("Location: reset_password.php?token=$token");
                    exit();
                }
            } else {
                $_SESSION['reset_password_error'] = "Reset password link has expired. Please request a new one.";
                header("Location: forgot_password.php");
                exit();
            }
        } else {
            $_SESSION['reset_password_error'] = "Invalid reset password link. Please request a new one.";
            header("Location: forgot_password.php");
            exit();
        }
    } else {
        $_SESSION['reset_password_error'] = "Please fill out all fields.";
        header("Location: reset_password.php?token=$token");
        exit();
    }
} else {
    header("Location: forgot_password.php");
    exit();
}

