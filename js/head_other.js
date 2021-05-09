if ( $.cookie('cookies') == null ) {
  $('#cookies_class').show();
}
else{
	$('#cookies_class').hide();
}

$('#cookies_ok').on('click', function() {
  $.cookie('cookies', 'true', { expires: 365, path: '/' });
  $('#cookies_class').hide();
});

function getCookie(name) {
   var value = "; " + document.cookie;
   var parts = value.split("; " + name + "=");
   if (parts.length == 2) return parts.pop().split(";").shift();
}
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

$('.input_search').hide();
$('#search_button').click(function(){

    $('.input_search').show(300)
    if ($('.input_search').val() != ""){
        reg_form('.input_search input[type=text]');
        if (!rglr) return false;

        document.location.href = "../section_quest.php?search=" + $('.input_search').val();
    }
});
$(".input_search").keydown(function(e){
    if(e.keyCode === 13) {
        reg_form('.input_search input[type=text]');
        if (!rglr) return false;

        if ($('.input_search').val() != "") {
            document.location.href = "../section_quest.php?search=" + $('.input_search').val();
        }
    }
});
$('#reg_button').on('click', function() {
  //проверить куки и сессии, если есть отправить в профиль, если нет отправить на авторизацию, а на авторизации проверить на соотвествие
	var a = getCookie('cooki_hash');
	if(typeof a !== "undefined") {
        window.location.href = "../personal_account.php";
    }
	else{
	 $.ajax({
        url: "php_form/session.php",
        cache: false,
        success: function(html){
            if (html=='Сессия') {
                window.location.href = "../personal_account.php";
            }
            	else {
                window.location.href = "../registration.php";
            }
    }
    });
  	}
});

$(".put_aside").on("click",function(){

    $.post("../php_form/put_aside.php",
        {
            id_quest: $(this).attr("id_quest")
        },
        function (data) {
            alert(data);
        });
});

$(".purchase").on("click",function(){
  var yes = confirm('Вы действительно хотите купить этот квест-тур?');
    if (yes == true) {
        $.post("../php_form/purchase.php",
            {
                id_quest: $(this).attr("id_quest")
            },
            function (data) {
                alert(data);
            });
    }
});

$(".passing_quest_tour").on("click", function () {

    $.post("../php_form/passing_quest_tour.php",
        {
            id_quest: $(this).attr("id_quest")
        },
        function (data) {
            window.location.replace(data);
        });
});

$(".hint").on("click", function () {
    $('#hint').css('display', 'block');
    $('.answer').css('display', 'block');
});
$(".answer").on("click", function () {
    $('#answer').css('display', 'block');

});