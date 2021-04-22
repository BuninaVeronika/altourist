<?php include_once('include/include.php');
header_block();

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

        echo "<h3> Приветствуем вас," . $name . "</h3>";
        echo "<h3>Email: " . $email . "</h3>";
        echo "<h3>Телефон: " . $number . "</h3>";
        echo "<img style='float:right; width:30%; margin:10px 35%;' src=" . "$avatar" . ">";
        //сообщение о подтверждение телефона и кнопка для соотвественно сообщения
    }

    ?>
    </h3>
    <center><a href='#'>Отказаться от рассылок на почту</a></center>
    <br>
    <input type="button" class='button_action' onclick='close_account()' value="Выход" name="">
    <a href='account_edit.php'><input type="button" class='button_action' value="Редактировать профиль" name=""></a>

    <?if($number_confirmation ==1):?><a href='add_a_quest.php'><input type="button" class='button_action' name="" value="Добавить квест"></a><?endif;?>
</div>

<section class="lk_section_block" style="width: 100%; float:left;">

    <div>
        <a href="/personal_account.php?qsection=o"><h1>Отложенные квесты</h1></a>
        <?if($email_confirmation==1):?><a href="/personal_account.php?qsection=p"><h1>Квесты в прохождении</h1></a><?endif;?>
        <a href="/personal_account.php?qsection=s"><h1>Купленные квесты</a></a>
    </div>

    <?php
    if($_GET['qsection']=='o' || empty($_GET['qsection']) ) {
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
<input style='width: 200px;' class='purchase button_action'  id_quest='$id_quests_purchases' type='button' name='quest_info' value='Начать прохождение'>
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
footer_block();
?>

</body>
</html>