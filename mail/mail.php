<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $subject = 'Message from ' . $email;
    $email_content = "Name: $name\nEmail: $email\nPhone: $phone\nMessage:\n$message\n";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'shaiksaleem2831@gmail.com';
        $mail->Password = 'accp xqud jphc mzsn';  // Ensure this is secure and not publicly accessible
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('shaiksaleem2831@gmail.com', $name);

        // Add multiple recipients individually
        // $mail->addAddress('shaiksaleem2831@gmail.com');
        $mail->addAddress('richessesolutions.official@gmail.com');
        $mail->addAddress('investor@richesse.solutions');

        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $email_content;

        $mail->send();
        echo '<p>Mission Accomplished!</p>';
    } catch (Exception $e) {
        echo '<p>Oops! Something went wrong. Please try again later.</p>';
        echo 'Error: ' . $mail->ErrorInfo;
    }
} else {
    header("Location: ../contact.html");
    exit;
}
?>
