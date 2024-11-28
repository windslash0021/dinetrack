<?php
session_start();
require "connection.php";

// Include PHPMailer classes

require 'connection.php'; // Database connection
require 'phpmailer/PHPMailer-master/src/PHPMailer.php';
require 'phpmailer/PHPMailer-master/src/SMTP.php';
require 'phpmailer/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$errors = [];
$email = "";

// Send reset code using PHPMailer
function sendEmail($email, $subject, $message) {
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'jamesapostol12@gmail.com'; // Replace with your email
        $mail->Password = 'btvifgquriidyssm'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email content
        $mail->setFrom('jamesapostol12@gmail.com', 'DineTrack'); // Adjust as needed
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Forgot Password client
if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $check_email = "SELECT * FROM clients WHERE email='$email'";
    $run_sql = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(9999, 1000);
        $insert_code = "UPDATE clients SET code = $code WHERE email = '$email'";
        $run_query = mysqli_query($conn, $insert_code);

        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";

            if (sendEmail($email, $subject, $message)) {
                $info = "We've sent a password reset OTP to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed to send the reset code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    }
     else {
        $errors['email'] = "This email address does not exist!";
    }
}
// Forgot Password service
if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $check_email = "SELECT * FROM services WHERE email='$email'";
    $run_sql = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(9999, 1000);
        $insert_code = "UPDATE services SET code = $code WHERE email = '$email'";
        $run_query = mysqli_query($conn, $insert_code);

        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";

            if (sendEmail($email, $subject, $message)) {
                $info = "We've sent a password reset OTP to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed to send the reset code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    }
     else {
        $errors['email'] = "This email address does not exist!";
    }
}

// Change password
if (isset($_POST['change-password'])) {
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    if ($password !== $cpassword) {
        $errors[] = "Passwords do not match!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $email = $_SESSION['email'];

        $updatePassword = "UPDATE clients SET password='$hashedPassword' WHERE email='$email'";
        if (mysqli_query($conn, $updatePassword)) {
            session_unset();
            session_destroy();
            header('Location: login.php');
            exit();
        } else {
            $errors[] = "Failed to change your password!";
        }
    }
}

// Change password
if (isset($_POST['change-password'])) {
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    if ($password !== $cpassword) {
        $errors[] = "Passwords do not match!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $email = $_SESSION['email'];

        $updatePassword = "UPDATE services SET password='$hashedPassword' WHERE email='$email'";
        if (mysqli_query($conn, $updatePassword)) {
            session_unset();
            session_destroy();
            header('Location: login.php');
            exit();
        } else {
            $errors[] = "Failed to change your password!";
        }
    }
}