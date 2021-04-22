<?php
include_once('include/include.php');
global $connect;

$id_quest = $_GET['id_quest'];

$section_quest = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_quests`='$id_quest'");
$section_count = mysqli_num_rows($section_quest);

$array_section = mysqli_fetch_assoc($section_quest);
$id_quests = $array_section["id_quests"];
$quests_name = $array_section["quests_name"];
$text_quests = $array_section["text_quests"];
$reiting = $array_section["reiting"];
$file = $array_section["file"];
$age = $array_section["age"];
$sale = $array_section["sale"];
$time = $array_section["time"];
$distance = $array_section["distance"];
$man = $array_section["man"];
$complication = $array_section["complication"];
$id_t = $array_section["id_t"];
$status = $array_section["status"];
//проверить на статус, если 1, редактировать нельзя
$technical = $array_section["technical"];
$id_location_quests = $array_section["id_location"];
$id_section_quests = $array_section["id_section"];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Добавить квест-тур</title>
    <meta charset="utf-8">
    <meta name="robots" content="index">
    <meta name="description" content="Квест-туры в разных городах и тематиках прохождения. Поробуй исследовать и создавать досуг на своих правилах.">
    <meta name="keywords" content="квесты, туры, туризм, городская среда, путешествия, курск, ">
    <meta name="author" content="Бунина Вероника">
    <link rel="icon" href="img/logo1.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/style_other.css">
    <link rel="stylesheet" type="text/css" href="css/style_form.css">
    <script defer src="js/jquery_3.5.1.min.js"></script>
    <script defer src="js/jq_cookie.js"></script>
    <script defer src="js/qr/filesaver.js"></script>
    <script defer src="js/head_other.js"></script>
    <script defer src="js/form_js.js"></script>
    <script defer src="js/qr/qrcode.js"></script>
    <script defer src="js/qr/jsQR.js"></script>
	<script defer src="js/qr/questjs.js"></script>

</head>
<body>

    <!--Надо будет вставить на всех достпуных для просмотрах страницах-->
    <div class="kies" id='cookies_class'>
    <input type="button" name="" id='cookies_ok' value="ОК">
    <p>Используя данный сайт, вы даете согласие на использование файлов cookie, данных о местоположении и IP-адрес, помогающих нам сделать сервис удобнее для вас. <a href=''>Подробнее</a></p>
    </div>
    <!--Скорей всего выведем в подзагрузку шапку сайта-->

    <header id='head_top'>
    <a href='index.php'><img class='logo_img' src="img/logo1.svg">
    <h3 class='logo_title'>altouruist</h3></a>
    <div class='nav_right'>
        <input type="text" name="search" class="input_search"><input type="button" class='button_check' name="search_button" value="&#xe800;" id='search_button'>
        <input  type="button"  id='reg_button' name="reg_button" class='button_check' value="&#xf2be;" >
    </div>
    </header>
<?php
verification_of_authorization();
?>
    <?php if($section_count!=0):?>
	<div class='form' id='add_quest'>
		<h1>Редактировать Квест-Тур</h1>
<?php
		$cooki_hash_s=$_SESSION['cooki_hash'];
		$number = mysqli_query($connect,"SELECT * FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");
		$ary=mysqli_fetch_assoc($number);
		$number_confirmation=$ary["number_confirmation"];
		if($number_confirmation==0){
			exit("<h3>Пожалуйста, подтвердите телефонный номер в профиле аккаунта. Это необходимо для безопасности пользователей вашего квест-тура.</h3> <a href='personal_account.php'><input type='button' value='Вернуться в профиль' class='button_action'></a>");
		}
?>
		<form id='add_save'>

			<div class="fl_upld">
                <!--Обрезать путь изображения-->
			<label class="button_action"><input id="fl_inp" type="file" value="<?=$file?>" name="file">Добавьте обложку Квест-Тура</label>
			<div id="fl_nm"><?=!empty($file) ? $file : "jpg,png"?></div>
			</div>

			<input type="text" name="name" id='name' placeholder="Название Квест-Тура: Близкие горизонты" pattern="^[?!,-.а-яА-ЯёЁ0-9\s]+$" value="<?=$quests_name?>">
			<textarea class='text_quest' name='text' placeholder="Описание способное заинтересовать каждого." pattern="^[?!,-.а-яА-ЯёЁ0-9\s]+$"><?=$text_quests?></textarea>
			<input type="text" name="v" class="text_width"  placeholder="Возрастная рекомендация лет: 5 " pattern="[0-9]{1,2}" value="<?=$age?>">
			<input type="text" name="s"  class="text_width" placeholder="Предполагаемая стоимость в рублях: 500 " pattern="[0-9]{1,4}" value="<?=$sale?>">
			<input type="text" name="t"  class="text_width" placeholder="Ориентировочное время в минутах: 120 " pattern="[0-9]{1,5}" value="<?=$time?>">
			<input type="text" name="h"  class="text_width" placeholder="Сложность квеста по 10 болной шкале: 5 " pattern="[0-9]{1,2}" value="<?=$complication?>">
            <input type="text" name="distance"  class="text_width" placeholder="Растояние в киломметрах: 4,4 " pattern="[,.0-9]{1,5}" value="<?=$distance?>">
            <input type="text" name="man"  class="text_width" placeholder="Предлагаемое количество участников: 5 " pattern="[,.0-9]{1,2}" value="<?=$man?>">

            <select class="select-css"  name='section'>
			<option value="" hidden disabled selected>Тематика квест-тура</option>
<?php
		$section = mysqli_query($connect,"SELECT * FROM `section`");
		$section_count = mysqli_num_rows($section);
		for ($i = 0;$i < $section_count;$i++) {
			$array_section=mysqli_fetch_assoc($section);
			$id_section=$array_section["id_section"];
    		$section_name=$array_section["section_name"];
            if ($id_section_quests == $id_section){
                echo "<option selected value='$id_section'>$section_name</option>";
            }
            else {
                echo "<option value='$id_section'>$section_name</option>";
            }

    	}
?>
			</select>

			<select class="select-css" name='location'>
			<option value="" hidden disabled>Район города</option>
<?php
		$location = mysqli_query($connect,"SELECT * FROM `location`");
		$location_count = mysqli_num_rows($location);
		for ($i = 0;$i < $location_count;$i++) {
			$array_location=mysqli_fetch_assoc($location);
			$id_location=$array_location["id_location"];
    		$location_name=$array_location["location_name"];
            if ($id_location_quests == $id_location){
                echo "<option selected value='$id_location'>$location_name</option>";
            }
            else {
                echo "<option value='$id_location'>$location_name</option>";
            }
    	}
?>
			</select>
			<label>Чтобы добавить задания,<b> сохраните информацию о квест-туре</b>, в дальнейшем ее можно отредактировать до официального подтверждения модератора.</label>
            <input type='button' style='margin-bottom: 35px;' value='Редактировать Квест-Тур' class='button_action' onclick='red_quest()'>
            <input style='display:none;' type='text' name='id_quest_value' id='id_quest_value' value="<?=$id_quests?>">


            <div  id='red'></div>
			<center><a href='personal_account.php'>Завершить создание квеста и выйти на страницу аккаунта.</a></center>

		</form>
        <?php else:
            exit('<label id="error_mess">Такого квеста не существует, вернитесь <b>на страницу назад</b> и активируйте ссылку снова.<a onclick="javascript:history.back(); return false;">Назад</a></label>');
         ?>
        <?endif;?>
	</div>
    <?php
    $task_c = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_quests`='$id_quests'");
    $task_count = mysqli_num_rows($task_c);
    for($i=0; $i<$task_count; $i++){
        $arr_task = mysqli_fetch_assoc($task_c);
        SELECT `id_task_passing`, `id_task`, `id_quests`, `inf_task_text`, `answer`, `hint`, `status`, `time`, `coordinates`, `file_url` FROM `task` WHERE 1
    }

    ?>

			<div id='more_task' style="color:black;"></div>
			<div id='task'>
				<select name='type_task' class='task_real'>
				<option value="" hidden disabled selected>Выберите тип задания</option>
<?php
		$type_task = mysqli_query($connect,"SELECT * FROM `type_task`");
		$type_task_count = mysqli_num_rows($type_task);
		for ($i = 0;$i < $type_task_count;$i++) {
			$array_type_task=mysqli_fetch_assoc($type_task);
			$id_task=$array_type_task["id_task"];
    		$type=$array_type_task["type"];
    		$info_task=$array_type_task["info_task"];
    		echo "<option value='$info_task' alt='$id_task'>$type</option>";
    	}
?>
				</select>
				<label id="text_type" >Выберите тип задания, чтобы увидеть его описание</label>
				<input type="button"  onclick='new_form()' value="Создать форму для нового задания" class="button_action">
				<label>Все поля формы являются необязательными, в дальнейшем вы можете отредактировать их или дождаться изменений от модератора</label>
			</div>

    <a href='personal_account.php' class="quest_a"><input type="button"  onclick='' value=" Завершить создание квест-тура " class="button_action"></a>

    <div id='qr_gen' style="display: none;">
<input type="text" name="ansver" id="text_qr" placeholder="Ответ на задание для qr чтения" pattern="^[А-Яа-яЁё'+'\\'+'s]+$">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="qrcode"/></svg>
</div>

<?php
footer_block();
?>

</body>
</html>