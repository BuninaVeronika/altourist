<?php
session_start();
$id_quest = filter_input(INPUT_POST, "id_quest", FILTER_SANITIZE_SPECIAL_CHARS);
include_once("../include/bd.php");
global $connect;

$email = $_COOKIE["email"];
$cooki_hash_s = $_SESSION['cooki_hash'];
if (!empty($email)) {
    $s_mail = mysqli_query($connect, "SELECT `id_t` FROM `user_tourist` WHERE `email_t`='$email'");
} elseif (!empty($cooki_hash_s)) {
    $s_mail = mysqli_query($connect, "SELECT `id_t` FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");
} else {
    exit("Авторизуйтесь или Зарегистрируйтесь на сайте, чтобы иметь возможность проходить квесты.");
}
$arys = mysqli_fetch_assoc($s_mail);
$id_t = $arys["id_t"];

$passing = mysqli_query($connect, "SELECT * FROM `passing` WHERE `id_t`='$id_t' AND `id_quests`='$id_quest' ORDER BY id DESC LIMIT 1");
if (mysqli_num_rows($passing) > 0) {
    $passing_array = mysqli_fetch_assoc($passing);
    $id_task_passing = $passing_array['id_task_passing'];
    $id_quests = $passing_array['id_quests'];

    $passing_arr = mysqli_query($connect, "SELECT `id_task_passing`, `id_task` FROM `task` WHERE `id_task_passing`='$id_task_passing'");

    for ($i = 0; $i < mysqli_num_rows($passing_arr); $i++) {
        $passing_result = mysqli_fetch_assoc($passing_arr);
        $id_task_passing_res = $passing_result['id_task_passing'];
        $id_task_res = $passing_result['id_task'];
        if ($id_task_passing === $id_task_passing_res) {
            $result_task = true;
            continue;
        } elseif ($result_task === true) {
            $url_result = url_redirect($id_task_res);
            $url_result .= '.php?$id_task_passing=' . $id_task_passing_res;
            echo $url_result;
            break;
        } else {
            continue;
        }
    }

} else {
    $passing = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_quests`='$id_quest' LIMIT 1");

    $passing_result = mysqli_fetch_assoc($passing);
    $id_task_passing_now = $passing_result['id_task_passing'];
    $id_task_now = $passing_result['id_task'];

    $url_result = url_redirect($id_task_now);
    $url_result .= '.php?$id_task_passing=' . $id_task_passing_now;
    echo $url_result;

}
function url_redirect($id_task)
{
    $url[] = ['photo', 'text_recognition', 'face_recognition', 'geodata', 'image_comparison', 'qr_photo', 'voice_recognition', 'text'];
    $i = 1;
    foreach ($url as $str) {
        if ($i === $id_task) {
            return $str;
            break;
        }
        $i++;
    }
}