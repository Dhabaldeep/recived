<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

$mail = new PHPMailer(true);

if (isset($_POST['send'])) {

    // print_r($_FILES);

    $attachments = $_FILES['attachment']['name'];



    for ($i = 0; $i < count($attachments); $i++) {
        $file_tmp = $_FILES['attachment']['tmp_name'][$i];
        $file_name = $_FILES['attachment']['name'][$i];
        if ($file_name != null) {


            if (move_uploaded_file($file_tmp, "uploads/" . $file_name)) {
                $mail->addAttachment("uploads/" . $file_name);
            }
        }
    }


    $email = $_POST['email'];
    $subject = $_POST['subject'];

    try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username = "";
        $mail->Password = "";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('', '');
        $mail->addAddress($email);               //Name is optional





        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = 'This is the <b>File!</b><br/><br/><br/></b>';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $_SESSION['msg'] = "Attachments are successfully sent to <br/><b>" . $email . "</b>";
        echo '<script>window.location.href="index.php?message_sent";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $code = $_POST['code'];

    try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username = "";
        $mail->Password = "";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('', '');
        $mail->addAddress($email);               //Name is optional


        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = 'This is the <b>Code!</b><br/><br/><br/><b>' . $code . '</b>';
        // $mail->AltBody = $code;

        $mail->send();
        $_SESSION['msg'] = "Your Attachments are successfully sent to <b>" . $email . "</b>";
        echo '<script>window.location.href="index.php?message_sent";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
