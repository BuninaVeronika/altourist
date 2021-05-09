<?php
session_start();

include_once("../include/bd.php");
include_once("../include/translite.php");
include_once("../include/resize.php");
global $connect;
$text=filter_input(INPUT_POST,"text",FILTER_SANITIZE_SPECIAL_CHARS);
$hint=filter_input(INPUT_POST,"hint",FILTER_SANITIZE_SPECIAL_CHARS);
$answer=filter_input(INPUT_POST,"answer",FILTER_SANITIZE_SPECIAL_CHARS);
$time = filter_input(INPUT_POST, "time", FILTER_SANITIZE_SPECIAL_CHARS);
$ansver1 = filter_input(INPUT_POST, "ansver1", FILTER_SANITIZE_SPECIAL_CHARS);
$ansver2 = filter_input(INPUT_POST, "ansver2", FILTER_SANITIZE_SPECIAL_CHARS);
$id_quest_value = filter_input(INPUT_POST, "id_quest_value", FILTER_SANITIZE_SPECIAL_CHARS);
$id_task = filter_input(INPUT_POST, "id_task", FILTER_SANITIZE_SPECIAL_CHARS);

$coordinates = $ansver1 . '|' . $ansver2;

$files = $_FILES["file"]["name"] ?? '';
$tmppath = $_FILES["file"]["tmp_name"] ?? '';
$uploaddir = "../passing/jobphp/task/";
$now = 'task/';
$file = $uploaddir . $id_quest_value . '_' . $id_task . '_' . transliterate($files);
$namefile = $now . $id_quest_value . '_' . $id_task . '_' . transliterate($files);

if (!$files) {
    $namefile = "";
} else {
    $image = new SimpleImage();
    $image->load($tmppath); // исходная картинка
    $image->scale(99.9);
$image->save($file); // сжатая картинка

}

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


$add_quest = mysqli_query($connect,"INSERT INTO `task`(`id_task`, `id_quests`, `inf_task_text`, `answer`, `hint`, `status`, `time`, `coordinates`, `file_url`) VALUES ('$id_task','$id_quest_value','$text','$answer','$hint','0','$time','$coordinates','$namefile')");
if (!$add_quest) {
        exit ('Неверный запрос: ' . mysqli_error());
    }
else{
	$quest = mysqli_query($connect,"SELECT * FROM `task` ORDER BY `id_task_passing` DESC LIMIT 1");
	$ar=mysqli_fetch_assoc($quest);
	$id_task_passing=$ar["id_task_passing"];
}
echo $id_task_passing;