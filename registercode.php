<?php
session_start();
include ("connection.php");
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $verification_token = bin2hex(random_bytes(16));

    $expiration_time = date('Y-m-d H:i:s', strtotime('+24 hours')); // Current time + 24 hours

    $check_email_query = "SELECT email FROM users WHERE email ='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = "Email id already exists";
        header("Location: register.php");
        exit();
    } else {
        $query = "INSERT INTO users (name, role, email, password, verification_token, verification_expires, verified) VALUES ('$name', '$role', '$email', '$password', '$verification_token', '$expiration_time', 0)";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server host
                $mail->SMTPAuth = true;
                $mail->Username = 'rakibulhoque2k2@gmail.com'; // Your Gmail username
                $mail->Password = 'uqtfmvniuvkaiajk'; // Your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('your_email@gmail.com', 'Your Name'); // Your email address and name
                $mail->addAddress($email); // Recipient email address

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Verify Your Email';
                $mail->Body = "Hello $name,<br><br>Please click the following link to verify your email:<br><br>";
                $mail->Body .= "http://localhost/UserAuthenticationTask/verify_email.php?token=$verification_token";

                $mail->send();
                $_SESSION['status'] = "Verification email sent. Please check your email to verify your account.";
                header("Location: register.php");
                exit();
            } catch (Exception $e) {
                $_SESSION['status'] = "Failed to send verification email";
                header("Location: register.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Failed to register user";
            header("Location: register.php");
            exit();
        }
    }
}





