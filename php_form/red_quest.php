<?php
session_start();
include_once("../include/bd.php");
include_once("../include/translite.php");
include_once("../include/resize.php");
global $connect;
$name=filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
$text=filter_input(INPUT_POST,"text",FILTER_SANITIZE_SPECIAL_CHARS);
$v=filter_input(INPUT_POST,"v",FILTER_SANITIZE_SPECIAL_CHARS);
$s=filter_input(INPUT_POST,"s",FILTER_SANITIZE_SPECIAL_CHARS);
$t=filter_input(INPUT_POST,"t",FILTER_SANITIZE_SPECIAL_CHARS);
$h=filter_input(INPUT_POST,"h",FILTER_SANITIZE_SPECIAL_CHARS);
$distance=filter_input(INPUT_POST,"distance",FILTER_SANITIZE_SPECIAL_CHARS);
$man=filter_input(INPUT_POST,"man",FILTER_SANITIZE_SPECIAL_CHARS);
$section=filter_input(INPUT_POST,"section",FILTER_SANITIZE_SPECIAL_CHARS)?? '0';
$location=filter_input(INPUT_POST,"location",FILTER_SANITIZE_SPECIAL_CHARS)?? '0';
$id_quest_value=filter_input(INPUT_POST,"id_quest_value",FILTER_SANITIZE_SPECIAL_CHARS);

$files=$_FILES["file"]["name"] ?? '';
$tmppath=$_FILES["file"]["tmp_name"] ?? '';
$datatime=date("d.m.Y_h.i.s");
$uploaddir="../image/quest/";
$now='image/quest/';
$file=$uploaddir.$datatime.transliterate($files);
$namefile=$now.$datatime.transliterate($files);

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

if(!$files){
	$namefile ="";
}
else {
$image = new SimpleImage();
$image->load($tmppath); // исходная картинка
$image->scale(99.9);
$image->save($file); // сжатая картинка

}

$add_quest = mysqli_query($connect,"UPDATE `quests_altrst` SET `quests_name`='$name',`text_quests`='$text',`file`='$namefile',`age`='$v',`sale`='$s',`time`='$t',`complication`='$h',`id_location`='$location',`id_section`='$section',`distance`='$distance',`man`='$man' WHERE `id_quests`='$id_quest_value' ");
if (!$add_quest) {
        exit ('Неверный запрос: ' . mysqli_error($connect));
    }
else{
	echo 'Отредактировали';
}
