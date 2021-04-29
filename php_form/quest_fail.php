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

$dostup=mysqli_query($connect,"SELECT * FROM `quests_altrst` WHERE `id_t`='$id_t' AND `id_quests`='$id_quest_value' AND `status`='0'");
$dostup_count=mysqli_num_rows($dostup);
if($dostup_count==0 && $role_admin==0){exit('У вас нет доступа к данному квесту или редактирование невозможно, потому модератор утвердил его');}


$add_quest = mysqli_query($connect,"UPDATE `quests_altrst` SET `status`='-1' WHERE `id_quests`='$id_quest_value' ");
if (!$add_quest) {
        exit ('Неверный запрос: ' . mysqli_error($connect));
    }
else{
	echo 'Отклонили';
}
