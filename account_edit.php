<?php
include_once('include/include.php');
global $connect;
header_block();
?>
	
	<div class='form' id='edit_acc'>
		<h1>Редактировать профиль</h1>

<?php
		echo "<h3>";
		verification_of_authorization();
		echo "</h3>";

		$session_hash=$_SESSION['cooki_hash'];
		$account = mysqli_query($connect,"SELECT * FROM `user_tourist` WHERE `cookies_hash`='$session_hash'");
		$array=mysqli_fetch_assoc($account);
		$account_count=mysqli_num_rows($account);
		if (!$account) {
        exit ('Неверный запрос: ' . mysqli_error());
    	}
    	elseif($account_count==0){
    		echo "<h3>Данные сессии не найдены, непредвиденная ошибка, требуется повторная авторизация</h3>";
    	}
    	else{
    		$id_t=$array["id_t"];
    		$name=$array["name_t"];
    		$email=$array["email_t"];
    		$number=$array["number_t"];
    		$avatar=$array["avatar"];
    		$email_confirmation=$array["email_confirmation"];
    		$email_confirmation=$array["number_confirmation"];
    		//C выводом поработать
    		$arr_avatar=$pieces = explode("/", $avatar);
    		$avatar=$arr_avatar[2];

print<<<edit_account
		<form id='edit_account'>
			<h3 style='margin-top:10px; margin-bottom: 10px;'>Изменить основную информацию</h3>
			<div class="fl_upld">
			<label class="button_action"><input  id="fl_inp" type="file"  name="file">Выберите аватарку</label>
			<div id="fl_nm">$avatar</div>
			</div>
			<input type="text" name="name" id='name' value='$name' placeholder="Имя: Неутомимый турист" pattern="^[А-Яа-яЁё\s]+$">
			<input type="text" name="email" required value='$email' placeholder="Email: NeytomimyiTurist@tour.com" pattern="\S+@[a-z]+.[a-z]+">
			<input type="text" name="number"  value='$number' placeholder="Номер телефона: 8-900-000-00-00" pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$">

			<h3>Изменить данные пароля</h3>
			<label>Если изменения не планируются, пропустите эти поля.</label>
			<input type="password" name="password" autocomplete='off'  placeholder="Старый пароль" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
			<input type="password" name="repassword" autocomplete='off'  placeholder="Новый пароль" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

			<input type="button" onclick='edit_account()' name="" value="Сохранить изменения" class="button_action">
		    <br>
		    <input type="button" class='button_action' onclick='delete_account()' value="Удалить профиль" name="">
		</form>
edit_account;


    	}

		?>


	</div>


<?php
footer_block();
?>

</body>
</html>