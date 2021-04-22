<?php
session_start();

$email=filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
$password=filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);

$date=date('Y-m-d');

//Получение ипи адреса пользователя
 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
//создаем куки для входа
$cooki=$ip.'_'.$email;
$cooki_hash = password_hash($cooki, PASSWORD_DEFAULT);

setcookie('email',$email,strtotime("+4 week"),'/');
setcookie('cooki_hash',$cooki_hash,strtotime("+4 week"),'/');

include_once '../include/bd.php';
global $connect;

if (empty($email) || empty($password)){
    exit("Пожалуйста, заполните все обязательные поля");
}

$e_mailreg = mysqli_query($connect,"SELECT `id_t`,`email_t`,`password_t` FROM `user_tourist` WHERE `email_t`='$email'");
if (!$e_mailreg) {
	    exit ('Неверный запрос: ' . mysqli_error());
	}
else{

	$count=mysqli_num_rows($e_mailreg);
	if ($count==0) {
	    exit("Пользователь с данным электронным адреcом не существует, проверьте данные формы.");
	}
	else{
	$ary=mysqli_fetch_assoc($e_mailreg);
	$password_t=$ary["password_t"];
	if (password_verify($password, $password_t)){

		$now_hash = mysqli_query($connect,"UPDATE `user_tourist` SET `cookies_hash`='$cooki_hash',`date_of_visit`='$date' WHERE `email_t`='$email'");
		if (!$now_hash) {
			    exit ('Неверный запрос: ' . mysqli_error());
			}
		else{	
		    $_SESSION['cooki_hash'] = $cooki_hash;
			echo 'Авторизован';
			}
	}
	else {
	    exit("Пользователь с данным паролем не существует, проверьте данные формы.");
	}

	
	}
	
}



