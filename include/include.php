<?php
session_start();
function header_block(){
print <<<header
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Altouruist</title>
    <meta charset="utf-8">
    <meta name="robots" content="index">
    <meta name="description" content="Квест-туры в разных городах и тематиках прохождения. Поробуй исследовать и создавать досуг на своих правилах.">
    <meta name="keywords" content="квесты, туры, туризм, городская среда, путешествия, курск, ">
    <meta name="author" content="Бунина Вероника">
    <link rel="icon" href="img/logo1.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/style_other.css">
    <link rel="stylesheet" type="text/css" href="css/style_form.css">
    <script defer src="js/jquery_3.5.1.min.js"></script>
    <script defer src="js/jq_cookie.js"></script>
    <script defer src="js/head_other.js"></script>
    <script defer src="js/form_js.js"></script>
</head>
<body>

    <!--Надо будет вставить на всех достпуных для просмотрах страницах-->
    <div class="kies" id='cookies_class'>
    <input type="button" name="" id='cookies_ok' value="ОК">
    <p>Используя данный сайт, вы даете согласие на использование файлов cookie, данных о местоположении и IP-адрес, помогающих нам сделать сервис удобнее для вас. <a href=''>Подробнее</a></p>
    </div>
    <!--Скорей всего выведем в подзагрузку шапку сайта-->

    <header id='head_top'> 
    <a href='index.php'><img class='logo_img' src="img/logo1.svg">
    <h3 class='logo_title'>altouruist</h3></a>
    <div class='nav_right'>
        <input type="text" name="search" class="input_search" pattern="^[?!,-.а-яА-ЯёЁ0-9\s]+$"><input type="button" class='button_check' name="search_button" value="&#xe800;" id='search_button'>
        <input  type="button"  id='reg_button' name="reg_button" class='button_check' value="&#xf2be;" >
    </div>
    </header>   
header;
}

function footer_block(){
print<<<footer
        <footer>
    <div class='foot_block'>
    <a name="contact"></a>  
        <p style="color: #9DC88D;">&#169; 2020-2021 "Альтуруист"- Активный и пассивный досуг на твоих правилах.</p>
        <a href='../index.php'><img class='logo_img' src="../img/logo1.svg"></a>
    </div>
    <div class='foot_block'>
        <h6>Контактные ресурсы</h6>
        <email><p style='margin: -1px 10px 0 0;color: #9DC88D;' class="icon">&#xe809;</p>Top@gmail.com</email>
        <a class="icon_list" title='ВК' href="#">&#xf189;</a>
        <a class="icon_list" title='ИНСТАГРАМ' href="#">&#xf16d;</a>
        
    </div>
    <div class='foot_block'>
        <h6>Внутренние документы</h6>
        <a>Политика конфеденциальности</a>
        <a>О деятельности компании</a>
        <a>Публичная оферта</a>
    </div>
    <div class='foot_block'>
        <h6>Инструкции по функционалу</h6>
        <a><p style='margin: -5px 5px 0 0;' class="icon_list">&#xe807;</p>Прохождение квеста</a>
        <a><p style='margin: -5px 5px 0 0;' class="icon_list">&#xe807;</p>Регистрация квеста</a>
    </div>
        <a href="#top" style='margin-left: 25px; font-size: 75px; color:#F1B24A; border:none;' class="icon">&#xf139;</a>
        <address>Разработчик: <a href="https://www.behance.net/ferenicavv">Бунина Вероника</a></address>
    </footer>
footer;
}

function cookie(){

print<<<cook
    <div class="kies" id='cookies_class'>
    <input type="button" name="" id='cookies_ok' value="ОК">
    <p>Используя данный сайт, вы даете согласие на использование файлов cookie, данных о местоположении и IP-адрес, помогающих нам сделать сервис удобнее для вас. <a href=''>Подробнее</a></p>
    </div>
cook;

}
include_once 'bd.php';


function verification_of_authorization(){
  global $connect;
  $email=$_COOKIE["email"];

  if(!$email){

    $cooki_hash_s=$_SESSION['cooki_hash'];

    $s_mail = mysqli_query($connect,"SELECT `cookies_hash` FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");

    $arys=mysqli_fetch_assoc($s_mail);
    $cookies_hash_bd=$arys["cookies_hash"];
    $count=mysqli_num_rows($s_mail);

    if (!$s_mail) {
        exit ('Неверный запрос: ' . mysqli_error());
    }
    elseif ($count==0) {
    exit ( "<script>window.location.href='registration.php';</script>");    
    }
    else{
        if($cooki_hash_s==$cookies_hash_bd){
        echo "Все хорошо";   
        }
        else{
        exit ( "<script>window.location.href='registration.php';</script>");
        
        }
    }
  }

  else{

  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  //создаем куки для входа
  $cooki=$ip.'_'.$email;

  $cooki_hash=$_COOKIE["cooki_hash"];

  $e_mail = mysqli_query($connect,"SELECT `cookies_hash` FROM `user_tourist` WHERE `email_t`='$email' AND `cookies_hash`='$cooki_hash'");
  $ary=mysqli_fetch_assoc($e_mail);
  $cookies_hash=$ary["cookies_hash"];
if (!$e_mail) {
        exit ('Неверный запрос: ' . mysqli_error());
    }
else{
   if(password_verify($cooki,$cookies_hash)){
        $_SESSION['cooki_hash']=$cookies_hash;
       // echo "Все хорошо";
    }
    else{
        exit ( "<script>window.location.href='registration.php';</script>");        
        }
    }
}
}
