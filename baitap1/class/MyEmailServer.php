<?php
// Include the PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class MyEmailServer implements EmailServerInterface
{
    public function sendEmail($to, $subject, $message)
    {
        // Implementation to send email using MyEmailServer
        // Create a new PHPMailer object
        $mail = new PHPMailer(true);
        try {
            // Configure the PHPMailer object
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify SMTP server
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'thuyvucuber@gmail.com'; // SMTP username
            $mail->Password = 'kbukdbzfgirkvmft'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to
            $mail->CharSet = 'UTF-8';

            // Set email parameters
            $mail->setFrom('thuyvucuber@gmail.com', 'Vũ Văn Thủy');
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Send the email
            $mail->send();
            echo 'Email sent successfully!';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}
