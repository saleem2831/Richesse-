<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid email format"]);
        exit;
    }

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

        $mail->addAddress('richessesolutions.official@gmail.com');
        $mail->addAddress('investor@richesse.solutions');

        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $email_content;

        $mail->send();
        echo json_encode(["success" => "Mission Accomplished!"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Oops! Something went wrong: " . $e->getMessage()]);
    }
    exit; // Ensure that the script stops here
}
