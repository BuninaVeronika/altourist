<?php
session_start();
include_once("../include/bd.php");

global $connect;
$id_quest_value=filter_input(INPUT_POST,"id_quest",FILTER_SANITIZE_SPECIAL_CHARS);

$cooki_hash_s=$_SESSION['cooki_hash'];
$s_mail = mysqli_query($connect,"SELECT * FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");
$arys=mysqli_fetch_assoc($s_mail);
$id_t=$arys["id_t"];
$role_admin=$arys["role_admin"];

if(!empty($cooki_hash)){
	 die("Ошибка доступа пользователя!");
}

$add_quest = mysqli_query($connect,"DELETE FROM `deferred_quests` WHERE `id_quests`='$id_quest_value' AND `id_t`='$id_t' ");

if (!$add_quest) {
        exit ('Неверный запрос: ' . mysqli_error($connect));
    }
else{
	echo 'Удалили';
}
