<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function custom_mail($to, $subject, $message)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug =0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $_ENV['MAIL_HOST'];             //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $_ENV['MAIL_USERNAME'];                       //SMTP username
        $mail->Password   = $_ENV['MAIL_PASSWORD'];                       //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption
        $mail->Port       = $_ENV['MAIL_PORT'];                                    //TCP port to connect to

        //Recipients
        $mail->setFrom($_ENV['MAIL_FROM'], 'Mailer');        //Replace with your email
        $mail->addAddress($to);                                    //Add recipient
        $mail->addReplyTo($_ENV['MAIL_REPLY_TO'], 'Information');

        //Content
        $mail->isHTML(true);                                       //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = $message;
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
