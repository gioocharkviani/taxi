<?php

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST['company_name'];
    $person = $_POST['person'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // Email details
    $to = "info@tbilrides.ge";
    $subject = "New Contact from $company_name";
    $message = "Company Name: $company_name\nPerson: $person\nCity: $city\nEmail: $email\nContact: $contact";

    // SMTP configuration
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tbilrides@gmail.com'; 
        $mail->Password = 'nztt fkbd whpr ebtr';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port = 465;

        // Sender and recipient settings
        $mail->setFrom("$email" , "$company_name"); 
        $mail->addAddress($to); 

        // Email content
        $mail->isHTML(false); 
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        echo "Email sent successfully!";
    } catch (Exception $e) {
        http_response_code(500);
        echo "Email sending failed! Error: {$mail->ErrorInfo}";
    }
}
?>