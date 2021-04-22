<?php
include_once('include/include.php');
global $connect;
header_block();
?>




<?php
if (!empty($_GET['section'])) {
    $id_section = $_GET['section'];
    $section = mysqli_query($connect, "SELECT * FROM `section` WHERE `id_section`='$id_section' ");
    $array = mysqli_fetch_assoc($section);
    $section_name = $array["section_name"];
    echo "<div style='margin:10px 10%; width: 80%;' class='form'><h1>$section_name квесты</h1></div>";
    $section_quest = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_section`='$id_section' AND `status`='1' ORDER BY reiting DESC ");

}
elseif(!empty($_GET['location'])) {
    $id_location = $_GET['location'];
    $location_section = mysqli_query($connect, "SELECT * FROM `location` WHERE `id_location`='$id_location'");
    $array_location = mysqli_fetch_assoc($location_section);
    $location_name = $array_location["location_name"];
    echo "<div style='margin:10px 10%; width: 80%;' class='form'><h1>$location_name</h1></div>";
    $section_quest = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_location`='$id_location' AND `status`='1' ORDER BY reiting DESC ");

}
elseif(!empty($_GET['search'])) {
    $search = $_GET['search'];
    echo "<div style='margin:10px 10%; width: 80%;' class='form'><h1>Результат поиска по запросу: $search</h1></div>";
    $section_quest = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `quests_name` LIKE '%$search%' OR `text_quests` LIKE '%$search%' ='1' ORDER BY reiting DESC ");

}
else{
    exit('<label id="error_mess">Таких квестов не существует, вернитесь <b>на страницу назад</b> и активируйте ссылку снова.<a onclick="javascript:history.back(); return false;">Назад</a></label>');
}

$section_count = mysqli_num_rows($section_quest);
for ($i = 1; $i <= $section_count; $i++) {
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

    print<<<section_quest
	<div  class='form section_quest'>
	<section class="left_info">
	<img  src='$file'/>
	<input class='button_check put_aside' id="button_check" id_quest='$id_quests'  type="button" name="quest_user" value="&#xe806;">
	<input style="width: 200px;" class='purchase button_action'  id_quest='$id_quests' type="button" name="quest_info" value="Купить">
	</section>
	<div class="right_info">
    <p class='hard_level' title="Сложность прохождения" style='background:#F1B24A;'>$complication</p>
	<a href="quest_tour.php?id_quest=$id_quests"><h1>$quests_name</h1></a>
	<label>$text_quests</label>
	<p title="Стоимость" class="icon_list">&#xf158;</p><p>$sale</p>
	<p title="Время прохождения" class="icon_list">&#xe802;</p><p>$time </p><p>мин.</p>
	<p title="Расстояние" class="icon_list">&#xe801;</p><p>$distance </p><p>км.</p>
	
	<a href="quest_tour.php?id_quest=$id_quests"><input class='button_action' type="button" name="quest_info" value="Подробнее"></a>
	</div>
	</div>
section_quest;

}

?>





<?php
footer_block();
?>

</body>
</html>