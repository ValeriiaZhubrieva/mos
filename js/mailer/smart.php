<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$subject = $_POST['subj'];

require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

// $mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info.mos.propusk.24@gmail.com';                 // Наш логин
$mail->Password = 'ZwBhwx3u2f4b';                           // Наш пароль от ящика
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('info.mos.propusk.24@gmail.com', 'mos-propusk-24.ru');   // От кого письмо 
$mail->addAddress('info@mos-propusk-24.ru');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'From: Заявка на пропуск МОС-ПРОПУСК-24 <info@mos-propusk-24.ru';
$mail->Body    = '
	From:' . $subject . '<br> 
	Имя: ' . $name . ' <br>
	Номер телефона: ' . $phone . '';
echo '<center><b>Сообщение успешно отправлено!</b></center>';

if (!$mail->send()) {
	return false;
} else {
	return true;
}
