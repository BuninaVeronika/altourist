function push_passing() {
    $.post("jobphp/add_passing.php",
        {
            id_quests: $("#id_quests").prop("value"),
            time: $("#time").prop("value"),
            id_task_passing: $("#passing").prop("value"),
        },
        function (data) {
            window.location.replace(data);
        });
}

$(".photo_add").on("input", function () {
    push_passing();
});
$(".get_result_text").on("click", function () {
    if ($("#check").prop("value") === 1) {
        push_passing();
    } else {
        $.post("jobphp/text_recognition.php",
            {
                passing: $("#passing").prop("value"),
                answer_result: $("#answer_result").prop("value"),
            },
            function (data) {
                if (data == "true") {
                    $("#answer_result").val("1");
                } else {
                    alert(/*"Ответ неправильный, попробуйте снова."+*/data);
                }
            });
    }
});
