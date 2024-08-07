<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['submitContact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'janaijoca2003@gmail.com';
        $mail->Password = 'miulttwuiixkhlxe';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('janaijoca2003@gmail.com', 'Squadra');
        $mail->addAddress('janaijoca2003@gmail.com', 'Squadra');

        $mail->isHTML(true);
        $mail->Subject = 'New enquiry - Squadra Contact Form';

        $bodyContent = '<div>Hello, you got a new enquiry</div>
            <div>Ime: ' . $name . '</div>
            <div>Email: ' . $email . '</div>
            <div>Message: ' . $message . '</div>';

        $mail->Body = $bodyContent;

        if ($mail->send()) {
            $_SESSION['status'] = "Thank you for contacting us - Team Squadra Perfetta";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit(0);
        } else {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit(0);
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header('Location: index.html');
    exit(0);
}
?>
