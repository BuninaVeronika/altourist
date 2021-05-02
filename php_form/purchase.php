<?php
session_start();
$id_quest=filter_input(INPUT_POST,"id_quest",FILTER_SANITIZE_SPECIAL_CHARS);
include_once("../include/bd.php");
global $connect;

$email=$_COOKIE["email"];
$cooki_hash_s=$_SESSION['cooki_hash'];
if(!empty($email)){
    $s_mail = mysqli_query($connect,"SELECT `id_t` FROM `user_tourist` WHERE `email_t`='$email'");
}
elseif(!empty($cooki_hash_s)){
    $s_mail = mysqli_query($connect,"SELECT `id_t` FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");
}
else{
    exit("Авторизуйтесь или Зарегистрируйтесь на сайте, чтобы иметь возможность выбирать квесты.");
}
$arys=mysqli_fetch_assoc($s_mail);
$id_t=$arys["id_t"];

$put_aside_val = mysqli_query($connect,"SELECT * FROM `quest_purchases` WHERE `id_quests`='$id_quest' AND `id_t`='$id_t'");
$count = mysqli_num_rows($put_aside_val);
if($count>0){
    exit('Вы уже купили этот квест, ищите его в личном кабинете.');
}
else {
    $data_time = date('Y/m/d H:i:s');
    $put_aside = mysqli_query($connect, "INSERT INTO `quest_purchases`(`id_t`, `id_quests`, `data_price`) VALUES ('$id_t','$id_quest','$data_time')");
    $delete_deferred = mysqli_query($connect, "DELETE FROM `deferred_quests` WHERE `id_t`='$id_t' AND `id_quests`='$id_quest'");

    echo "Спасибо за покупку квеста, теперь он будет доступен в соотвествующем разделе";
}