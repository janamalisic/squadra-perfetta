<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prikupljanje podataka iz forme
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Vaša mejl adresa
    $to = "janaijoca2003@gmail.com";
    $subject = "Nova poruka sa web sajta";

    // Sadržaj mejla
    $body = "Ime: $name\n";
    $body .= "Email: $email\n";
    $body .= "Poruka: \n$message\n";

    // Headeri mejla
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Slanje mejla
    if (mail($to, $subject, $body, $headers)) {
        echo "Poruka je uspešno poslata.";
    } else {
        error_log("Greška pri slanju mejla: " . error_get_last()['message']);
        echo "Došlo je do greške pri slanju poruke.";
    }
}
?>
