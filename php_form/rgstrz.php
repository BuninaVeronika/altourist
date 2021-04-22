<?php
session_start();
$name=filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
$email=filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
$password=filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
$number=filter_input(INPUT_POST,"number",FILTER_SANITIZE_NUMBER_INT);
$date=date('Y-m-d');

//хеширование пароля
$hash = password_hash($password, PASSWORD_DEFAULT);

//Получение ипи адреса пользователя
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
//создаем куки для входа
$cooki=$ip.'_'.$email;
$cooki_hash = password_hash($cooki, PASSWORD_DEFAULT);

setcookie('email',$email,strtotime("+4 week"),'/');
setcookie('cooki_hash',$cooki_hash,strtotime("+4 week"),'/');

include_once('../include/translite.php');
include_once '../include/bd.php';
global $connect;

$files=$_FILES["file"]["name"] ?? '';
$tmppath=$_FILES["file"]["tmp_name"] ?? '';
$datatime=date("d.m.Y_h.i.s");
$uploaddir="../image/avatar/";
$now='image/avatar/';
$file=$uploaddir.$datatime.transliterate($files);
$namefile=$now.$datatime.transliterate($files);

if (empty($email) || empty($password)){
    exit("Пожалуйста, заполните все обязательные поля");
}
if (isset($_POST['sogl']) && $_POST['sogl'] == 'Yes'){
}
else{
    exit("Подтвердите согласие с пользовательским соглашением, чтобы иметь доступ к предоставляемым услугам сервиса.");
}

$e_mailreg = mysqli_query($connect,"SELECT `email_t` FROM `user_tourist` WHERE `email_t`='$email'");
$count=mysqli_num_rows($e_mailreg);
if ($count!=0) {
    exit("Пользователь с данным электронным адреcом уже зарегистрирован, проверьте адрес электронной почты или восстановите пароль");
}
if(isset($_POST['ras_email']) && $_POST['ras_email'] == 'Yes')
{
    $mailing_email= $connect->query("INSERT INTO `mailing_email`(`email_t`) VALUES ('$email')");

    if (!$mailing_email) {
        exit ('Неверный запрос: ' . mysqli_error($connect));
    }
}
if(!$files){
    $intNum=rand(1, 5);
    $namefile ="image/avatar/".$intNum.'.jpg';
}
else {
    if(!move_uploaded_file($tmppath,$file)) {  //функция для перемещения файла из временного хранилища
        die("Ошибка загрузки файла на сервер");
    }
}

//создаем данные в сессии на случай, если у пользователя выключены куки файлы

$userreg= $connect->query("INSERT INTO `user_tourist`(`name_t`, `email_t`, `password_t`, `number_t`, `cookies_hash`, `rating`, `avatar`,`email_confirmation`,`number_confirmation`, `date_of_visit`) VALUES ('$name','$email','$hash','$number','$cooki_hash','0','$namefile','0','0','$date')");

if (!$userreg) {
    exit ('Неверный запрос: ' . mysqli_error($connect));
}
else{
    $_SESSION['cooki_hash'] = $cooki_hash;
    echo 'Зарегистрирован';
}

$to = $email;
$subject = "Подтверждение электронной почты для сайта 'ALTOURUIST'";
$message = "Вас приветствует команда поддержки сайта квест-туров 'ALTOURUIST', перейдите пожалуйста по ссылке и подтвердите адрес электронной почты: https://altouruist.ru/personal_account.php?mail=".$cooki_hash.' .Если вы не регистрировались на данном сервисе, просто проигнорируйте сообщение.';
//да и на странице личного кабинете надо замутить функцию проверки подтверждения
$headers = "От разработчика веб-приложения: ferenicavv@gmail.com";
mail ($to, $subject, $message);