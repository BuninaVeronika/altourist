<?php
session_start();

include_once("../../include/bd.php");
global $connect;
$result = '';
$id_passing = filter_input(INPUT_POST, "passing", FILTER_SANITIZE_SPECIAL_CHARS);
$answer_result = filter_input(INPUT_POST, "answer_result", FILTER_SANITIZE_SPECIAL_CHARS);

$section_quest = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_task_passing`='$id_passing'");
$array = mysqli_fetch_assoc($section_quest);
$resultut = $array['answer'];

if (strpos($answer_result, $resultut) || $resultut == $answer_result) {
    $result = "true";
} else {
    $result = 'Ответ неправильный, попробуйте снова. ' . $answer_result;
}

echo $result;