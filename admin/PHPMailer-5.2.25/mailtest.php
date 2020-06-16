<?php

 include_once('PHPMailerAutoload.php');

 require_once('class.smtp.php');



$mail = new PHPMailer();
$mail->IsMail();
$mail->CharSet = 'UTF-8';

$mail->Host       = "smtp.gmail.com"; // SMTP server example
//$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
$mail->Username   = "talhamubashar0012@gmail.com"; // SMTP account username example
$mail->Password   = "arfaamir";        // SMTP account password example

$mail->From = "talhamubashar0012@gmail.com";
$mail->FromName = "comsats";

$mail->AddAddress('talhatalha0012@gmail.com'); 
$mail->AddReplyTo("talhamubashar0012@gmail.com", 'Talha Mubashar');

$mail->IsHTML(true);

$mail->Subject = "Contact Form from DigitDevs Website";

$mail->Body    =  "Mail successful";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
exit;
}
 echo 'Message has been sent';

 ?>