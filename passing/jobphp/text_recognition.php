<?php
session_start();

include_once("../../include/bd.php");
global $connect;
$result = '';
$id_passing = filter_input(INPUT_POST, "passing", FILTER_SANITIZE_SPECIAL_CHARS);
$answer_result = filter_input(INPUT_POST, "answer_result", FILTER_SANITIZE_SPECIAL_CHARS);
$answer_arr = explode(" ", $answer_result);

foreach ($answer_arr as $ar) {
    if (strlen($ar) >= 1 || $ar != " ") {
        $section_quest = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_task_passing`='$id_passing' AND `answer` LIKE '%$ar%'");
        if (!$section_quest) {
            exit ('Неверный запрос: ' . mysqli_error());
        }
        if (mysqli_num_rows($section_quest) > 0) {
            $result = "true";
            break;
        } else {
            $result = 'lol';
        }
    }
}



