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
$files=$_FILES["file"]["name"] ?? '';
$tmppath=$_FILES["file"]["tmp_name"] ?? '';
$datatime=date("d.m.Y_h.i.s");
$uploaddir="../image/quest/";
$now='image/quest/';
$file=$uploaddir.$datatime.transliterate($files);
$namefile=$now.$datatime.transliterate($files);



if(!$files){
	$namefile ="";
}
else {
$image = new SimpleImage();
$image->load($tmppath); // исходная картинка
$image->scale(99.9);
$image->save($file); // сжатая картинка

}
$cooki_hash_s=$_SESSION['cooki_hash'];

if(!empty($cooki_hash)){
	 die("Ошибка доступа пользователя!");
}

$s_mail = mysqli_query($connect,"SELECT `id_t` FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");
$arys=mysqli_fetch_assoc($s_mail);
$id_t=$arys["id_t"];

$add_quest = mysqli_query($connect,"INSERT INTO `quests_altrst`(`quests_name`, `text_quests`, `reiting`, `file`, `age`, `sale`, `time`, `complication`, `id_t`, `status`, `id_location`, `id_section`,`distance`, `man`) VALUES ('$name','$text','0','$namefile','$v','$s','$t','$h','$id_t','0','$location','$section','$distance','$man')");
if (!$add_quest) {
        exit ('Неверный запрос: ' . mysqli_error($connect));
    }
else{
    $quest = mysqli_query($connect, "SELECT * FROM `quests_altrst` ORDER BY `id_quests` DESC LIMIT 1");
    $ar = mysqli_fetch_assoc($quest);
    $id_quests = $ar["id_quests"];
    $data_time = date('Y/m/d H:i:s');
    $put_aside = mysqli_query($connect, "INSERT INTO `quest_purchases`(`id_t`, `id_quests`, `data_price`) VALUES ('$id_t','$id_quests','$data_time')");
}
echo $id_quests;