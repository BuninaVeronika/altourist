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
    exit("Авторизуйтесь или Зарегистрируйтесь на сайте, чтобы иметь возможность походить квесты.");
}
$arys = mysqli_fetch_assoc($s_mail);
$id_t = $arys["id_t"];

$passing = mysqli_query($connect, "SELECT * FROM `passing` WHERE `id_t`='$id_t' AND `id_quests`='$id_quest' ORDER BY id DESC LIMIT 1");
if (mysqli_num_rows($passing) > 0) {
    //сделать запрос на следующее задание текущего квеста и на него переадресовать.
} else {
    //поучаем запрос на первое задание
    $passing = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_quests`='$id_quest' LIMIT 1");
    //получаем иди квеста и в соответсвии с id переадресуем на страницу с передачей id_task_passing
}
echo('../passing/photo.php');