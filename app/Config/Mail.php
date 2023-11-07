<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use Webrium\Mail;


$mail = new PHPMailer(true);

if(env('mail_is_smtp') == 'true'){
  $mail->isSMTP(); // Send using SMTP
  $mail->SMTPAuth = true; // Enable SMTP authentication
}

if(env('mail_smtp_debug') == 'true'){
  $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
}

if(env('mail_smtp_tls') == 'true'){
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
}

$mail->Host       = env('mail_host');
$mail->Username   = env('mail_username');
$mail->Password   = env('mail_password');
$mail->Port       = env('mail_port'); // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
$mail->CharSet = 'UTF-8';

Mail::addConfig('main', $mail );
