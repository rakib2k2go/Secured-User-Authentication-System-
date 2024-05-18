<?php
session_start();
include("connection.php");
require 'vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['email'])) {
    $email = $_POST['email'];

    $check_email_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $check_email_result = mysqli_query($conn, $check_email_query);

    if(mysqli_num_rows($check_email_result) > 0) {

        $verification_token = bin2hex(random_bytes(16)); // Generate a 32-character hexadecimal string
        
        $expiration_time = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        $insert_query = "INSERT INTO password_change_requests (email, verification_token, created_at, expiration_time) VALUES ('$email', '$verification_token', NOW(), '$expiration_time')";
        $insert_result = mysqli_query($conn, $insert_query);

        if($insert_result) {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server host
                $mail->SMTPAuth = true;
                $mail->Username = 'habibulbasher01644@gmail.com'; // Your Gmail username
                $mail->Password = 'byvxbabdxepvjais'; // Your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                //Recipients
                $mail->setFrom('your-email@gmail.com', 'Your Name');
                $mail->addAddress($email); // Recipient email address

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Reset Your Password';
                $mail->Body = "Hello,<br><br>You have requested to reset your password. Click the following link to reset it:<br><br>";
                $mail->Body .= "http://localhost/UserAuthenticationTask/reset_password.php?token=$verification_token";

                $mail->send();
                $_SESSION['forgot_password_success'] = "An email with instructions to reset your password has been sent to your email address.";
                header("Location: forgot_password.php");
                exit();
            } catch (Exception $e) {
                $_SESSION['forgot_password_error'] = "Failed to send reset password email";
                header("Location: forgot_password.php");
                exit();
            }
        } else {
            $_SESSION['forgot_password_error'] = "Failed to process your request. Please try again later.";
            header("Location: forgot_password.php");
            exit();
        }
    } else {
        echo "The email address entered does not exist. Please enter a valid email address.";
    }
}

