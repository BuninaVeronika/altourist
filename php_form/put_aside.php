<?php
session_start();
$id_quest=filter_input(INPUT_POST,"id_quest",FILTER_SANITIZE_SPECIAL_CHARS);
include_once("../include/bd.php");
global $connect;

//Это код для работы - в дальнейшем нужно преобразовать в адекватный 
//Проверить наличие куки файлов авторизации
//Если их нет, создаем куки с иди отложенных туров
//Если есть проводим через базу данных
//Потом при авторизации надо будет проверить наличие этих куки файлов с отложенными квестами и при наличие добавить их в базу с авторизованым пользователем
//а куки удалить
//не забыть прогнать и просить у базы есть ли уже такая запись в базе

$email=$_COOKIE["email"];
$s_mail = mysqli_query($connect,"SELECT `id_t` FROM `user_tourist` WHERE `email_t`='$email'");
$arys=mysqli_fetch_assoc($s_mail);
$id_t=$arys["id_t"];

$put_aside = mysqli_query($connect,"INSERT INTO `deferred_quests`(`id_t`, `id_quests`) VALUES ('$id_t','$id_quest')");

echo "Теперь вы сможете найти этот квест в своем аккаунте";