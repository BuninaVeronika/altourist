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

    $.post("jobphp/text_recognition.php",
        {
            passing: $("#passing").prop("value"),
            answer_result: $("#answer_result").prop("value"),
        },
        function (data) {
            if (data == "true") {
                push_passing();
            } else {
                alert(data);
            }
        });
});
$(".get_result_face").on("click", function () {

    $.post("jobphp/face_recognition.php",
        {
            passing: $("#passing").prop("value"),
            answer_result: $("#answer_result").prop("value"),
        },
        function (data) {
            if (data == "true") {
                push_passing();
            } else {
                alert(data);
            }
        });
});
$(".get_result_geo").on("click", function () {

    $.post("jobphp/geodata.php",
        {
            passing: $("#passing").prop("value"),
            answer_result1: $("#ansver1").prop("value"),
            answer_result2: $("#ansver2").prop("value"),
        },
        function (data) {
            if (data == "true") {
                push_passing();
            } else {
                alert(data);
            }
        });
});

