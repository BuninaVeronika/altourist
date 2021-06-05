<?php
session_start();

include_once("../../include/bd.php");
global $connect;
$result = '';
$id_passing = filter_input(INPUT_POST, "passing", FILTER_SANITIZE_SPECIAL_CHARS);
$answer_result = substr(filter_input(INPUT_POST, "answer_result", FILTER_SANITIZE_SPECIAL_CHARS), 0, -5);;
$answer_arr = array_map('trim', array_filter(explode(' ', $answer_result)));
foreach ($answer_arr as $ar) {
    $section_quest = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_task_passing`='$id_passing' AND `answer` LIKE '%$ar%'");

    if (mysqli_num_rows($section_quest) > 0) {
        $result = "true";
        break;
    } else {
        $result = 'Ответ неправильный, попробуйте снова.' . $ar;
    }
}
echo $result;


