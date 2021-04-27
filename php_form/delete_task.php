<?php
session_start();
include_once '../include/bd.php';
global $connect;
$id_task_passing=$_POST['id_task'];
$account = mysqli_query($connect,"DELETE FROM `task` WHERE `id_task_passing`='$id_task_passing'");
echo $id_task_passing;