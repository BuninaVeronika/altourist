<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Altouruist</title>
    <meta charset="utf-8">
    <meta name="robots" content="index">
    <meta name="description" content="Квест-туры в разных городах и тематиках прохождения. Поробуй исследовать и создавать досуг на своих правилах.">
    <meta name="keywords" content="квесты, туры, туризм, городская среда, путешествия, курск, ">
    <meta name="author" content="Бунина Вероника">
    <link rel="icon" href="img/logo1.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/style_other.css">
    <script defer src="js/jquery_3.5.1.min.js"></script>
    <script defer src="js/jq_cookie.js"></script>
    <script defer src="js/head_other.js"></script>

    <link rel="stylesheet" type="text/css" href="css/style_head.css">
    <link rel="stylesheet" type="text/css" href="css/style_head_media.css">

    <script defer src="js/head_js.js"></script>

</head>
<body>

<div class="kies" id='cookies_class'>
    <input type="button" name="" id='cookies_ok' value="ОК">
    <p>Используя данный сайт, вы даете согласие на использование файлов cookie, данных о местоположении и IP-адрес, помогающих нам сделать сервис удобнее для вас. <a href=''>Подробнее</a></p>
</div>

<!--Первый блок с рейтинговым топом разделов/тематик-->
<div class="block_head">
    <?php
    include_once("include/bd.php");
    global $connect;

    $quest_id_file = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_section`='1'  ORDER BY reiting DESC LIMIT 1");
    $array_quest_file = mysqli_fetch_assoc($quest_id_file);
    $file = $array_quest_file["file"];
    print<<<file
    <img class='background_img' src="$file">
    <img class='background_img_bottom' src="$file">
file;

    ?>

    <a name="top"></a>
    <header>
        <a href='index.php'><img class='logo_img' src="img/logo1.svg">
            <h3 class='logo_title'>altouruist</h3></a>
    </header>
    <select style="display: none;">
        <!--Блок подгружается из базы данных-->
        <option selected value="Курск">Курск</option>
        <option value="Москва">Москва</option>
    </select>
    <div class='nav_right'>
        <input type="text" name="search" class="input_search" pattern="^[?!,-.а-яА-ЯёЁ0-9\s]+$"><input type="button" class='button_check' name="search_button" value="&#xe800;" id='search_button'>
        <input  type="button" id='reg_button' name="reg_button" class='button_check' value="&#xf2be;" >
    </div>

    <nav class='menu_head'>
        <ul>
            <a href='#top'><li>Главная</li></a>
            <a href='#them'><li>Тематики</li></a>
            <a href='#inf'><li>Информация</li></a>
            <a href='#feedback'><li>Отзывы</li></a>
            <a href='#contact'><li>Ссылки</li></a>
        </ul>
    </nav>

    <div class='right_list'>

        <?php

        $section = mysqli_query($connect, "SELECT * FROM `section` ");
        $array_count = mysqli_num_rows($section);
        for($i=1;$i<=$array_count;$i++){
        $array = mysqli_fetch_assoc($section);
        $id_section = $array["id_section"];
        $section_name = $array["section_name"];
        $quest = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_section`='$id_section'  ORDER BY reiting DESC LIMIT 1");
        $array_quest = mysqli_fetch_assoc($quest);
        $id_quests = $array_quest["id_quests"];
        $quests_name = $array_quest["quests_name"];
        $text_quests = $array_quest["text_quests"];
        $reiting = $array_quest["reiting"];
        $file = $array_quest["file"];
        $age = $array_quest["age"];
        $sale = $array_quest["sale"];
        $time = $array_quest["time"];
        $distance = $array_quest["distance"];
        $man = $array_quest["man"];
        $complication = $array_quest["complication"];
        $id_t = $array_quest["id_t"];
        $status = $array_quest["status"];
        $technical = $array_quest["technical"];
        $id_location = $array_quest["id_location"];
        $location_section = mysqli_query($connect, "SELECT * FROM `location` WHERE `id_location`='$id_location'");
        $array_location = mysqli_fetch_assoc($location_section);
        $location_name = $array_location["location_name"];
        print<<<block
         <section class='block_quest' num='$i' style="background-image: url('$file');">
            <abbr class='d_block' src="$file"></abbr>
            <p class='hard_level' title="Сложность прохождения" style='background:#F1B24A;'>$complication</p>
            <div class="block_blur">
                <h5 id='head_tem'><a href="section_quest.php?section=$id_section">$section_name</a></h5>
                <hr>
                <h4 id='name_quest'><a href="quest_tour.php?id_quest=$id_quests">$quests_name</a></h4>
                <p class="icon">&#xe802;</p><p class='time_s' title="Время прохождения">$time мин.</p>
                <p class="class_none" id='histori'>$text_quests</p>
                <p class="class_none" id='location'><a href="section_quest.php?location=$id_location">$location_name</a></p>
                <p class="class_none" id='sum'>$sale</p>
            </div>
        </section>
block;
        }
        ?>

    </div>


    <section class='left_info'>
        <?php
        $quest_id = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_section`='1'  ORDER BY reiting DESC LIMIT 1");
        $array_quest_id = mysqli_fetch_assoc($quest_id);
        $id_quests = $array_quest_id["id_quests"];
        $quests_name = $array_quest_id["quests_name"];
        $text_quests = $array_quest_id["text_quests"];
        $sale = $array_quest_id["sale"];
        $time = $array_quest_id["time"];
        $id_location = $array_quest_id["id_location"];
        $location_section = mysqli_query($connect, "SELECT * FROM `location` WHERE `id_location`='$id_location'");
        $array_location = mysqli_fetch_assoc($location_section);
        $location_name = $array_location["location_name"];

print<<<id
        <h5 id='tem_result'><a href="section_quest.php?section=$id_section">Спортивные</a></h5>
        <a href="quest_tour.php?id_quest=$id_quests"><h4 id='name_result'>$quests_name</h4></a>
        <span id='info_result'>$text_quests</span>
        <p class="icon" style="width: 5%;">&#xe801;</p><span style='width: 95%;' id='location_result'><a href="section_quest.php?location=$id_location">$location_name</a></span>
        <p class="icon" style="width: 5%;">&#xf158;</p><p id='sum_result' style="width: 95%;">$sale</p>
        
id;
?>
    </section>

    <div class='left_slide'>
        <input type="button" id="l" value="&#xf137;" rel='5'>
        <input type="button" id="r" value="&#xf138;" rel='5'>
        <hr class='clr_hr' style="border: 1px solid #F1B24A"><hr class='clr_hr'><hr class='clr_hr'><hr class='clr_hr'><hr class='clr_hr'>
        <p id='str_num'>01</p>
    </div>

</div>


<!--Второй блок с инфо о прохождении квеста-->
<section class="plus_quest">

    <img class='left_gif' src="img/gif_log.jpg">
    <h3>Преимущества<br> квест-туров</h3>
    <li>Можно начать свое путешествие в <b>удобное для вас время.</b></li>
    <li>Множество квестов <b>под настроение и возможности.</b></li>
    <li>Проходите в <b> одиночестве</b> или <b>собирайте компанию</b> для веселого досуга.</li>
    <li><b>Своя волна и темп</b> или <b>соревнование на время</b> среди своих.</li>
    <li>Начните зарабатывать, <a href="#inf_reg">создавая</a> <b>собственные квесты.</b></li>

</section>

<!--Трейтий блок с слайдером разделов/тематик-->
<div class="slide_quest_block">
    <a name="them"></a>
    <h5>Тематики</h5>
    <input type="button" id='l_s' name="" value="&#xf137;">
    <input type="button" id='r_s' name="" value="&#xf138;">
    <div class='center_list'>
<?php

        $section = mysqli_query($connect,"SELECT * FROM `section`");
        $section_count=mysqli_num_rows($section);

        for ($i = 1;$i <= $section_count;$i++) {
            $array=mysqli_fetch_assoc($section);
            $id_section=$array["id_section"];
            $section_name=$array["section_name"];
            $file=$array["file"];

            $count_quest=mysqli_query($connect,"SELECT * FROM `quests_altrst` WHERE `id_section`='$id_section' AND `status`='1'");
            $number_count=mysqli_num_rows($count_quest);
            print<<<section
		<section class='section_li' style="background-image: url($file);">
		<p class="hard_level">$number_count</p>
		<a href="section_quest.php?section=$id_section">
		<h4>$section_name</h4>
		</a>
		<hr>
		<a style='border:none;' href='section_quest.php?section=$id_section'>
		<input style=' backdrop-filter: blur(8px);' type="button" class='button_action' name="quest_info" value="Перейти">
		</a>
		</section>
section;
        }
        ?>
    </div>

</div>

<!--Четвертый блок с инфо о прохождении квеста-->
<div class="plus_quest">
    <a name="inf"></a>
    <img class='left_gif' src="img/gif_log2.jpg" style="float: right;">
    <h3>Как принять участие в квест-туре?</h3>
    <ul class='li_quest'>
        <p class="icon_list">&#xe803;</p><li>Для этого потребуется телефон и стабильное интернет соединение.</li>
        <p class="icon_list">&#xf2c1;</p><li>Зарегистрируйтесь, чтобы иметь доступ к квестам и их прогрессу.</li>
        <p class="icon_list">&#xe804;</p><li>Подберите квест и проведите оплату черз онлайн-платежи (в базе квестов присутсвуют так же и <a href="#">БЕСПЛАТНЫЕ</a>), <a href="#inf_reg">авторам квестов</a> перечисляются проценты от их продажи.<br><br></li>
        <p class="icon_list">&#xe801;</p><li>Перейдите на заданную точку в первом задании.</li>
        <p class="icon_list">&#xf278;</p><li>Перед вами стоит задача, условия который вы должны выполнить.<br>Это может быть распознование лиц или текста на фотографии, ключевая фраза произнесенная вами вслух, переход на ключевую гео. локацию и др..<br><br></li>
        <p class="icon_list">&#xe805;</p><li>Вы можете воспользоваться подсказкой или открыть ответ, если задача квеста была неясна.</li>
        <p class="icon_list">&#xf27b;</p><li>Проходите снова и оставляйте свое мнение в отзывах и рейтинге квеста.</li>
    </ul>
</div>

<!--6 блок с регистрацией-->
<div class="block_reg">
    <p>Зарегистрироваться и начать квест-тур</p>
    <form id='spped_reg'>
        <input type="text" required name="email" class="input_mail" placeholder="email@email.com" pattern="\S+@[a-z]+.[a-z]+">
        <input type="password" required name="password" class="input_mail" placeholder="password" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
        <label style="display: none;" class="container">Для предоставления услуг сервиса подтверждаю согласие с условиями <a href='' >пользовательского соглашения</a>
            <input type="checkbox" checked="checked" name='sogl' value="Yes">
            <span class="checkmark"></span></label>
        <input style='width: 250px;' type="button" onclick='speed_reg()' value="Регистрация" class='button_action'>
    </form>
</div>

<!--Пятый блок с отзывыми пользователей-->
<div class="block_person">
    <a name="feedback"></a>
    <h5>Отзывы</h5>
    <div class='soc_center'>
        <?php
        $user_soc = mysqli_query($connect,"SELECT * FROM `reviews` ORDER BY RAND() LIMIT 5");
        for ($i=0; $i<5;$i++){
            $array_feedback = mysqli_fetch_assoc($user_soc);
            $id_t_feedback = $array_feedback['id_t'];
            $id_quests= $array_feedback['id_quests'];
            $text_quests= $array_feedback['text_quests'];
            $user_name = mysqli_query($connect,"SELECT `avatar`  FROM `user_tourist` WHERE `id_t`='$id_t_feedback'");
            $user = mysqli_fetch_assoc($user_name);
            $avatar = $user['avatar'];
            $quest_soc = mysqli_query($connect,"SELECT `quests_name` FROM `quests_altrst` WHERE `id_quests`='$id_quests'");
            $quest = mysqli_fetch_assoc($quest_soc);
            $quests_name = $quest['quests_name'];
            print<<<feed
        <li class="user_soc"><img src="$avatar"><a href="quest_tour.php?id_quest=$id_quests"><h4>$quests_name</h4></a><p>$text_quests</p></li>
feed;
        }
        ?>
        </div>
</div>

<!--Второй блок с инфо о прохождении квеста-->
<section class="plus_quest">
    <a name="inf_reg"></a>
    <img class='left_gif' src="img/gif_log.jpg" title="0xe80b - код индикатора запуска">
    <h3>Как зарегистрировать собственный квест-тур?</h3>
    <ul class='li_quest'>
        <p class="icon_list">&#xf2c1;</p><li>Зарегистрируйтесь, чтобы иметь доступ к квестам и результатам модерации ваших запросов.</li>
        <p class="icon_list">&#xe808;</p><li>В личном кабинете перейдите на вкладку "регистрация квест-тура".</li>
        <p class="icon_list">&#xf0cb;</p><li>Следуйте инструкциям в форме для добавления заданий.</li>
        <p class="icon_list">&#xf277;</p><li>Выбирайте разнообразные типы задач, чтобы пользователю было интересно взаимодействовать с квестом.</li>
        <p class="icon_list">&#xf0e0;</p><li>Смело отправляйте свои идеи на проверку администратору и после редактирования/подверждения возможно именно твой квест-тур появиться в топе.<br><br></li>
        <p class="icon_list">&#xf295;</p><li>Проценты от продажи квеста идут напрямую в аккаунт автора.</li>
        <p class="icon_list">&#xe807;</p><li>Подробнее о процессе и нюансах можно почитать в <a href="">пользовательском соглашении</a>.</li>
    </ul>

</section>

<footer>
    <div class='foot_block'>
        <a name="contact"></a>
        <p>&#169; 2020-2021 "Альтуруист"- Активный и пассивный досуг на твоих правилах.</p>
        <a href='index.php'><img class='logo_img' src="img/logo1.svg"></a>
    </div>
    <div class='foot_block'>
        <h6>Контактные ресурсы</h6>
        <email><p style='margin: -1px 10px 0 0;' class="icon">&#xe809;</p>Top@gmail.com</email>
        <a class="icon_list" title='ВК' href="#">&#xf189;</a>
        <a class="icon_list" title='ИНСТАГРАМ' href="#">&#xf16d;</a>

    </div>
    <div class='foot_block'>
        <h6>Внутренние документы</h6>
        <a>Политика конфеденциальности</a>
        <a>О деятельности компании</a>
        <a>Публичная оферта</a>
    </div>
    <div class='foot_block'>
        <h6>Инструкции по функционалу</h6>
        <a><p style='margin: -5px 5px 0 0;' class="icon_list">&#xe807;</p>Прохождение квеста</a>
        <a><p style='margin: -5px 5px 0 0;' class="icon_list">&#xe807;</p>Регистрация квеста</a>
    </div>
    <a href="#top" style='margin-left: 25px; font-size: 75px; color:#F1B24A; border:none;' class="icon">&#xf139;</a>
    <address>Разработчик: <a href="https://www.behance.net/ferenicavv">Бунина Вероника</a></address>
</footer>





</body>
</html>