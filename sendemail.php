<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['name'], $_POST['email'], $_POST['message'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Dodatna validacija na serverskoj strani
    if (empty($name) || empty($email) || empty($message)) {
        echo 'Molimo popunite sva polja.';
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'janaijoca2003@gmail.com';
        $mail->Password = 'miulttwuiixkhlxe';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('janaijoca2003@gmail.com', 'Funda of Web IT');
        $mail->addAddress('janaijoca2003@gmail.com', 'Funda of Web IT');

        $mail->isHTML(true);
        $mail->Subject = 'Nova poruka - Funda of web it kontakt forma';
        $bodyContent = '<div>Zdravo, dobili ste novu poruku</div>
            <div>Ime: '.$name.'</div>
            <div>Email: '.$email.'</div>
            <div>Poruka: '.$message.'</div>';
        $mail->Body = $bodyContent; 
        
        if($mail->send()) {
            echo 'Vaša poruka je uspešno poslata!';
        } else {
            echo 'Greška prilikom slanja poruke. Molimo pokušajte ponovo.';
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Molimo popunite sva polja.';
}
?>
