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
$technical = $array_section["technical"];
$id_location = $array_section["id_location"];
$id_section = $array_section["id_section"];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
    echo '<title>' . $quests_name . '</title>';
    ?>
    <meta charset="utf-8">
    <meta name="robots" content="index">
    <meta name="description"
          content="Квест-туры в разных городах и тематиках прохождения. Поробуй исследовать и создавать досуг на своих правилах.">
    <meta name="keywords" content="квесты, туры, туризм, городская среда, путешествия, курск, ">
    <meta name="author" content="Бунина Вероника">
    <link rel="icon" href="img/logo1.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/style_other.css">
    <link rel="stylesheet" type="text/css" href="css/style_form.css">
    <script defer src="js/jquery_3.5.1.min.js"></script>
    <script defer src="js/jq_cookie.js"></script>
    <script defer src="js/head_other.js"></script>
    <script defer src="js/form_js.js"></script>

</head>
<body>

<header class="header_quest">
    <a href='index.php'><img class='logo_img' src="img/logo1.svg">
        <h3 class='logo_title'>altouruist</h3></a>
    <div class='nav_right'>
        <input type="text" name="search" class="input_search"><input type="button" class='button_check'
                                                                     name="search_button" value="&#xe800;"
                                                                     id='search_button'>
        <input type="button" id='reg_button' name="reg_button" class='button_check' value="&#xf2be;">
    </div>
</header>

<div class="kies" id='cookies_class'>
    <input type="button" name="" id='cookies_ok' value="ОК">
    <p>Используя данный сайт, вы даете согласие на использование файлов cookie, данных о местоположении и IP-адрес,
        помогающих нам сделать сервис удобнее для вас. <a href=''>Подробнее</a></p>
</div>
<?php
//не забыть проверку если квест куплен то добавить кнопку начать
$location_section = mysqli_query($connect, "SELECT * FROM `location` WHERE `id_location`='$id_location'");
$array_location = mysqli_fetch_assoc($location_section);
$location_name = $array_location["location_name"];
$carta = $array_location["carta"];
$section = mysqli_query($connect, "SELECT * FROM `section` WHERE `id_section`='$id_section'");
$array = mysqli_fetch_assoc($section);
$section_name = $array["section_name"];

if ($section_count == 0) {
    exit('<label id="error_mess">Такого квеста не существует, вернитесь <b>на страницу назад</b> и активируйте ссылку снова.<a onclick="javascript:history.back(); return false;">Назад</a></label>');
}
$task_c = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_quests`='$id_quest'");
$task_count = mysqli_num_rows($task_c);

print<<<section_quest
	<img class="background_img" src='$file'/>
	
	<section class="quest_info">
	<div class="form">
	<div class="left_info">
	<p title="Рейтинг" class="icon_list">&#xe801;</p><h6 style="margin-top:0;">$reiting</h6>
	<p title="Возрастная рекомендация" class="icon_list">&#xe801;</p><h6>$age</h6>
	<p title="Количество заданий квеста" class="icon_list">&#xe801;</p><h6>$task_count</h6>	
	<p title="Уровень сложности" class="icon_list">&#xe801;</p><h6>$complication</h6>
	<a href="section_quest.php?section=$id_section"><p title="Секция" class="icon_list">&#xe801;</p><h6>$section_name</h6></a>
	<a href="section_quest.php?location=$id_location"><p title="Локация" class="icon_list">&#xe801;</p><h6>$location_name</h6></a>
	<p title="Время прохождения" class="icon_list">&#xe802;</p><h6>$time</h6>
	<p title="Расстояние" class="icon_list">&#xe801;</p><h6>$distance км.</h6>
	<p title="Автор" class="icon_list">&#xe801;</p><h6>$id_t автор</h6>	
	</div>
	<div class="right_info">
	<a href="quest_tour.php?id_quest=$id_quests"><h1>$quests_name</h1></a>
	<label>$text_quests</label>
	<p title="Оптимальное количество участников" class="icon_list" style="margin-top:0;">&#xe802;</p><h6>$man</h6>
	<p title="Стоимость" class="icon_list">&#xf158;</p><h6>$sale</h6><br>
	<input class='button_check put_aside' title="Отложить" id="button_check" id_quest='$id_quests'  type="button" name="quest_user" value="&#xe806;">
	<input class='purchase button_action'  id_quest='$id_quests' type="button" name="quest_info" value="Купить">
section_quest;

$cooki_hash_s = $_COOKIE['cooki_hash'] ?? '';
if (empty($cooki_hash_s)) {
    $cooki_hash_s = $_SESSION['cooki_hash'] ?? '';
}
$account = mysqli_query($connect, "SELECT * FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");
$array = mysqli_fetch_assoc($account);
$status_edit = $array["role_admin"];
if ($status_edit == 1) {
    ?>
    <a href="edit_a_quest.php?id_quest=<?= $id_quests ?>"><input style="margin-left: 13%; margin-top:20px;"
                                                                 class="button_action" type="button" name="quest_info"
                                                                 value="Редактировать"></a>
    <input style="margin-left: 13%; margin-top:20px; background: #4D774E;" class="button_action quest_check"
           type="button" name="quest_info" id_quest='<?= $id_quests ?>' value="Подтвердить квест">
    <input style="margin-left: 13%; margin-top:20px; background: #F1B24A; color: white;"
           class="button_action quest_fail" type="button" name="quest_info" id_quest='<?= $id_quests ?>'
           value="Отклонить квест">

    <?
}
echo('</div>');

echo('</div>');

    

echo('<ul>');
$task = mysqli_query($connect, "SELECT DISTINCT `id_task` FROM `task` WHERE `id_quests`='$id_quest'");
$t_count = mysqli_num_rows($task);

for ($i = 0; $i < $t_count; $i++) {
    $array_task = mysqli_fetch_assoc($task);
    $id_task = $array_task['id_task'];
    $name_task = mysqli_query($connect, "SELECT `type_icon`, `type` FROM `type_task` WHERE `id_task`='$id_task'");
    $icon_task = mysqli_fetch_assoc($name_task);
    $icon = $icon_task['type_icon'];
    $type = $icon_task['type'];
    echo('<li class="icon_list"  title="' . $type . '">' . $icon . '</li>');
}
print ('</ul></section>');

echo($carta);
?>
<div class="pove">
<div class="form info_quest">
    <h1>Как начать прохождение?</h1>
    <ul>
        <li><p class="icon_list">&#xe803;</p>Для этого потребуется телефон и стабильное интернет соединение.</li>
        <li><p class="icon_list">&#xf2c1;</p>Зарегистрируйтесь, чтобы иметь доступ к квестам и их прогрессу.</li>
        <li><p class="icon_list">&#xe804;</p>Нажмите кнопку купить (даже бесплатные квесты) и они появятся в личном
            кабинете, где можно перейти на прохождение.</li>
        <li><p class="icon_list">&#xe801;</p>Перейдите на заданную точку в первом задании.</li>
        <li><p class="icon_list">&#xf278;</p>Перед вами стоит задача, условия который вы должны выполнить.</li>
        <li><p class="icon_list">&#xe805;</p>Вы можете воспользоваться подсказкой или открыть ответ, если задача квеста
            была неясна.
        </li>
        <li><p class="icon_list">&#xf27b;</p>Проходите снова и оставляйте свое мнение в отзывах и рейтинге квеста.</li>
    </ul>
</div>
</div>
<?php

if(empty($cooki_hash_s)){echo("<form id='feedback' style='text-align: center;'><label style='color: #ffffff'>Авторизуйтесь и купите квест, чтобы оставить отзыв</label></form>");}
else{
    print<<<top
<form id="feedback">
    <input   type="radio" value="1" name="ocenka" >
    <input   type="radio" value="2" name="ocenka" >
    <input   type="radio" value="3" name="ocenka" >
    <input   type="radio" value="4" name="ocenka" >
    <input   type="radio" value="5" name="ocenka" >
    <input class="input_mail" type="text" name="feedback" required pattern="^[?!,-.а-яА-ЯёЁ0-9\s]+$">
    <input style="display:none;" type="text" name="id_quest" value="$id_quests">
    <input type="button" class='button_action' id="feedback_click" value="Оставить отзыв">
</form>
top;

}
$feedback = mysqli_query($connect, "SELECT * FROM `reviews` WHERE `id_quests`='$id_quest'");
$feedback_count = mysqli_num_rows($feedback);

for ($i = 0; $i < $feedback_count; $i++) {
    $array_feedback = mysqli_fetch_assoc($feedback);
    $id_t_feedback = $array_feedback['id_t'];
    $assessment = $array_feedback['assessment'];
    $text_quests= $array_feedback['text_quests'];
    $date_feedback = $array_feedback['date'];
    $s_mail = mysqli_query($connect,"SELECT * FROM `user_tourist` WHERE `id_t`='$id_t_feedback'");
    $user=mysqli_fetch_assoc($s_mail);
    $name_t=$user["name_t"];

    print<<<feed
    <div class='feed form'>
    <p>$date_feedback</p>
    <p>Пользователь: $name_t</p>
    <p>Оценка: $assessment</p>
    <hr style='border: none; background: #4D774E; width: 100%; height:1px; float: left;' >
    <label>$text_quests</label>
    </div>
feed;

}

?>

<?php
footer_block();
?>

</body>
</html>