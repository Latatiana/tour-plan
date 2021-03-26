<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
// вторая форма
$sub = $_POST['sub'];
// Формирование самого письма
$title2 = "Подписка Best Tour Plan";
$body2 = "
<h2>subscribe</h2>
<b>Имя:</b> $sub
";
// Формирование самого письма
$title = "Новое обращение Best Tour Plan";
$body1 = "
<h2>Новое обращение</h2>
<b>Имя:</b> $name<br>
<b>Телефон:</b> $phone<br><br>
<b>Сообщение:</b><br>$message
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    // $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты

    // Получатель письма
    $mail->addAddress('tan.laktionova@yandex.ru');  
 if (empty($_POST['name'] && $_POST['phone'] )&&!empty($_POST['sub'])) {
    $mail->isHTML(true);
    $mail->Subject = $title2;
    $mail->Body = $body2;  
    // Проверяем отравленность сообщения
    if ($mail->send()) {$result = "success";} 
    else {$result = "error";}
    header('Location: thankyou.html');
}
elseif (!empty($_POST['name'] && $_POST['phone'] )&&empty($_POST['sub'])) {
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body1;    

    // Проверяем отравленность сообщения
    if ($mail->send()) {$result = "success";} 
    else {$result = "error";}
    header('Location: thankyou.html');
}  
