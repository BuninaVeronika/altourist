<?php
session_start();

include_once("../../include/bd.php");
global $connect;
$result = '';
$id_passing = filter_input(INPUT_POST, "passing", FILTER_SANITIZE_SPECIAL_CHARS);
$answer1 = filter_input(INPUT_POST, "answer_result", FILTER_SANITIZE_SPECIAL_CHARS);
$answer2 = filter_input(INPUT_POST, "answer_result", FILTER_SANITIZE_SPECIAL_CHARS);
$answer_arr = [$answer1, $answer2];

foreach ($answer_arr as $ar) {
    $section_quest = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_task_passing`='$id_passing' AND `coordinates` LIKE '%$ar%'");

    if (mysqli_num_rows($section_quest) > 0) {
        $result = "true";
        break;
    } else {
        $result = 'Ответ неправильный, попробуйте снова.';
    }
}
echo $result;