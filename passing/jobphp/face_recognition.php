<?php
session_start();

include_once("../../include/bd.php");
global $connect;
$result = '';
$id_passing = filter_input(INPUT_POST, "passing", FILTER_SANITIZE_SPECIAL_CHARS);
$answer_result = filter_input(INPUT_POST, "answer_result", FILTER_SANITIZE_SPECIAL_CHARS);

$section_quest = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_task_passing`='$id_passing' AND `answer`='$answer_result'");

if (mysqli_num_rows($section_quest) > 0) {
    $result = "true";
} else {
    $result = 'Ответ неправильный, попробуйте снова.';
}

echo $result;