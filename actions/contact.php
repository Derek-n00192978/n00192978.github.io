<?php require_once '../config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try{
    $rules = [
        "name" => "present|minlength:7|maxlength:99",
        "email" => "present|email|minlength:7|maxlength:64",
        "message" => "present|minlength:7|maxlength:1024"
    ];
    $request->validate($rules);
    if (!$request->is_valid()) {
        throw new Exception("Please complete the form");
    }
    $email = $request->input("email");
     $message = $request->input("message");
     $name = $request->input("name");
    //Sever settings
    $mail->SMTPDebug  = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.mailtrap.io';
    $mail->SMTPAuth   = true;
    $mail->Username   = '1ddc95041cf094';
    $mail->Password   = 'a5e21469436856';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 2525;

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('info@bookworms.com', 'Information');

    //Content
    $mail->isHTML(false);
    $mail->Subject = $request->input("subject");
    $mail->Body = $request->input("message");
    $mail->AltBody = $message;

   if($mail->send()){
       echo 'message has been sent';
   }

    $request->session()->set("flash_messsage", "Message has been sent");
    $request->session()->set("flash_message_class", "alert-info");
    $request->session()->forget("flash_data");
    $request->session()->forget("flash_errors");

    $request->redirect("/views/contact.php");
}
catch (Exception $ex) {
    $request->session()->set("flash_messsage", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->forget("flash_data", $request->all());
    $request->session()->forget("flash_errors", $request->errors());

    $request->redirect("/views/contact.php");
}
?>