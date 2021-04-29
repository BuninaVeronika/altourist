<?php include_once('include/include.php');
header_block();
if(empty($_GET['qsection'])){
    $_GET['qsection']='o';
}
global $connect;
?>
<div class='form'>
    <h1>Личный кабинет</h1>
    <?php

    echo "<h3>";
    //надо проверить еще подтверждение почты
    verification_of_authorization();

    echo "</h3>";
    $session_hash = $_SESSION['cooki_hash'];
    $account = mysqli_query($connect, "SELECT * FROM `user_tourist` WHERE `cookies_hash`='$session_hash'");
    $array = mysqli_fetch_assoc($account);
    $account_count = mysqli_num_rows($account);
    if (!$account) {
        exit ('Неверный запрос: ' . mysqli_error());
    } elseif ($account_count == 0) {
        echo "<h3>Данные сессии не найдены, непредвиденная ошибка, требуется повторная авторизация</h3>";
    } else {
        $id_t = $array["id_t"];
        $name = $array["name_t"];
        $email = $array["email_t"];
        $number = $array["number_t"];
        $rating = $array["rating"];
        $avatar = $array["avatar"];
        $email_confirmation = $array["email_confirmation"];
        $number_confirmation = $array["number_confirmation"];
        //C выводом поработать

        if ($email_confirmation == 0) {
            echo "<h3 style='color:#F1B24A;'>Подтвердите почту, чтобы иметь возможность проходить квест-туры.</h3>";
            //Кнопка для повторного письма и соотвествующее пояснение, что письмо может быть в спаме
        }if ($number_confirmation == 0) {
            echo "<h3 style='color:#F1B24A;'>Подтвердите телефонный номер, чтобы иметь возможность добавлять квесты.</h3>";
            //Кнопка для повторного письма и соотвествующее пояснение, что письмо может быть в спаме
        }
        echo "<img class='avatar_person' src=" . "$avatar" . ">";
        echo "<h3 class='h3_person'>" . $name . "</h3>";
        echo "<h3 class='h3_person'>" . $email . "</h3><h2 class='h2_person'>Email</h2>";
        echo "<h3 class='h3_person'>" . $number . "</h3><h2 class='h2_person'>Телефон</h2>";

        //сообщение о подтверждение телефона и кнопка для соотвественно сообщения
    }

    ?>

    <a href='#' style="width: 90%; text-align: center; float: left;">Отказаться от рассылок на почту</a>
    <br>
    <input type="button" class='button_action' onclick='close_account()' value="Выход" name="">
    <a href='account_edit.php'><input type="button" class='button_action' value="Редактировать профиль" name=""></a>

    <?if($number_confirmation ==1):?><a href='add_a_quest.php'><input type="button" class='button_action' name="" value="Добавить квест"></a><?endif;?>
</div>
<div class="form">Текущий в прохождении квест</div>

<section class="lk_section_block" style="width: 100%; float:left;">

    <div class="nav_section">
        <a <?if($_GET['qsection']=='o'):?> style="background: #4D774E;" <?endif;?> href="/personal_account.php?qsection=o"><h1>Отложенные квесты</h1></a>
        <?if($email_confirmation==1):?><a <?if($_GET['qsection']=='p'):?> style="background: #4D774E;" <?endif;?> href="/personal_account.php?qsection=p"><h1>Квесты в прохождении</h1></a><?endif;?>
        <a <?if($_GET['qsection']=='s'):?> style="background: #4D774E;" <?endif;?> href="/personal_account.php?qsection=s"><h1>Купленные квесты</h1></a>
    </div>

    <?php
    if(empty($_GET['qsection']) || $_GET['qsection']=='o') {
        $deferred_quests = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_quests` IN (SELECT `id_quests` FROM `deferred_quests` WHERE `id_t`='$id_t')");
        $deferred_quests_count = mysqli_num_rows($deferred_quests);
        if (!$deferred_quests) {
            exit ('Неверный запрос: ' . mysqli_error($connect));
        } else {
            for ($i = 0; $i < $deferred_quests_count; $i++) {

                $arr_def = mysqli_fetch_assoc($deferred_quests);
                $id_quests = $arr_def["id_quests"];
                $quests_name = $arr_def["quests_name"];
                $text_quests = $arr_def["text_quests"];
                $reiting = $arr_def["reiting"];
                $file = $arr_def["file"];
                $age = $arr_def["age"];
                $sale = $arr_def["sale"];
                $time = $arr_def["time"];
                $complication = $arr_def["complication"];
                $distance = $arr_def["distance"];
                $id_t_deferred = $arr_def["id_t"];
                $status = $arr_def["status"];
                $technical = $arr_def["technical"];
                $id_location = $arr_def["id_location"];
                $id_section = $arr_def["id_section"];
                $section = mysqli_query($connect, "SELECT * FROM `section` WHERE `id_section`='$id_section'");
                $array = mysqli_fetch_assoc($section);
                $section_name = $array["section_name"];
                $location_section = mysqli_query($connect, "SELECT * FROM `location` WHERE `id_location`='$id_location'");
                $array_location = mysqli_fetch_assoc($location_section);
                $location_name = $array_location["location_name"];
                print<<<section_quest

    <div  class='form section_quest'>
	<section class="left_info">
	<img style="width: 60%;" src='$file'/>
	<input style="width: 200px;" class='purchase button_action'  id_quest='$id_quests' type="button" name="quest_info" value="Купить">
	</section>
	<div class="right_info">
    <p class='hard_level' title="Сложность прохождения" style='background:#F1B24A;'>$complication</p>
	<a href="quest_tour.php?id_quest=$id_quests"><h1>$quests_name</h1></a>
	
	<a href="section_quest.php?section=$id_section"><p title="Секция" class="icon_list">&#xe801;</p><p style="width: 250px;">$section_name</p></a>
	<a href="section_quest.php?location=$id_location"><p title="Локация" class="icon_list">&#xe801;</p><p style="width: 250px;">$location_name</p></a>
	<p title="Стоимость" class="icon_list">&#xf158;</p><p>$sale</p>
	<p title="Время прохождения" class="icon_list">&#xe802;</p><p>$time </p><p>мин.</p>
	<p title="Расстояние" class="icon_list">&#xe801;</p><p>$distance </p><p>км.</p>
	
	<a href="quest_tour.php?id_quest=$id_quests"><input class='button_action' type="button" name="quest_info" value="Подробнее"></a>
	</div>
	</div>

section_quest;
            }
        }
    }
    elseif($_GET['qsection']=='p') {
        if($email_confirmation ==1) {

            /*  $deferred_quest = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_quests` IN (SELECT `id_quests` FROM `deferred_quests` WHERE `id_t`='$id_t')");
              $deferred_quests_count = mysqli_num_rows($deferred_quests);
              if (!$deferred_quests) {
                  exit ('Неверный запрос: ' . mysqli_error($connect));
              } else {
                  for ($i = 0; $i < $deferred_quests_count; $i++) {

                      $arr_def = mysqli_fetch_assoc($deferred_quests);
                      $id_quests = $arr_def["id_quests"];
                      $quests_name = $arr_def["quests_name"];
                      $text_quests = $arr_def["text_quests"];
                      $reiting = $arr_def["reiting"];
                      $file = $arr_def["file"];
                      $age = $arr_def["age"];
                      $sale = $arr_def["sale"];
                      $time = $arr_def["time"];
                      $complication = $arr_def["complication"];
                      $distance = $arr_def["distance"];
                      $id_t_deferred = $arr_def["id_t"];
                      $status = $arr_def["status"];
                      $technical = $arr_def["technical"];
                      $id_location = $arr_def["id_location"];
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
              }
            */
        }
    }
    elseif($_GET['qsection']=='s') {

        $quest_purchases = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_quests` IN (SELECT `id_quests` FROM `quest_purchases` WHERE `id_t`='$id_t')");
        $quest_purchases_count = mysqli_num_rows($quest_purchases);
        if (!$quest_purchases) {
            exit ('Неверный запрос: ' . mysqli_error($connect));
        } else {
            for ($a = 0; $a < $quest_purchases_count; $a++) {

                $arr_purchases = mysqli_fetch_assoc($quest_purchases);
                $id_quests_purchases = $arr_purchases["id_quests"];
                $quests_name_purchases = $arr_purchases["quests_name"];
                $text_quests_purchases = $arr_purchases["text_quests"];
                $reiting_purchases = $arr_purchases["reiting"];
                $file_purchases = $arr_purchases["file"];
                $age_purchases = $arr_purchases["age"];
                $sale_purchases = $arr_purchases["sale"];
                $time_purchases = $arr_purchases["time"];
                $distance_purchases = $arr_purchases["distance"];
                $complication_purchases = $arr_purchases["complication"];
                $id_t_purchases = $arr_purchases["id_t"];
                $status_purchases = $arr_purchases["status"];
                $technical_purchases = $arr_purchases["technical"];
                $id_location_purchases = $arr_purchases["id_location"];
                $id_section_purchases = $arr_purchases["id_section"];
                $section_purchases = mysqli_query($connect, "SELECT * FROM `section` WHERE `id_section`='$id_section_purchases'");
                $array_section = mysqli_fetch_assoc($section_purchases);
                $section_name_purchases = $array_section["section_name"];
                $location_section_purchases = mysqli_query($connect, "SELECT * FROM `location` WHERE `id_location`='$id_location_purchases'");
                $array_location_purchases = mysqli_fetch_assoc($location_section_purchases);
                $location_name_purchases = $array_location_purchases["location_name"];
                $task_c = mysqli_query($connect, "SELECT * FROM `task` WHERE `id_quests`='$id_quests_purchases'");
                $task_count = mysqli_num_rows($task_c);
                print<<<quest_purchases

    <div  class='form section_quest'>
	<section class="left_info" >
	<img  src='$file_purchases'/>
	<!--написать на кнопку метод-->
quest_purchases;
	if($email_confirmation==1){
        print<<<quest_purchases3
<input style='width: 280px;' class='purchase button_action'  id_quest='$id_quests_purchases' type='button' name='quest_info' value='Начать прохождение'>
<p style='z-index: 15;position: relative; float:left; width: 100%;'>Уровень прохождения</p>
quest_purchases3;
	}
print<<<quest_purchases2
	</section>
	<div class="right_info" >
    <p class='hard_level' title="Сложность прохождения" style='background:#F1B24A;'>$complication_purchases</p>
	<a href="quest_tour.php?id_quest=$id_quests_purchases"><h1>$quests_name_purchases</h1></a>
	<p title="Количество заданий квеста" class="icon_list">&#xe801;</p><p>$task_count</p>	
	<a href="section_quest.php?section=$id_section_purchases"><p title="Секция" class="icon_list">&#xe801;</p><p style="width: 250px;">$section_name_purchases</p></a>
	<a href="section_quest.php?location=$id_location_purchases"><p title="Локация" class="icon_list">&#xe801;</p><p style="width: 250px;">$location_name_purchases</p></a>
		
	<p title="Время прохождения" class="icon_list">&#xe802;</p><p>$time_purchases </p><p>мин.</p>
	<p title="Расстояние" class="icon_list">&#xe801;</p><p>$distance_purchases </p><p>км.</p>
	
	<a href="quest_tour.php?id_quest=$id_quests_purchases"><input class='button_action' type="button" name="quest_info" value="Подробнее"></a>
	</div>
	
	</div>
quest_purchases2;
            }
        }
    }
?>

</section>

<?php
$quest_edit = mysqli_query($connect, "SELECT * FROM `quests_altrst` WHERE `id_t`='$id_t'");
$quest_edit_count = mysqli_num_rows($quest_edit);

if($quest_edit_count >0){
    print('<div class="edit_quest_div"><h1>Редактируемые квесты</h1></div>');
    for ($i = 0; $i < $quest_edit_count; $i++) {

        $arr_edit = mysqli_fetch_assoc($quest_edit);
        $id_quests_edit = $arr_edit["id_quests"];
        $quests_name_edit = $arr_edit["quests_name"];
        $text_quests_edit = $arr_edit["text_quests"];
        $reiting_edit = $arr_edit["reiting"];
        $file_edit = $arr_edit["file"];
        $age_edit = $arr_edit["age"];
        $sale_edit = $arr_edit["sale"];
        $time_edit = $arr_edit["time"];
        $complication_edit = $arr_edit["complication"];
        $distance_edit = $arr_edit["distance"];
        $id_t_deferred_edit = $arr_edit["id_t"];
        $status_edit = $arr_edit["status"];
        $technical_edit = $arr_edit["technical"];
        $id_location_edit = $arr_edit["id_location"];
        $id_section_edit = $arr_edit["id_section"];
        $section = mysqli_query($connect, "SELECT * FROM `section` WHERE `id_section`='$id_section_edit'");
        $array = mysqli_fetch_assoc($section);
        $section_name = $array["section_name"];
        $location_section = mysqli_query($connect, "SELECT * FROM `location` WHERE `id_location`='$id_location_edit'");
        $array_location = mysqli_fetch_assoc($location_section);
        $location_name = $array_location["location_name"];
        if($status_edit==0){ echo ("<div class='form section_quest'>");}
        elseif ($status_edit==-1){ echo ("<div style='background: #ffcf94;' class='form section_quest'>");}
        else { echo ("<div style='background: #a1c2a1;' class='form section_quest'>");}
        print<<<section_quest

    
	<section class="left_info">
	<img style="width: 60%;" src='$file_edit'/>
	</section>
	<div class="right_info">
    <p class='hard_level' title="Сложность прохождения" style='background:#F1B24A;'>$complication_edit</p>
	<a href="quest_tour.php?id_quest=$id_quests_edit"><h1>$quests_name_edit</h1></a>
	<label>$text_quests_edit</label>
	<a href="section_quest.php?section=$id_section_edit"><p title="Секция" class="icon_list">&#xe801;</p><p style="width: 80%;">$section_name</p></a>
	<a href="section_quest.php?location=$id_location_edit"><p title="Локация" class="icon_list">&#xe801;</p><p style="width: 80%;">$location_name</p></a>
section_quest;
        if($status_edit!=1){
print<<<section_quest
            <a href="edit_a_quest.php?id_quest=$id_quests_edit"><input class="button_action" type="button" name="quest_info" value="Редактировать"></a>
section_quest;
        }
	print<<<section_quest
    <a href="quest_tour.php?id_quest=$id_quests_edit"><input class='button_action' type="button" name="quest_info" value="Просмотреть"></a>
	</div>
	</div>
section_quest;


    }
}

?>


<?php
footer_block();
?>

</body>
</html>