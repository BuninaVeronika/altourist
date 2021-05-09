$().ready(function () {

    $('#area u').click(function () {
        $('input[name=photo]').trigger('click');
    });

    $('input[name=photo]').change(function (e) {
        var file = e.target.files[0];

        // RESET
        $('#area p span').css('width', 0 + "%").html('');
        $('#area img, #area canvas').remove();
        $('#area i').html(JSON.stringify(e.target.files[0]).replace(/,/g, ", <br/>"));

        // CANVAS RESIZING
        canvasResize(file, {
            width: 400,
            height: 400,
            crop: false,
            quality: 80,
            rotate: 0,
            callback: function (data, width, height) {

                var img = new Image();
                img.onload = function () {

                    $(this).css({
                        'margin': '10px auto',
                        'width': width,
                        'height': height
                    }).appendTo('#area div');

                };
                //$(img).attr('src', data);
                document.getElementById("preview").src = data;

                // Create a new formdata
                var fd = new FormData();
                // Add file data
                var f = canvasResize('dataURLtoBlob', data);
                f.name = file.name;
                fd.append($('#area input').attr('name'), f);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'uploader.php', true);
                xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                xhr.setRequestHeader("pragma", "no-cache");
                //Upload progress
                xhr.upload.addEventListener("progress", function (e) {
                    if (e.lengthComputable) {
                        var loaded = Math.ceil((e.loaded / e.total) * 100);
                        $('#area p span').css({
                            'width': loaded + "%"
                        }).html(loaded + "%");
                    }
                }, false);
                // File uploaded
                xhr.addEventListener("load", function (e) {
                    var response = JSON.parse(e.target.responseText);
                    if (response.filename) {
                        // Complete
                        $('#area p span').html('done');
                        $('#area b').html(response.filename);
                        $('<img>').attr({
                            'src': response.filename
                        }).appendTo($('#area div'));
                    }
                }, false);
                // Send data
                xhr.send(fd);

            }
        });

    });
});