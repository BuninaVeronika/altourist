$(document).ready(function () {
    $("#fl_inp").change(function () {
        var filename = $(this).val().replace(/.*\\/, "");
        $("#fl_nm").html(filename);
    });
});

var rglr = true;

function reg_form(t) {


    $(t).each(function () {

        var regexp = new RegExp($(this).attr('pattern'));
        var string = $(this).val();
        rglr = regexp.test(string);

        if (!$(this).val() || $(this).val() == '') {
            rglr = true;
        }

        if (!rglr) {
            $(this).css('border-color', 'red');//Сделаем бордер красным
            //сообщение об обязательных полях
            rglr = false;
        } else {
            $(this).css('border-color', '#F1B24A');
            rglr = true;
        }
        if (!rglr) return false;
    });

    if (!rglr) return false;
}

$("input,textarea").blur(function () {

    var regexp = new RegExp($(this).attr('pattern'));
    var string = $(this).val();
    rglr = regexp.test(string);
    if (!rglr) rglr = false;

    if (!$(this).val() || $(this).val() == '') {
        rglr = true;
    }

    if (!rglr) {
        $(this).css('border-color', 'red');//Сделаем бордер красным
        //сообщение об обязательных полях
        rglr = false;
    } else {
        $(this).css('border-color', '#F1B24A');
        rglr = true;
    }
    if (!rglr) return false;

});


var send = true;

function valid_required(a) {
    send = true;
    $(a).each(function () {
        if (!$(this).val() || $(this).val() == '') {
            $(this).css('border-color', 'red');//Сделаем бордер красным
            //сообщение об обязательных полях
            send = false;
        } else {
            $(this).css('border-color', '#F1B24A');
        }
    });

    if (!send) return false;
}


function avtrz() {

    reg_form('form#avtrz input[type=text]');
    if (!rglr) return false;
    reg_form('form#avtrz input[type=password]');
    if (!rglr) return false;
    valid_required('form#avtrz input:required');
    if (!send) return false;


    var formData = new FormData($('#avtrz')[0]);
    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: "php_form/avtrz.php",
        data: formData
    })
        .done(function (data) {

            if (data == "Авторизован") {
                window.location.href = "personal_account.php";
            } else {
                //$("#error").html(data);
                alert(data);
            }
        });
}

function rgstrz() {

    valid_required('form#rgstrz input:required');
    if (!send) return false;

    reg_form('form#rgstrz input[type=password]');
    if (!rglr) return false;

    reg_form('form#rgstrz input[type=text]');
    if (!rglr) return false;


    var passFields = $('.pass');

    p1 = $.trim(passFields.eq(0).val()),
        p2 = $.trim(passFields.eq(1).val());
    if (p1 != p2) {
        alert("Ваши пароли не совпадают");
        return false;
    }


    var formData = new FormData($('#rgstrz')[0]);
    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: "php_form/rgstrz.php",
        data: formData
    })
        .done(function (data) {

            if (data == "Зарегистрирован") {
                window.location.href = "personal_account.php";
            } else {
                //$("#error").html(data);
                alert(data);
            }
        });
}

function animate_head() {
    $('#head_top').animate({backgroundColor: '#9DC88D'}, 4000)
}

function animate_rehead() {
    $('#head_top').animate({backgroundColor: '#4D774E'}, 4000)
}

let timer1 = setInterval(() => animate_head(), 6000);
let timer2 = setInterval(() => animate_rehead(), 8000);

function close_account() {
    $.ajax({
        url: "php_form/destroy.php",
        cache: false,
        success: function (html) {
            window.location.href = "index.php";
        }
    });

}

function delete_account() {
    result = confirm("Вы действительно хотите удалить свой аккаунт и весь связанный с ним прогресс?");
    if (result == true) {
        $.ajax({
            url: "php_form/delete_account.php",
            cache: false,
            success: function (html) {
                if (html == 'Удалили') {
                    close_account();
                    window.location.href = "index.php";
                } else {
                    alert(html);
                }
            }
        });
    }

}

function edit_account() {
    valid_required('form#edit_account input:required');
    if (!send) return false;

    reg_form('form#edit_account input[type=password]');
    if (!rglr) return false;

    reg_form('form#edit_account input[type=text]');
    if (!rglr) return false;

    var email = $.cookie('email');
    var cooki_hash = $.cookie('cooki_hash');


    var formData = new FormData($('#edit_account')[0]);
    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: "php_form/edit_account.php",
        data: formData
    })
        .done(function (data) {

            if (data == "Изменили") {
                window.location.href = "personal_account.php";
            } else if (data == "email_staticИзменили") {
                $.cookie('email', email, {expires: 28, path: '/'});
                $.cookie('cooki_hash', cooki_hash, {expires: 28, path: '/'});
                window.location.href = "personal_account.php";
            } else if (data == 'email_static' || data == 'Пользователь с данным электронным адреcом уже зарегистрирован, проверьте поле ввода' || data == 'Ошибка загрузки файла на сервер' || data == 'Вы указали неверный текущий пароль пользователя, проверьте первое поле формы паролей, чтобы изменения вступили в силу') {
                if (data != 'email_static') {
                    alert(data);
                }
                $.cookie('email', email, {expires: 28, path: '/'});
                $.cookie('cooki_hash', cooki_hash, {expires: 28, path: '/'});
            } else {
                $.cookie('email', email, {expires: 28, path: '/'});
                $.cookie('cooki_hash', cooki_hash, {expires: 28, path: '/'});
                alert(data);
            }
        });
}

function add_quest() {

    reg_form('form#add_save input[type=text]');
    if (!rglr) return false;
    reg_form('form#add_save textarea');
    if (!rglr) return false;

    var formData = new FormData($('#add_save')[0]);
    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: "php_form/save_quest.php",
        data: formData,
        cache: false,
        success: function (data) {
            $('#save_quest').hide();
            $('#task').show();
            //добавить отдельный иди с иди квеста, чтобы по время сохранения заданий хватать его
            document.getElementById("red").innerHTML = "<input type='button' style='margin-bottom: 35px;' value='Редактировать Квест-Тур' class='button_action' onclick='red_quest()'> <input style='display:none;' type='text' name='id_quest_value' id='id_quest_value' value=" + data + ">";
        }
    });
}

var int_number = 0;
var task_count_number = $('#task_count_number').val();
if (typeof task_count_number !== 'undefined') {
    int_number=task_count_number;
}

function new_form() {
    int_number++;
    var id_quest_value = $('#id_quest_value').val();//иди квеста
    var id_task = $('.task_real option:selected').attr('alt');//иди задания
    var name_task = $('.task_real option:selected').html();//иди задания
    var teg_task = "";
    if (id_task == '1') {
        teg_task = '<div class="form" style="width: 80%;margin-left: 10%;background-color: #fcf0b3;">'
            + '<div class="hide_form" title="Удалить форму" onclick="delete_form(' + int_number + ')">x</div>'
            + '<form class="task_class">'
            + '<h1 class="number_task">' + int_number + ' Задание </h1><h3>' + name_task + '</h3>'
            + '<input type="button"  onclick="clear_form(' + int_number + ')" value="Очистить форму" class="button_action">'
            + '<textarea class="text_quest" name="text" placeholder="Ключевое задание и описание объекта..." pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$"></textarea>'
            + '<label>Фото пояснение задания</label>'
            + '<input type="file" name="file" class="button_action" placeholder="Фотоответ к заданию">'
            + '<input type="text" name="time" class="text_width" placeholder="Время прохождения в минутах" pattern="[0-9]{1,3}">'
            + '<label>Каждое задание необходимо сохранять отдельно</label>'
            + '<input style="display:none;" type="text" name="id_quest_value" value="' + id_quest_value + '">'
            + '<input style="display:none;" type="text" name="id_task" value="' + id_task + '">'
            + '<input style="display:none;" type="text" value="0" placeholder="Значение для редактирования">'
            + '<input type="button"  onclick="save_task(' + int_number + ');" value="Сохранить задание" class="button_action">';
    } else if (id_task == '2') {
        teg_task = '<div class="form" style="width: 80%;margin-left: 10%;background-color: #e1edeb;">'
            + '<div class="hide_form" title="Удалить форму" onclick="delete_form(' + int_number + ')">x</div>'
            + '<form class="task_class">'
            + '<h1 class="number_task">' + int_number + ' Задание </h1><h3>' + name_task + '</h3>'
            + '<input type="button"  onclick="clear_form(' + int_number + ')" value="Очистить форму" class="button_action">'
            + '<textarea class="text_quest" name="text" placeholder="Ключевое задание и описание объекта..." pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$"></textarea>'
            + '<label>Фото пояснение задания</label>'
            + '<input type="file" name="file" class="button_action" placeholder="Фотоответ к заданию">'
            + '<input type="text" name="hint" placeholder="Подсказка к заданию" pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$">'
            + '<input type="text" name="answer" placeholder="Распознаваемый на фото текст(Ответ)" pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$">'
            + '<input type="text" name="time" class="text_width" placeholder="Время прохождения в минутах" pattern="[0-9]{1,3}">'
            + '<label>Каждое задание необходимо сохранять отдельно</label>'
            + '<input style="display:none;" type="text" name="id_quest_value" value="' + id_quest_value + '">'
            + '<input style="display:none;" type="text" name="id_task" value="' + id_task + '">'
            + '<input style="display:none;" type="text" value="0" placeholder="Значение для редактирования">'
            + '<input type="button"  onclick="save_task(' + int_number + ');" value="Сохранить задание" class="button_action">';

    } else if (id_task == '3') {
        teg_task = '<div class="form" style="width: 80%;margin-left: 10%;background-color: #eff5b8;">'
            + '<div class="hide_form" title="Удалить форму" onclick="delete_form(' + int_number + ')">x</div>'
            + '<form class="task_class">'
            + '<h1 class="number_task">' + int_number + ' Задание </h1><h3>' + name_task + '</h3>'
            + '<input type="button"  onclick="clear_form(' + int_number + ')" value="Очистить форму" class="button_action">'
            + '<textarea class="text_quest" name="text" placeholder="Ключевое задание и описание объекта..." pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$"></textarea>'
            + '<label>Фото пояснение задания</label>'
            + '<input type="file" name="file" class="button_action" placeholder="Фотоответ к заданию">'
            + '<input type="text" name="hint" placeholder="Подсказка к заданию" pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$">'
            + '<input type="text" name="answer" placeholder="Количество распознаваемых лиц" pattern="[0-9]{1,2}">'
            + '<input type="text" name="time" class="text_width" placeholder="Время прохождения в минутах" pattern="[0-9]{1,3}">'
            + '<label>Каждое задание необходимо сохранять отдельно</label>'
            + '<input style="display:none;" type="text" name="id_quest_value" value="' + id_quest_value + '">'
            + '<input style="display:none;" type="text" name="id_task" value="' + id_task + '">'
            + '<input style="display:none;" type="text" value="0" placeholder="Значение для редактирования">'
            + '<input type="button"  onclick="save_task(' + int_number + ');" value="Сохранить задание" class="button_action">';
    } else if (id_task == '4') {
        teg_task = '<div class="form" style="width: 80%;margin-left: 10%;background-color: #badbad;">'
            + '<div class="hide_form" title="Удалить форму" onclick="delete_form(' + int_number + ')">x</div>'
            + '<form class="task_class">'
            + '<h1 class="number_task">' + int_number + ' Задание</h1><h3>' + name_task + '</h3>'
            + '<input type="button"  onclick="clear_form(' + int_number + ')" value="Очистить форму" class="button_action">'
            + '<textarea class="text_quest" name="text" placeholder="Ключевое задание и описание объекта..." pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$"></textarea>'
            + '<label>Фото пояснение задания</label>'
            + '<input type="file" name="file" class="button_action" style="background-color: #89ac76;" placeholder="Фотоответ к заданию">'
            + '<input type="text" name="hint" placeholder="Подсказка к заданию" pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$">'
            + '<input type="text" name="ansver1" class="text_width" placeholder="Координаты широты" pattern="[' + '\\' + 'd]+' + '\\' + '.[' + '\\' + 'd]{4,}">'
            + '<input type="text" name="ansver2" class="text_width" placeholder="Координаты долготы" pattern="[' + '\\' + 'd]+' + '\\' + '.[' + '\\' + 'd]{4,}">'
            + '<input type="button"  onclick="geo_teg(' + int_number + ');" value="Текущие геоданные" class="button_action">'
            + '<input type="text" name="time" class="text_width" placeholder="Время прохождения в минутах" pattern="[0-9]{1,3}">'
            + '<label>Каждое задание необходимо сохранять отдельно</label>'
            + '<input style="display:none;" type="text" name="id_quest_value" value="' + id_quest_value + '">'
            + '<input style="display:none;" type="text" name="id_task" value="' + id_task + '">'
            + '<input style="display:none;" type="text" value="0" placeholder="Значение для редактирования">'
            + '<input type="button"  onclick="save_task(' + int_number + ');" value="Сохранить задание" class="button_action">';
    } else if (id_task == '5') {
        teg_task = '<div class="form" style="width: 80%;margin-left: 10%;background-color: #e3e298;">'
            + '<div class="hide_form" title="Удалить форму" onclick="delete_form(' + int_number + ')">x</div>'
            + '<form class="task_class">'
            + '<h1 class="number_task">' + int_number + ' Задание</h1><h3>' + name_task + '</h3>'
            + '<input type="button"  onclick="clear_form(' + int_number + ')" value="Очистить форму" class="button_action">'
            + '<textarea class="text_quest" name="text" placeholder="Ключевое задание и описание объекта..." pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$"></textarea>'
            + '<input type="text" name="hint" placeholder="Подсказка к заданию" pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$">'
            + '<label>Фото ответ для сравнения</label>'
            + '<input type="file" name="file" class="button_action" placeholder="Фотоответ к заданию">'
            + '<input type="text" name="time" class="text_width" placeholder="Время прохождения в минутах" pattern="[0-9]{1,3}">'
            + '<label>Каждое задание необходимо сохранять отдельно</label>'
            + '<input style="display:none;" type="text" name="id_quest_value" value="' + id_quest_value + '">'
            + '<input style="display:none;" type="text" name="id_task" value="' + id_task + '">'
            + '<input style="display:none;" type="text" value="0" placeholder="Значение для редактирования">'
            + '<input type="button"  onclick="save_task(' + int_number + ');" value="Сохранить задание" class="button_action">';
    } else if (id_task == '6') {
        teg_task = '<div class="form" style="width: 80%;margin-left: 10%;background-color: #e2f7df;">'
            + '<div class="hide_form" title="Удалить форму" onclick="delete_form(' + int_number + ')">x</div>'
            + '<form class="task_class">'
            + '<h1 class="number_task">' + int_number + ' Задание</h1><h3>' + name_task + '</h3>'
            + '<input type="button"  onclick="clear_form(' + int_number + ')" value="Очистить форму" class="button_action">'
            + '<textarea class="text_quest" name="text" placeholder="Ключевое задание и описание объекта..." pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$"></textarea>'
            + '<label>Фото пояснение задания</label>'
            + '<input type="file" name="file" class="button_action" style="background-color: #89ac76;" placeholder="Фотоответ к заданию">'
            + '<input type="text" name="hint" placeholder="Подсказка к заданию" pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$">'
            + '<input type="text" name="answer" class="qr_adress" placeholder="Ответ на задание для qr чтения" pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$">'
            + '<input type="button" onclick="save_qr(' + int_number + ')" value="Сохранить QR код" class="button_action">'
            + '<input type="text" name="time" class="text_width" placeholder="Время прохождения в минутах" pattern="[0-9]{1,3}">'
            + '<label>Каждое задание необходимо сохранять отдельно</label>'
            + '<input style="display:none;" type="text" name="id_quest_value" value="' + id_quest_value + '">'
            + '<input style="display:none;" type="text" name="id_task" value="' + id_task + '">'
            + '<input style="display:none;" type="text" value="0" placeholder="Значение для редактирования">'
            + '<input type="button"  onclick="save_task(' + int_number + ');" value="Сохранить задание" class="button_action">';
    } else if (id_task == '7') {
        teg_task = '<div class="form" style="width: 80%;margin-left: 10%;background-color: #e2f7df;">'
            + '<div class="hide_form" title="Удалить форму" onclick="delete_form(' + int_number + ')">x</div>'
            + '<form class="task_class">'
            + '<h1 class="number_task">' + int_number + ' Задание</h1><h3>' + name_task + '</h3>'
            + '<input type="button"  onclick="clear_form(' + int_number + ')" value="Очистить форму" class="button_action">'
            + '<textarea class="text_quest" name="text" placeholder="Ключевое задание и описание объекта..." pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$"></textarea>'
            + '<label>Фото пояснение задания</label>'
            + '<input type="file" name="file" class="button_action" style="background-color: #89ac76;" placeholder="Фотоответ к заданию">'
            + '<input type="text" name="hint" placeholder="Подсказка к заданию" pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$">'
            + '<input type="text" name="answer" placeholder="Распознаваемая фраза(Ответ)" pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$">'
            + '<input type="text" name="time" class="text_width" placeholder="Время прохождения в минутах" pattern="[0-9]{1,3}">'
            + '<label>Каждое задание необходимо сохранять отдельно</label>'
            + '<input style="display:none;" type="text" name="id_quest_value" value="' + id_quest_value + '">'
            + '<input style="display:none;" type="text" name="id_task" value="' + id_task + '">'
            + '<input style="display:none;" type="text" value="0" placeholder="Значение для редактирования">'
            + '<input type="button"  onclick="save_task(' + int_number + ');" value="Сохранить задание" class="button_action">';
    } else if (id_task == '8') {
        teg_task = '<div class="form" style="width: 80%;margin-left: 10%;background-color: #fff;">'
            + '<div class="hide_form" title="Удалить форму" onclick="delete_form(' + int_number + ')">x</div>'
            + '<form class="task_class" >'
            + '<h1 class="number_task">' + int_number + ' Задание </h1><h3>Проверка текста</h3>'
            + '<input type="button"  onclick="clear_form(' + int_number + ')" value="Очистить форму" class="button_action">'
            + '<textarea class="text_quest" name="text" placeholder="Ключевое задание и описание объекта..." pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$"></textarea>'
            + '<label>Фото пояснение задания</label>'
            + '<input type="file" name="file" class="button_action" style="background-color: #89ac76;" placeholder="Фотоответ к заданию">'
            + '<input type="text" name="hint" placeholder="Подсказка к заданию" pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$">'
            + '<input type="text" name="answer" placeholder="Ответ на задание" pattern="^[?!,-.а-яА-ЯёЁ0-9' + '\\' + 's]+$">'
            + '<input type="text" name="time" class="text_width" placeholder="Время прохождения в минутах" pattern="[0-9]{1,3}">'
            + '<label>Каждое задание необходимо сохранять отдельно</label>'
            + '<input style="display:none;" type="text" name="id_quest_value" value="' + id_quest_value + '">'
            + '<input style="display:none;" type="text" name="id_task" value="8">'
            + '<input style="display:none;" type="text" value="0" placeholder="Значение для редактирования">'
            + '<input type="button"  onclick="save_task(' + int_number + ');" value="Сохранить задание" class="button_action">';

    }
    teg_task += '</form></div>';
    $("#more_task").append(teg_task);
}

$(".task_real").change(function () {

    let text_option = $(this).val();
    $("#text_type").text(text_option);

});

function clear_form(a) {
    a = a - 1;
    $('.task_class')[a].reset();
}

function red_quest() {

    reg_form('form#add_save input[type=text]');
    if (!rglr) return false;
    reg_form('form#add_save textarea');
    if (!rglr) return false;

    var formData = new FormData($('#add_save')[0]);
    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: "php_form/red_quest.php",
        data: formData,
        cache: false,
        success: function (data) {
            alert(data);
        }
    });
}

function save_task(e) {

    reg_form('form.task_class input[type=text]');
    if (!rglr) return false;
    reg_form('form.task_class textarea');
    if (!rglr) return false;

    var length = $('.task_class')[e - 1].length;

    var result = document.forms[e].elements[length - 2].value;
    var save = 'php_form/add_task.php';
    var red = 'php_form/red_task.php';

    if (result == '0') {
        result = save;
    } else {
        result = red;
    }

    var formData = new FormData($('.task_class')[e - 1]);
    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: result,
        data: formData,
        cache: false,
        success: function (data) {
            if (data == 'Отредактировали') {
                alert(data)
            } else {
                document.forms[e].elements[length - 3].value = data;
                document.forms[e].elements[length - 2].value = '1';
                document.forms[e].elements[length - 1].value = 'Редактировать задание';
            }
        }
    });

}


function save_qr(e) {
    reg_form('form.task_class input[type=text]');
    if (!rglr) return false;

    var form = document.forms[e].elements[4].value;
    $("#text_qr").val(form);
    makeCode();

    var svg_data = document.getElementById("qrcode").innerHTML //put id of your svg element here

    var head = '<svg title="graph" version="1.1" xmlns="http://www.w3.org/2000/svg">'
//if you have some additional styling like graph edges put them inside <style> tag

    var style = '<style>circle {cursor: pointer;stroke-width: 1.5px;}text {font: 10px arial;}path {stroke: DimGrey;stroke-width: 1.5px;}</style>'

    var full_svg = head + style + svg_data + "</svg>"
    var blob = new Blob([full_svg], {type: "image/svg+xml"});
    saveAs(blob, "task" + e + ".svg");

}

function geo_teg(e) {
    var length = $('.task_class')[e - 1].length;

    navigator.geolocation.getCurrentPosition(position => {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;

        document.forms[e].elements[length - 8].value = lat;
        document.forms[e].elements[length - 7].value = lng;

    });
}

function delete_form(e) {
    var divsToHide = document.getElementsByClassName("form");
    divsToHide[e].style.visibility = "hidden";
    divsToHide[e].style.display = "none";
}
function delete_task(e){

    var formData = new FormData($('.task_class')[e - 1]);

    var divsToHide = document.getElementsByClassName("form");
    divsToHide[e].style.visibility = "hidden";
    divsToHide[e].style.display = "none";


    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: "php_form/delete_task.php",
        data: formData
    }) .done(function (data) {
            /*alert(data);*/
        }
    );

}

$("#feedback_click").on("click", function () {
    valid_required('form#feedback input:required');
    if (!send) return false;

    reg_form('form#feedback input[type=text]');
    if (!rglr) return false;

    var formData = new FormData($('#feedback')[0]);
    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: "php_form/feedback.php",
        data: formData
    })
        .done(function (data) {
            if (data == "Оставили") {
                location.reload();
            } else {
                //$("#error").html(data);
                alert(data);
            }
        });
});
$(".quest_check").on("click",function(){
    $.post("php_form/quest_check.php",
        {
            id_quest:$(this).attr("id_quest")
        },
        function(data) {
            alert(data);
        });
});
$(".quest_fail").on("click",function(){
    $.post("php_form/quest_fail.php",
        {
            id_quest:$(this).attr("id_quest")
        },
        function(data) {
            alert(data);
        });
});
$(".quest_del_deferred").on("click", function () {
    $.post("php_form/quest_del_deferred.php",
        {
            id_quest: $(this).attr("id_quest")
        },
        function (data) {
            alert(data);
            window.location.reload();
        });
});
$(".passing_type").on("click", function () {
    $.post("php_form/passing.php",
        {
            id_quest: $(this).attr("id_quest")
        },
        function (data) {
            window.location.reload();
        });
});