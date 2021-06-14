var findMeButton = $('.find-me');
// Check if the browser has support for the Geolocation API
if (!navigator.geolocation) {
    findMeButton.addClass("disabled");
    $('.no-browser-support').addClass("visible");

} else {
    findMeButton.on('click', function (e) {
        e.preventDefault();
        navigator.geolocation.getCurrentPosition(function (position) {

            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            $('.latitude').val(lat.toFixed(15));
            $('.longitude').val(lng.toFixed(9));

        });
    });
}

function GeoTime() {
    navigator.geolocation.watchPosition(function (position) {

        // Get the coordinates of the current possition.
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;

        $('.latitude').val(lat.toFixed(6));
        $('.longitude').val(lng.toFixed(6));
    });
}

setInterval(GeoTime, 1000);
