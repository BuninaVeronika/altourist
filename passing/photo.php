<?php
include_once('../include/include.php');
global $connect;
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

</head>
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
<div class='form passing_form'>
    <h1>Тип задания</h1>
    <label>Когда я был еще мальчиком, умер мой дед, он был скульптором.
        Он был очень добрый человек, очень любил людей, это он помог очистить наш город от трущоб.
        Нам, детям, он мастерил игрушки, за свою жизнь, он, наверно, создал миллион разных вещей.
        Руки его всегда были чем-то заняты. И вот когда он умер, я вдруг понял, что плачу не о нем, а о тех вещах,
        которые он делал.
        Я плакал потому, что знал: ничего этого больше не будет, дедушка уже не сможет вырезать фигурки из дерева,
        разводить с нами голубей на заднем дворе, играть на скрипке или рассказывать нам смешные истории – никто не умел
        так их рассказывать, как он.
        Он был частью нас самих, и когда он умер, все это ушло из нашей жизни: не осталось никого, кто мог бы делать это
        так, как делал он.
    </label>
    <img src="">
    <p></p>
    <input type="button">
    <p></p>
    <input type="button">
    <input type="button">


</div>


<?php
footer_block();
?>

</body>
</html>