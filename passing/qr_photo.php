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
    <script defer src="js/qrcode.js"></script>
    <script defer src="js/jsQR.js"></script>
    <script defer src="js/app.js"></script>
    <script defer src="js/async.js"></script>

    <style>
        #loadingMessage {
            text-align: center;
            padding: 40px;
            width: 90%;
            float: right;
        }

        #canvas {
            margin-left: 20%;
            width: 60%;
        }

        #output {
            margin-top: 20px;
            padding: 10px;
            padding-bottom: 0;
        }

        #output div {
            padding-bottom: 10px;
            word-wrap: break-word;
        }
    </style>
</head>
<script>
    setInterval(function () {
        var test = document.getElementById('outputData').innerText;
        $('#answer_result').val(test);
    }, 100);
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
if ($id_task != '6') {
    exit('<label id="error_mess">Задание не соотвествует типу отображаемой страницы или такого задания не существует.<a onclick="javascript:history.back(); return false;">Назад</a></label>');
} else {

    $id_quests = $arrayPass['id_quests'];
    $inf_task_text = $arrayPass['inf_task_text'];
    $answer = $arrayPass['answer'];
    $hint = $arrayPass['hint'];
    $time = $arrayPass['time'];
    $coordinates = explode("|", $arrayPass['coordinates']);
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
    ?>
    <div id="loadingMessage">Нет доступа к камере</div>
    <canvas id="canvas" hidden></canvas>
    <div id="output" hidden>
        <div id="outputMessage"></div>
        <div hidden><span id="outputData" class="text_task"></span></div>

    </div>
    <?
    print<<<passing
    <input type="hidden" placeholder="Ответ на вопрос" id="answer_result">
	 <input type="hidden" id='passing' value="$id_pass">
     <input type="hidden" id='time' value="$time_now">
     <input type="hidden" id='id_quests' value="$id_quests">
    <input type="button" class='button_action get_result_face' value="Отправить ответ">
    <hr style="width: 100%; float: left; background: #4D774E; height: 1px; border: none;">
    <p class="text_task" style="display: none;" id="hint">$hint</p>
    <input type="button" class='button_action hint but' value="Показать подсказку">
    <p></p>
</div>
passing;
}

?>
<?php
footer_block();
?>

</body>
</html>