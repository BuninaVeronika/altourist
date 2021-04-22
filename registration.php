<?php
include_once('include/include.php');
header_block();
?>
	
	
	<div class='form' id='avtoriz'>
		<h1>Пройти авторизацию</h1>
		<form id='avtrz'>
			<input type="text"  name="email" required placeholder="Email" pattern="\S+@[a-z]+.[a-z]+">
			<input type="password"  name="password" required placeholder="Пароль" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
			<a href=''>восстановить пароль аккаунта</a>
			<input type="button"  onclick='avtrz()' value="Авторизоваться" class="button_action">
			
		</form>
	</div>


	<div class='form' id='reg'>
		<h1>Регистрация на сайте</h1>
		<form id='rgstrz'>
			<input type="text" name="name" id='name' placeholder="Имя: Неутомимый турист" pattern="^[А-Яа-яЁё\s]+$">
			<input type="text" name="email" required placeholder="Email: NeytomimyiTurist@tour.com" pattern="\S+@[a-z]+.[a-z]+">
			<input type="password" class='pass' name="password" required placeholder="Пароль: ******" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
			<input type="password" class='pass' name="repassword" required placeholder="Подтверждение пароля: ******" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
			
			<div class="fl_upld">
			<label class="button_action"><input id="fl_inp" type="file"  name="file">Выберите аватарку</label>
			<div id="fl_nm">jpg,png</div>
			</div>


			<h3>Для регистрации квест-туров, необходимо подвердить телефонный номер</h3>
			<input type="text" name="number" placeholder="Номер телефона: 8-900-000-00-00" pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$">
			<p></p>
			 <label class="container">Для предоставления услуг сервиса подтверждаю согласие с условиями <a href='' >пользовательского соглашения</a>
    		<input type="checkbox" name='sogl' value="Yes">
   			 <span class="checkmark"></span></label>
			 <label class="container">Даю согласие на получение информации об акциях и новых квест-турах
    		<input type="checkbox" name='ras_email' value="Yes">
   			 <span class="checkmark"></span></label>
			<input type="button" onclick='rgstrz()' name="" value="Зарегистрироваться" class="button_action">
		</form>
	</div>




<?php
footer_block();
?>

</body>
</html>