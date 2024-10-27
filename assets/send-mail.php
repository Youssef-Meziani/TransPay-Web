<?php
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["email"])) {
    $email = $_POST["email"];
    if (!empty($email)) {

        $code = $_POST['code'];

        // Create a new PHPMailer instance
        $mail = new PHPMailer();

        // Configure the email settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Replace with your SMTP host
        $mail->Port = 587;  // Replace with the appropriate port
        $mail->SMTPAuth = true;
        $mail->Username = 'test@gmail.com';  // Replace with your SMTP username
        $mail->Password = '';  // Replace with your SMTP password
        $mail->SMTPSecure = 'tls';

        $mail->setFrom('test@gmail.com', 'TransPay');  // Replace with your own email and name
        $mail->addAddress($email);  // Add the recipient email address
        $mail->isHTML(true);
        $mail->Subject = 'TransPay Verification Code';
        $mail->Body = 'Your verification code is: <h1>' . $code . '</h1>';

        // Send the email
        if ($mail->send()) {
            echo 'true';
        } else {
            echo $mail->ErrorInfo;
            echo 'false';
        }
        die;
    }
}
echo 'false';