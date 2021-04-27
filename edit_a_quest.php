<?php
include_once('include/include.php');
global $connect;

$id_quest = $_GET['id_quest'];
$cooki_hash_s = $_SESSION['cooki_hash'];

$number = mysqli_query($connect, "SELECT * FROM `user_tourist` WHERE `cookies_hash`='$cooki_hash_s'");
$ary = mysqli_fetch_assoc($number);
$id_t = $ary["id_t"];
$role_admin = $ary["role_admin"];
$number_confirmation = $ary["number_confirmation"];
if($role_admin==1){
    $section_quest = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_quests`='$id_quest'");
}
else{
    $section_quest = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_quests`='$id_quest' AND `id_t`='$id_t'");
}

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
//проверить относится и к пользователю ии администратору
//Дописать контролер на удаление задания
$technical = $array_section["technical"];
$id_location_quests = $array_section["id_location"];
$id_section_quests = $array_section["id_section"];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Редактировать квест-тур</title>
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
    <script defer src="js/qr/filesaver.js"></script>
    <script defer src="js/head_other.js"></script>
    <script defer src="js/form_js.js"></script>
    <script defer src="js/qr/qrcode.js"></script>
    <script defer src="js/qr/jsQR.js"></script>
    <script defer src="js/qr/questjs.js"></script>

</head>
<body>


<div class="kies" id='cookies_class'>
    <input type="button" name="" id='cookies_ok' value="ОК">
    <p>Используя данный сайт, вы даете согласие на использование файлов cookie, данных о местоположении и IP-адрес,
        помогающих нам сделать сервис удобнее для вас. <a href=''>Подробнее</a></p>
</div>


<header id='head_top'>
    <a href='index.php'><img class='logo_img' src="img/logo1.svg">
        <h3 class='logo_title'>altouruist</h3></a>
    <div class='nav_right'>
        <input type="text" name="search" class="input_search"><input type="button" class='button_check'
                                                                     name="search_button" value="&#xe800;"
                                                                     id='search_button'>
        <input type="button" id='reg_button' name="reg_button" class='button_check' value="&#xf2be;">
    </div>
</header>
<?php
verification_of_authorization();
?>
<?php if ($section_count != 0): ?>
<div class='form' id='add_quest'>
    <h1>Редактировать Квест-Тур</h1>
    <?php

    if ($number_confirmation == 0) {
        exit("<h3>Пожалуйста, подтвердите телефонный номер в профиле аккаунта. Это необходимо для безопасности пользователей вашего квест-тура.</h3> <a href='personal_account.php'><input type='button' value='Вернуться в профиль' class='button_action'></a>");
    }
    if ($status == 1) {
        exit("<h3>Этот квест уже подтвержден администратором, его нельзя редактировать.</h3> <a href='personal_account.php'><input type='button' value='Вернуться в профиль' class='button_action'></a>");
    }

    ?>
    <form id='add_save'>

        <div class="fl_upld">
            <!--Обрезать путь изображения-->
            <label class="button_action"><input id="fl_inp" type="file" value="<?= $file ?>" name="file">Добавьте
                обложку Квест-Тура</label>
            <div id="fl_nm"><?= !empty($file) ? $file : "jpg,png" ?></div>
        </div>

        <input type="text" name="name" id='name' placeholder="Название Квест-Тура: Близкие горизонты"
               pattern="^[?!,-.а-яА-ЯёЁ0-9\s]+$" value="<?= $quests_name ?>">
        <textarea class='text_quest' name='text' placeholder="Описание способное заинтересовать каждого."
                  pattern="^[?!,-.а-яА-ЯёЁ0-9\s]+$"><?= $text_quests ?></textarea>
        <input type="text" name="v" class="text_width" placeholder="Возрастная рекомендация лет: 5 "
               pattern="[0-9]{1,2}" value="<?= $age ?>">
        <input type="text" name="s" class="text_width" placeholder="Предполагаемая стоимость в рублях: 500 "
               pattern="[0-9]{1,4}" value="<?= $sale ?>">
        <input type="text" name="t" class="text_width" placeholder="Ориентировочное время в минутах: 120 "
               pattern="[0-9]{1,5}" value="<?= $time ?>">
        <input type="text" name="h" class="text_width" placeholder="Сложность квеста по 10 болной шкале: 5 "
               pattern="[0-9]{1,2}" value="<?= $complication ?>">
        <input type="text" name="distance" class="text_width" placeholder="Растояние в киломметрах: 4,4 "
               pattern="[,.0-9]{1,5}" value="<?= $distance ?>">
        <input type="text" name="man" class="text_width" placeholder="Предлагаемое количество участников: 5 "
               pattern="[,.0-9]{1,2}" value="<?= $man ?>">

        <select class="select-css" name='section'>
            <option value="" hidden disabled selected>Тематика квест-тура</option>
            <?php
            $section = mysqli_query($connect, "SELECT * FROM `section`");
            $section_count = mysqli_num_rows($section);
            for ($i = 0; $i < $section_count; $i++) {
                $array_section = mysqli_fetch_assoc($section);
                $id_section = $array_section["id_section"];
                $section_name = $array_section["section_name"];
                if ($id_section_quests == $id_section) {
                    echo "<option selected value='$id_section'>$section_name</option>";
                } else {
                    echo "<option value='$id_section'>$section_name</option>";
                }

            }
            ?>
        </select>

        <select class="select-css" name='location'>
            <option value="" hidden disabled>Район города</option>
            <?php
            $location = mysqli_query($connect, "SELECT * FROM `location`");
            $location_count = mysqli_num_rows($location);
            for ($i = 0; $i < $location_count; $i++) {
                $array_location = mysqli_fetch_assoc($location);
                $id_location = $array_location["id_location"];
                $location_name = $array_location["location_name"];
                if ($id_location_quests == $id_location) {
                    echo "<option selected value='$id_location'>$location_name</option>";
                } else {
                    echo "<option value='$id_location'>$location_name</option>";
                }
            }
            ?>
        </select>
        <label>Чтобы добавить задания,<b> сохраните информацию о квест-туре</b>, в дальнейшем ее можно отредактировать
            до официального подтверждения модератора.</label>
        <input type='button' style='margin-bottom: 35px;' value='Редактировать Квест-Тур' class='button_action'
               onclick='red_quest()'>
        <input style='display:none;' type='text' name='id_quest_value' id='id_quest_value' value="<?= $id_quests ?>">


        <div id='red'></div>
        <center><a href='personal_account.php'>Завершить редактирование квеста и выйти на страницу аккаунта.</a>
        </center>

    </form>
    <?php else:
        exit('<label id="error_mess">Такого квеста не существует, вернитесь <b>на страницу назад</b> и активируйте ссылку снова.<a onclick="javascript:history.back(); return false;">Назад</a></label>');
        ?>
    <? endif; ?>
</div>
<?php
$task_c = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_quests`='$id_quests'");
$task_count = mysqli_num_rows($task_c);
for ($i = 1;
     $i <= $task_count;
     $i++) {
    $arr_task = mysqli_fetch_assoc($task_c);
    $id_task = $arr_task['id_task'];
    $id_task_passing = $arr_task['id_task_passing'];
    $id_quests = $arr_task['id_quests'];
    $inf_task_text = $arr_task['inf_task_text'];
    $answer = $arr_task['answer'];
    $hint = $arr_task['hint'];
    $time = $arr_task['time'];
    $coordinates = $arr_task['coordinates'];
    $file_url = $arr_task['file_url'];

    $type_task = mysqli_query($connect, "SELECT * FROM `type_task` WHERE `id_task`='$id_task'");
    $array_type_task = mysqli_fetch_assoc($type_task);
    $type = $array_type_task["type"];

if($id_task == 8){
        print<<<top8
                <div class="form" style = "width: 80%;margin-left: 10%;background-color: #fcf0b3;" >
                
                <form class="task_class" >
                <h1 class="number_task" >$i  Задание </h1 ><h3 > $type </h3 >
                <input type = "button"  onclick = "delete_task($i);" value = "Удалить задание" class="button_action" >
                <textarea class="text_quest" name = "text" placeholder = "Ключевое задание и описание объекта..." pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >$inf_task_text</textarea >
                <label > Фото пояснение задания </label >
                <input value="$file_url" type = "file" name = "file" class="button_action" style = "background-color: #89ac76;" placeholder = "Фотоответ к заданию" >
                <input value="$hint" type = "text" name = "hint" placeholder = "Подсказка к заданию" pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >
                <input value="$answer" type = "text" name = "answer" placeholder = "Ответ на задание" pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >
                <input value="$time" type = "text" name = "time" class="text_width" placeholder = "Время прохождения в минутах" pattern = "[0-9]{1,3}" >
                <label > Каждое задание необходимо сохранять отдельно </label >
                <input style = "display:none;" type = "text" name = "id_quest_value" value = "$id_quests" >
                <input style = "display:none;" type = "text" name = "id_task" value = "$id_task_passing" >
                <input style = "display:none;" type = "text" value = "1" placeholder = "Значение для редактирования" >
                <input type = "button"  onclick = "save_task($i);" value = "Редактировать задание" class="button_action" >
top8;
    }
    else if ($id_task == 1) {
        print<<<top
            <div class="form" style="width: 80%;margin-left: 10%;background-color: #fff;">
            
            <form class="task_class">
            <h1 class="number_task"> $i Задание </h1><h3>$type</h3>
            <input type = "button"  onclick = "delete_task($i);" value = "Удалить задание" class="button_action" >
            <textarea class="text_quest" name="text" placeholder="Ключевое задание и описание объекта..." pattern="^[?!,-.а-яА-ЯёЁ0-9\s]+$">$inf_task_text</textarea>
            <label>Фото пояснение задания</label>
            <input value="$file_url" type="file" name="file" class="button_action" placeholder="Фотоответ к заданию">
            <input value="$time" type="text" name="time" class="text_width" placeholder="Время прохождения в минутах" pattern="[0-9]{1,3}">
            <label>Каждое задание необходимо сохранять отдельно</label>
            <input style="display:none;" type="text" name="id_quest_value" value="$id_quests">
            <input style="display:none;" type="text" name="id_task" value="$id_task_passing">
            <input style="display:none;" type="text" value="1" placeholder="Значение для редактирования">
            <input type="button"  onclick="save_task($i);" value="Редактировать задание" class="button_action">
top;
    } else if ($id_task == 2) {
        print<<<top2
                <div class="form" style = "width: 80%;margin-left: 10%;background-color: #e1edeb;" >
                
                <form class="task_class" >
                <h1 class="number_task" > $i  Задание </h1 ><h3 >$type</h3 >
                <input type = "button"  onclick = "delete_task($i);" value = "Удалить задание" class="button_action" >
                <textarea class="text_quest" name = "text" placeholder = "Ключевое задание и описание объекта..." pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >$inf_task_text</textarea >
                <label > Фото пояснение задания </label >
                <input value="$file_url" type = "file" name = "file" class="button_action" placeholder = "Фотоответ к заданию" >
                <input  value="$hint" type = "text" name = "hint" placeholder = "Подсказка к заданию" pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >
                <input  value="$answer" type = "text" name = "answer" placeholder = "Распознаваемый на фото текст(Ответ)" pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >
                <input value="$time" type = "text" name = "time" class="text_width" placeholder = "Время прохождения в минутах" pattern = "[0-9]{1,3}" >
                <label > Каждое задание необходимо сохранять отдельно </label >
                <input style = "display:none;" type = "text" name = "id_quest_value" value = "$id_quests" >
                <input style = "display:none;" type = "text" name = "id_task" value = "$id_task_passing" >
                <input style = "display:none;" type = "text" value = "1" placeholder = "Значение для редактирования" >
                <input type = "button"  onclick = "save_task($i);" value = "Редактировать задание" class="button_action" >
top2;
    } else if ($id_task == 3) {
print<<<top3
                <div class="form" style = "width: 80%;margin-left: 10%;background-color: #eff5b8;" >
                
                <form class="task_class" >
                <h1 class="number_task" >$i  Задание </h1 ><h3 > $type </h3 >
                <input type = "button"  onclick = "delete_task($i);" value = "Удалить задание" class="button_action" >
                <textarea class="text_quest" name = "text" placeholder = "Ключевое задание и описание объекта..." pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >$inf_task_text</textarea >
                <label > Фото пояснение задания </label >
                <input value="$file_url" type = "file" name = "file" class="button_action" placeholder = "Фотоответ к заданию" >
                <input value="$hint" type = "text" name = "hint" placeholder = "Подсказка к заданию" pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >
                <input value="$answer" type = "text" name = "answer" placeholder = "Количество распознаваемых лиц" pattern = "[0-9]{1,2}" >
                <input value="$time" type = "text" name = "time" class="text_width" placeholder = "Время прохождения в минутах" pattern = "[0-9]{1,3}" >
                <label > Каждое задание необходимо сохранять отдельно </label >
                <input style = "display:none;" type = "text" name = "id_quest_value" value = "$id_quests" >
                <input style = "display:none;" type = "text" name = "id_task" value = "$id_task_passing" >
                <input style = "display:none;" type = "text" value = "1" placeholder = "Значение для редактирования" >
                <input type = "button"  onclick = "save_task($i);" value = "Редактировать задание" class="button_action" >
top3;
    } else if ($id_task == 4) {
        print<<<top4
                <div class="form" style = "width: 80%;margin-left: 10%;background-color: #badbad;" >
                
                <form class="task_class" >
                <h1 class="number_task" >$i  Задание </h1 ><h3 > $type </h3 >
                <input type = "button"  onclick = "delete_task($i);" value = "Удалить задание" class="button_action" >
                <textarea class="text_quest" name = "text" placeholder = "Ключевое задание и описание объекта..." pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >$inf_task_text</textarea >
                <label > Фото пояснение задания </label >
                <input value="$file_url" type = "file" name = "file" class="button_action" style = "background-color: #89ac76;" placeholder = "Фотоответ к заданию" >
                <input value="$hint" type = "text" name = "hint" placeholder = "Подсказка к заданию" pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >
                <input value="$coordinates" type = "text" name = "ansver1" class="text_width" placeholder = "Координаты широты" pattern = "[\d]\.[\d]{4,}" >
                <input value="$coordinates" type = "text" name = "ansver2" class="text_width" placeholder = "Координаты долготы" pattern = "[\d]\.[\d]{4,}" >
                <input type = "button"  onclick = "geo_teg($i)" value = "Текущие геоданные" class="button_action" >
                <input value="$time" type = "text" name = "time" class="text_width" placeholder = "Время прохождения в минутах" pattern = "[0-9]{1,3}" >
                <label > Каждое задание необходимо сохранять отдельно </label >
                <input style = "display:none;" type = "text" name = "id_quest_value" value = "$id_quests" >
                <input style = "display:none;" type = "text" name = "id_task" value = "$id_task_passing" >
                <input style = "display:none;" type = "text" value = "1" placeholder = "Значение для редактирования" >
                <input type = "button"  onclick = "save_task($i);" value = "Редактировать задание" class="button_action" >
        
top4;
    }else if ($id_task == 5) {
print<<<top5
                <div class="form" style = "width: 80%;margin-left: 10%;background-color: #e3e298;" >
                
                <form class="task_class" >
                <h1 class="number_task" > $i  Задание </h1 ><h3 > $type </h3 >
                <input type = "button"  onclick = "delete_task($i);" value = "Удалить задание" class="button_action" >
                <textarea class="text_quest" name = "text" placeholder = "Ключевое задание и описание объекта..." pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >$inf_task_text</textarea >
                <input value="$hint" type = "text" name = "hint" placeholder = "Подсказка к заданию" pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >
                <label > Фото ответ для сравнения </label >
                <input value="$file_url" type = "file" name = "file" class="button_action" placeholder = "Фотоответ к заданию" >
                <input value="$time" type = "text" name = "time" class="text_width" placeholder = "Время прохождения в минутах" pattern = "[0-9]{1,3}" >
                <label > Каждое задание необходимо сохранять отдельно </label >
                <input style = "display:none;" type = "text" name = "id_quest_value"  value = "$id_quests"  >
                <input style = "display:none;" type = "text" name = "id_task" value = "$id_task_passing">
                <input style = "display:none;" type = "text" value = "1" placeholder = "Значение для редактирования" >
                <input type = "button"  onclick = "save_task($i);" value = "Редактировать задание" class="button_action" >
top5;
    } else if ($id_task == 6) {
print<<<top6
                <div class="form" style = "width: 80%;margin-left: 10%;background-color: #e2f7df;" >
                
                <form class="task_class" >
                <h1 class="number_task" > $i  Задание </h1 ><h3 >$type </h3 >
                <input type = "button"  onclick = "delete_task($i);" value = "Удалить задание" class="button_action" >
                <textarea class="text_quest" name = "text" placeholder = "Ключевое задание и описание объекта..." pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >$inf_task_text</textarea >
                <label > Фото пояснение задания </label >
                <input value="$file_url" type = "file" name = "file" class="button_action" style = "background-color: #89ac76;" placeholder = "Фотоответ к заданию" >
                <input value="$hint" type = "text" name = "hint" placeholder = "Подсказка к заданию" pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >
                <input value="$answer" type = "text" name = "answer" class="qr_adress" placeholder = "Ответ на задание для qr чтения" pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >
                <input type = "button" onclick = "save_qr(' + int_number )" value = "Сохранить QR код" class="button_action" >
                <input value="$time" type = "text" name = "time" class="text_width" placeholder = "Время прохождения в минутах" pattern = "[0-9]{1,3}" >
                <label > Каждое задание необходимо сохранять отдельно </label >
                <input style = "display:none;" type = "text" name = "id_quest_value" value = "$id_quests" >
                <input style = "display:none;" type = "text" name = "id_task" value = "$id_task_passing" >
                <input style = "display:none;" type = "text" value = "1" placeholder = "Значение для редактирования" >
                <input type = "button"  onclick = "save_task($i);" value = "Редактировать задание" class="button_action" >
top6;
    }else if ($id_task == 7) {
print<<<top7
                <div class="form" style = "width: 80%;margin-left: 10%;background-color: #e2f7df;" >
                
                <form class="task_class" >
                <h1 class="number_task" >$i  Задание </h1 ><h3 > $type </h3 >
                <input type = "button"  onclick = "delete_task($i);" value = "Удалить задание" class="button_action" >
                <textarea class="text_quest" name = "text" placeholder = "Ключевое задание и описание объекта..." pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >$inf_task_text</textarea >
                <label > Фото пояснение задания </label >
                <input value="$file_url" type = "file" name = "file" class="button_action" style = "background-color: #89ac76;" placeholder = "Фотоответ к заданию" >
                <input value="$hint" type = "text" name = "hint" placeholder = "Подсказка к заданию" pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >
                <input value="$answer" type = "text" name = "answer" placeholder = "Распознаваемая фраза(Ответ)" pattern = "^[?!,-.а-яА-ЯёЁ0-9\s]+$" >
                <input value="$time" type = "text" name = "time" class="text_width" placeholder = "Время прохождения в минутах" pattern = "[0-9]{1,3}" >
                <label > Каждое задание необходимо сохранять отдельно </label >
                <input style = "display:none;" type = "text" name = "id_quest_value" value = "$id_quests" >
                <input style = "display:none;" type = "text" name = "id_task" value = "$id_task_passing" >
                <input style = "display:none;" type = "text" value = "1" placeholder = "Значение для редактирования" >
                <input type = "button"  onclick = "save_task($i);" value = "Редактировать задание" class="button_action" >
                
top7;
    }
    echo '</form></div >';
}

?>
<input id="task_count_number" type="hidden" value="<?=$task_count?>">

<div id='more_task' style="color:black;"></div>
<div id='task'>
    <select name='type_task' class='task_real'>
        <option value="" hidden disabled selected>Выберите тип задания</option>
        <?php
        $type_task = mysqli_query($connect, "SELECT * FROM `type_task`");
        $type_task_count = mysqli_num_rows($type_task);
        for ($a = 0; $a < $type_task_count; $a++) {
            $array_type_task = mysqli_fetch_assoc($type_task);
            $id_tas_k = $array_type_task["id_task"];
            $type = $array_type_task["type"];
            $info_task = $array_type_task["info_task"];
            print ("<option value='$info_task' alt='$id_tas_k'>$type</option>");
        }
        ?>
    </select>
    <label id="text_type">Выберите тип задания, чтобы увидеть его описание</label>
    <input type="button" onclick='new_form()' value="Создать форму для нового задания" class="button_action">
    <label>Все поля формы являются необязательными, в дальнейшем вы можете отредактировать их или дождаться изменений от
        модератора</label>
</div>

<a href='personal_account.php' class="quest_a"><input type="button" onclick=''
                                                      value=" Завершить редактирование квест-тура "
                                                      class="button_action"></a>

<div id='qr_gen' style="display: none;">
    <input type="text" name="ansver" id="text_qr" placeholder="Ответ на задание для qr чтения"
           pattern="^[А-Яа-яЁё'+'\\'+'s]+$">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="qrcode"/>
    </svg>
</div>

<?php
footer_block();
?>

</body>
</html>