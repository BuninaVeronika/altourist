<?php
include_once('../include/include.php');
global $connect;
$id_pass = $_GET['id_task_passing'];
$passing_arr = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_task_passing`='$id_pass'");
$arrayPass = mysqli_fetch_assoc($passing_arr);
$id_task = $arrayPass['id_task'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Altouruist</title>
    <meta charset="utf-8">
    <meta name="robots" content="index">
    <meta name="description"
          content="Квест-туры в разных городах и тематиках прохождения. Поробуй исследовать и создавать досуг на своих правилах.">
    <meta name="keywords" content="квесты, туры, туризм, городская среда, путешествия, курск, ">
    <meta name="author" content="Бунина Вероника">
    <link rel="icon" href="../img/logo1.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/style_other.css">
    <link rel="stylesheet" type="text/css" href="../css/style_form.css">
    <script defer src="../js/jquery_3.5.1.min.js"></script>
    <script defer src="../js/jq_cookie.js"></script>
    <script defer src="../js/head_other.js"></script>
    <script defer src="js/pico.js"></script>
    <script defer src="js/job.js"></script>
    <script defer src="js/async.js"></script>

</head>
<script>
    function previewFile() {
        var preview = document.querySelector('#image');
        var file = document.querySelector('input[type=file]').files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
        setTimeout(function () {
            button_callback();
        }, 500);
    }
</script>
<body>

<header id='head_top'>
    <a href='../index.php'><img class='logo_img' src="../img/logo1.svg">
        <h3 class='logo_title'>altouruist</h3></a>
    <div class='nav_right'>
        <input type="text" name="search" class="input_search" pattern="^[?!,-.а-яА-ЯёЁ0-9\s]+$">
        <input type="button" class='button_check' name="search_button" value="&#xe800;" id='search_button'>
        <input type="button" id='reg_button' name="reg_button" class='button_check' value="&#xf2be;">
    </div>
</header>
<?php
if ($id_task != '3') {
    exit('<label id="error_mess">Задание не соотвествует типу отображаемой страницы или такого задания не существует.<a onclick="javascript:history.back(); return false;">Назад</a></label>');
} else {

    $id_quests = $arrayPass['id_quests'];
    $inf_task_text = $arrayPass['inf_task_text'];
    $answer = $arrayPass['answer'];
    $hint = $arrayPass['hint'];
    $time = $arrayPass['time'];
    $coordinates = $arrayPass['coordinates'];
    $file_url = $arrayPass['file_url'];
    $icon_type = mysqli_query($connect, "SELECT * FROM `type_task` WHERE `id_task`='$id_task'");
    $arrayType = mysqli_fetch_assoc($icon_type);
    $type = $arrayType['type'];
    $time_now = date("H:i:s");

    print<<<passing
<div class='form passing_form'>
    <center><h1>$type</h1></center>
    <label>$inf_task_text</label>
    <label>Время на задание: $time минут. </label>
passing;
    if (!empty($file_url)) {
        echo '<img class="img_form_task" src="jobphp/' . $file_url . '">';
    }
    print<<<passing
    <div class="fl_upld">
			<label style="margin:10px 13%; width: 68%;" class="button_action"><input id="fl_inp" type="file" onchange="previewFile()" name="file" accept="image/*">Сделайте фото, с предполагаемым количеством лиц.</label>
	</div>
    <center><canvas id="canvas"  width=500 height=350></canvas></center>
    <div style="display:none;"><img id="image" src=""></div>
    <input type="hidden" class="face_result" placeholder="Ответ на вопрос" id="answer_result">
	 <input type="hidden" id='passing' value="$id_pass">
     <input type="hidden" id='time' value="$time_now">
     <input type="hidden" id='id_quests' value="$id_quests">
    <input type="button" class='button_action get_result_face' value="Отправить количество">
    <hr style="width: 100%; float: left; background: #4D774E; height: 1px; border: none;">
    <p class="text_task" style="display: none;" id="hint">$hint</p>
    <input type="button" class='button_action hint but' value="Показать подсказку">
    <p></p>
    <p class="text_task" style="display: none;" id="answer">$answer</p>
    <input style="display: none;" type="button" class='button_action answer but' value="Показать ответ">
</div>
passing;

}

?>
<p></p>
<?php
footer_block();
?>

</body>
</html>