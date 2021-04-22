<?php
session_start();
$name=filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
$email=filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
$password=filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
$repassword=filter_input(INPUT_POST,"repassword",FILTER_SANITIZE_SPECIAL_CHARS);
$number=filter_input(INPUT_POST,"number",FILTER_SANITIZE_NUMBER_INT);
$cooki_hash_back = $_COOKIE["cooki_hash"];
$cooki_mail_back = $_COOKIE["email"];


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

//Получаем сессию для взаимодействия с уникальным пользователем
$session_hash=$_SESSION['cooki_hash'];

$files=$_FILES["file"]["name"];
$tmppath=$_FILES["file"]["tmp_name"];
$datatime=date("d.m.Y_h.i.s");
$uploaddir="../image/avatar/";
$now='image/avatar/';
$file=$uploaddir.$datatime.transliterate($files);
$namefile=$now.$datatime.transliterate($files);

if(!$tmppath){
  $namefile ="image/avatar/".$files.'.jpg';
}
else {
if(!move_uploaded_file($tmppath,$file)) {  //функция для перемещения файла из временного хранилища
   die("Ошибка загрузки файла на сервер");
}
else{
  $user_edit= mysqli_query($connect,"UPDATE `user_tourist` SET `avatar`='$namefile' WHERE `cookies_hash`='$session_hash'");
}
}

if (isset($name)) {
    $user_edit= mysqli_query($connect,"UPDATE `user_tourist` SET `name_t`='$name' WHERE `cookies_hash`='$session_hash'");
}

if (!empty($password) && !empty($repassword)) {
    
$edit_password = mysqli_query($connect,"SELECT `password_t` FROM `user_tourist` WHERE `cookies_hash`='$session_hash'");
$array=mysqli_fetch_assoc($edit_password);
$password_t=$array["password_t"];
if(password_verify($password,$password_t)){
        $repassword = password_hash($repassword, PASSWORD_DEFAULT);
        $user_edit= mysqli_query($connect,"UPDATE `user_tourist` SET `password_t`='$repassword' WHERE `cookies_hash`='$session_hash'");
    }
else{
        exit ("Вы указали неверный текущий пароль пользователя, проверьте первое поле формы паролей, чтобы изменения вступили в силу");
}
}
//Работа с телефонным номером
$edit_number = mysqli_query($connect,"SELECT `number_t` FROM `user_tourist` WHERE `number_t`='$number' AND `cookies_hash`='$session_hash'");
$count_number=mysqli_num_rows($edit_number);
if($count_number==0){
$edit_number = mysqli_query($connect,"UPDATE `user_tourist` SET `number_t`='$number',`number_confirmation`='0' WHERE `cookies_hash`='$session_hash'");
if (!$edit_number) {
        exit ('Неверный запрос: ' . mysqli_error());
    }
}

//Работаем с почтой, проверка на изменения и совпадения в бд

$edit_mail = mysqli_query($connect,"SELECT `email_t` FROM `user_tourist` WHERE `email_t`='$email' AND `cookies_hash`='$session_hash'");
$count_mail=mysqli_num_rows($edit_mail);
if($count_mail==0){
  $e_mailreg = mysqli_query($connect,"SELECT `email_t` FROM `user_tourist` WHERE `email_t`='$email'");
  $count=mysqli_num_rows($e_mailreg);
  if ($count!=0) {
    exit("Пользователь с данным электронным адреcом уже зарегистрирован, проверьте поле ввода");
  }
  else{
        $user_edit= mysqli_query($connect,"UPDATE `user_tourist` SET `email_t`='$email',`cookies_hash`='$cooki_hash',`email_confirmation`='0' WHERE `cookies_hash`='$session_hash'");
        $_SESSION['cooki_hash'] = $cooki_hash;

      $to = $email;
      $subject = "Подтверждение электронной почты для сайта 'ALTOURUIST'";
      $message = "Вас приветствует команда поддержки сайта квест-туров 'ALTOURUIST', перейдите пожалуйста по ссылке и подтвердите адрес электронной почты: https://altouruist.ru/personal_account.php?mail=".$cooki_hash.' . Если вы не регистрировались на данном сервисе, просто проигнорируйте сообщение.';
      //да и на странице личного кабинете надо замутить функцию проверки подтверждения
      $headers = "От разработчика веб-приложения: ferenicavv@gmail.com";
      mail ($to, $subject, $message);

    if (!$user_edit) {
        exit ('Неверный запрос: ' . mysqli_error());
    }
  }
}
else{
  echo "email_static";
}

echo "Изменили";
