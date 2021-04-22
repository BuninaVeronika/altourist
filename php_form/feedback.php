<?php
session_start();

include_once("../include/bd.php");
global $connect;
$cooki_hash_s=$_COOKIE['cooki_hash'];
if(empty($cooki_hash_s)){$cooki_hash_s=$_SESSION['cooki_hash'];}

$s_mail = mysqli_query($connect,"SELECT * FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");
$arys=mysqli_fetch_assoc($s_mail);
$id_t=$arys["id_t"];

$ocenka=filter_input(INPUT_POST,"ocenka",FILTER_SANITIZE_SPECIAL_CHARS);
$feedback=filter_input(INPUT_POST,"feedback",FILTER_SANITIZE_SPECIAL_CHARS);
$id_quest=filter_input(INPUT_POST,"id_quest",FILTER_SANITIZE_SPECIAL_CHARS);
$date=date('Y-m-d');

$dostup=mysqli_query($connect,"SELECT * FROM `quest_purchases` WHERE `id_t`='$id_t' AND `id_quests`='$id_quest'");
$dostup_count=mysqli_num_rows($dostup);
if($dostup_count==0){exit('Купите и попробуйте квест-тур, чтобы иметь возможность оставить отзыв.');}

$dostup=mysqli_query($connect,"SELECT * FROM `reviews` WHERE `id_t`='$id_t' AND `id_quests`='$id_quest'");
$dostup_count=mysqli_num_rows($dostup);
if($dostup_count!=0){exit('Вы уже оставили отзыв к этому квесту, спасибо за ваше мнение!');}


$add_quest = mysqli_query($connect,"INSERT INTO `reviews`(`id_t`, `id_quests`, `assessment`, `text_quests`,`date`) VALUES ('$id_t','$id_quest','$ocenka','$feedback','$date')");
if (!$add_quest) {
        exit ('Неверный запрос: ' . mysqli_error($connect));
    }
$reiting = mysqli_query($connect,"SELECT `assessment` FROM `reviews` WHERE `id_quests`='$id_quest'");
$reiting_count=mysqli_num_rows($reiting);
$sum_reiting=0;
for ($i=0;$i<$reiting_count;$i++){
$ary_reiting=mysqli_fetch_assoc($reiting);
$number=$ary_reiting["assessment"];
$sum_reiting+=$number;
}
$sum_reiting=$sum_reiting/$reiting_count;
$reiting_sql=mysqli_query($connect,"UPDATE `quests_altrst` SET `reiting`='$sum_reiting' WHERE `id_quests`='$id_quest'");
echo "Оставили";