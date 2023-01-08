<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = "your-own-email@gmail.com";   // enter your own email address
$mail->Password = "your-own-app-password";  // enter your own app password
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

if (isset($_POST['submit'])) {

    $mail->setFrom('your-own-email@gmail.com');
    $mail->addAddress($_POST['email']);
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body = $_POST['body'];
    $mail->send();

    $_SESSION['status'] = "email sent successfully";
    $_SESSION['email'] = $_POST['email'];
} else {
    $_SESSION['status'] = "Please try again";
}
header("location:index.php");
