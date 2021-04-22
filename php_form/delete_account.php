<?php
session_start();
include_once '../include/bd.php';
global $connect;
$session_hash=$_SESSION['cooki_hash'];
$account = mysqli_query($connect,"DELETE FROM `user_tourist` WHERE `cookies_hash`='$session_hash'");
if (!$account) {
        exit ('Неверный запрос: ' . mysqli_error($connect));
    	}
else{
	
	echo "Удалили";
}