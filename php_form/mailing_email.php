<?php
session_start();
include_once("../include/bd.php");

global $connect;
$id_quest_value=filter_input(INPUT_POST,"id_quest",FILTER_SANITIZE_SPECIAL_CHARS);

$cooki_hash_s=$_SESSION['cooki_hash'];
$s_mail = mysqli_query($connect,"SELECT * FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");
$arys=mysqli_fetch_assoc($s_mail);
$email_t=$arys["email_t"];

if(!empty($cooki_hash)){
	 die("Ошибка доступа пользователя!");
}

$add_quest = mysqli_query($connect,"DELETE FROM `mailing_email` WHERE `email_t`='$email_t' ");

if (!$add_quest) {
        exit ('Неверный запрос: ' . mysqli_error($connect));
    }
else{
    header("Refresh:0; url=../personal_account.php");
    echo "<script>alert('Ваш электронный адрес удален из рассылки.');</script>";
}
