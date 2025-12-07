<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){

    exit();

}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/jacob/website1/vendor/autoload.php'; // Ensure the path is correct

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                      // Use SMTP
    $mail->Host = 'smtp.gmail.com';                     // Set the SMTP server
    $mail->SMTPAuth = true;                               // Enable authentication
    $mail->Username = 'jlopez271828@gmail.com';                   // SMTP username
    $mail->Password = 'wdurbdvgvpvqznpa';                     // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // TLS encryption
    $mail->Port = 587;                                    // TCP port

    // Recipients
    $mail->setFrom('jlpz271828@gmail.com', 'jlopez271828');
    $mail->addAddress('lpzboys@gmail.com', 'Gacko');

    // Content
    $mail->isHTML(true);                                  // HTML email
    $mail->Subject = 'Test Email from PHPMailer';
    $mail->Body    = '<b>This is a test email</b>';
    $mail->AltBody = 'This is a test email';

    $mail->send();
    echo 'Message has been sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}