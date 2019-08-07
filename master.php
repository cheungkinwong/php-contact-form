<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 require './vendor/autoload.php';
 $configArray = require 'config.php';
 $login = $configArray['login'];
 $errors = [];
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // 1. Sanitisation
     $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
     $name = test_input($_POST['fullname']);
     $msg = test_input($_POST['msg']);
 
     // 2. Validation    
     if (empty($name)) {
         $errors['fullname'] = "Name is required. <br />";
     } else if (!preg_match("/^([a-zA-Z' ]+)$/", $name)){
         $errors['fullname'] = "This name is invalid. <br />";
     }
     if (empty($email)) {
         $errors['email'] = "Email is required <br />";
     } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $errors['email'] = "Invalid email format <br />"; 
     }
 
     // 3. execution
     if (count($errors)> 0){
         $errors['confirm'] = "There are still errors";
     } else {
         sendMail($email, $name, $msg, $login);
         $errors['confirm'] = "Email is sent";
     }
 }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function sendMail($email, $name, $msg, $login){
    $headers = "From: $name, $email";
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';   // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                  // Enable SMTP authentication
        $mail->Username   = $login['username'];                     // SMTP username
        $mail->Password   = $login['password'];                               // SMTP password
        $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = '465';                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('no-reply@becode.com', 'Mailer');
        $mail->addAddress('cheungkin.wong@gmail.com', 'cheung Kin');     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $headers;
        $mail->Body    = $msg;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


unset($email, $msg , $name);
?>
 
