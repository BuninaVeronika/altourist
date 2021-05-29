<?php
session_start();
$id_quest = filter_input(INPUT_POST, "id_quest", FILTER_SANITIZE_SPECIAL_CHARS);
include_once("../include/bd.php");
global $connect;

if (!empty($_COOKIE["email"])) {
    $email = $_COOKIE["email"];
    $cooki_hash_s = $_SESSION['cooki_hash'];
}

if (!empty($email)) {
    $s_mail = mysqli_query($connect, "SELECT `id_t` FROM `user_tourist` WHERE `email_t`='$email'");
} elseif (!empty($cooki_hash_s)) {
    $s_mail = mysqli_query($connect, "SELECT `id_t` FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");
} else {
    exit("Авторизуйтесь или Зарегистрируйтесь на сайте, чтобы иметь возможность выбирать квесты.");
}
$arys=mysqli_fetch_assoc($s_mail);
$id_t=$arys["id_t"];

$put_aside_val = mysqli_query($connect,"SELECT * FROM `deferred_quests` WHERE `id_quests`='$id_quest' AND `id_t`='$id_t'");
$count = mysqli_num_rows($put_aside_val);
if($count>0){
    exit('Вы уже отложили этот квест, ищите его в личном кабинете.');
}
else{
    $put_aside = mysqli_query($connect,"INSERT INTO `deferred_quests`(`id_t`, `id_quests`) VALUES ('$id_t','$id_quest')");
    echo "Теперь вы сможете найти этот квест в своем аккаунте";
}
