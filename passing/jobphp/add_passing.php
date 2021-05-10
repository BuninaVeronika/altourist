<?php
session_start();

include_once("../../include/bd.php");
global $connect;

$id_quests = filter_input(INPUT_POST, "id_quests", FILTER_SANITIZE_SPECIAL_CHARS);
$time = filter_input(INPUT_POST, "time", FILTER_SANITIZE_SPECIAL_CHARS);
$id_task_passing = filter_input(INPUT_POST, "id_task_passing", FILTER_SANITIZE_SPECIAL_CHARS);

$time_end = date("H:i:s");
$cooki_hash_s = $_SESSION['cooki_hash'];
$s_mail = mysqli_query($connect, "SELECT * FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");
$arys = mysqli_fetch_assoc($s_mail);
$id_t = $arys["id_t"];
$role_admin = $arys["role_admin"];
$url_result = '';
if (!empty($cooki_hash)) {
    die("Ошибка доступа пользователя!");
}

$dostup = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_t`='$id_t' AND `id_quests`='$id_quests' AND `status`='0'");
$dostup_count = mysqli_num_rows($dostup);
if ($dostup_count == 0 && $role_admin == 0) {
    exit('У вас нет доступа к данному квесту или редактирование невозможно, потому модератор утвердил его');
}


$add_quest = mysqli_query($connect, "INSERT INTO `passing`(`id_t`, `id_task_passing`, `time_start`, `time_end`, `id_quests`) VALUES ('$id_t','$id_task_passing','$time','$time_end','$id_quests')");
if (!$add_quest) {
    exit ('Неверный запрос: ' . mysqli_error());
} else {
    $passing_arr = mysqli_query($connect, "SELECT `id_task_passing`, `id_task` FROM `task` WHERE `id_quests`='$id_quests'");

    for ($i = 0; $i < mysqli_num_rows($passing_arr); $i++) {
        $passing_result = mysqli_fetch_assoc($passing_arr);
        $id_task_passing_res = $passing_result['id_task_passing'];
        $id_task_res = $passing_result['id_task'];
        if ($id_task_passing === $id_task_passing_res) {
            $result_task = true;
            continue;
        } elseif ($result_task === true) {
            $url_result = url_redirect($id_task_res) . '.php?id_task_passing=' . $id_task_passing_res;
            break;
        } else {
            continue;
        }
    }
    echo $url_result;
}
function url_redirect($id_task)
{
    $url = ["", "photo", "text_recognition", "face_recognition", "geodata", "image_comparison", "qr_photo", "voice_recognition", "text"];

    $result = $url[$id_task];

    return $result;
}