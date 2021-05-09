/*
			download the face-detection cascade
		*/
var widthwindow = $(window).width();  // Ширина браузера
var heightwindow = $(window).height();
var facefinder_classify_region = function (r, c, s, pixels, ldim) {
    return -1.0;
};
var cascadeurl = 'https://raw.githubusercontent.com/nenadmarkus/pico/c2e81f9d23cc11d1a612fd21e4f9de0921a5d0d9/rnt/cascades/facefinder';
fetch(cascadeurl).then(function (response) {
    response.arrayBuffer().then(function (buffer) {
        var bytes = new Int8Array(buffer);
        facefinder_classify_region = pico.unpack_cascade(bytes);
        console.log('* cascade loaded');
    })
})
/*
    prepare the image and canvas context
*/

var ctx = document.getElementById('canvas').getContext('2d');
var img = document.getElementById('image');

img.onload = () => ctx.drawImage(img, 0, 0, 500, 350);

/*
    a function to transform an RGBA image to grayscale
*/
function rgba_to_grayscale(rgba, nrows, ncols) {
    var gray = new Uint8Array(nrows * ncols);
    for (var r = 0; r < nrows; ++r)
        for (var c = 0; c < ncols; ++c)
            // gray = 0.2*red + 0.7*green + 0.1*blue
            gray[r * ncols + c] = (2 * rgba[r * 4 * ncols + 4 * c + 0] + 7 * rgba[r * 4 * ncols + 4 * c + 1] + 1 * rgba[r * 4 * ncols + 4 * c + 2]) / 10;
    return gray;
}

/*
    this function is called each time you press the button to detect the faces
*/
function button_callback() {
    // re-draw the image to clear previous results and get its RGBA pixel data

    ctx.drawImage(img, 0, 0, 500, 350);
    var rgba = ctx.getImageData(0, 0, widthwindow, heightwindow).data;
    // prepare input to `run_cascade`
    image = {
        "pixels": rgba_to_grayscale(rgba, heightwindow, widthwindow),
        "nrows": heightwindow,
        "ncols": widthwindow,
        "ldim": widthwindow
    }
    params = {
        "shiftfactor": 0.1, // move the detection window by 10% of its size
        "minsize": 20,      // minimum size of a face (not suitable for real-time detection, set it to 100 in that case)
        "maxsize": 1000,    // maximum size of a face
        "scalefactor": 1.1  // for multiscale processing: resize the detection window by 10% when moving to the higher scale
    }
    // run the cascade over the image
    // dets is an array that contains (r, c, s, q) quadruplets
    // (representing row, column, scale and detection score)
    dets = pico.run_cascade(image, facefinder_classify_region, params);
    // cluster the obtained detections
    dets = pico.cluster_detections(dets, 0.2); // set IoU threshold to 0.2

    var number_face = 0;
    // draw results
    qthresh = 5.0 // this constant is empirical: other cascades might require a different one
    for (i = 0; i < dets.length; ++i)
        // check the detection score
        // if it's above the threshold, draw it
        if (dets[i][3] > qthresh) {
            ctx.beginPath();
            ctx.arc(dets[i][1], dets[i][0], dets[i][2] / 2, 0, 2 * Math.PI, false);
            ctx.lineWidth = 3;
            ctx.strokeStyle = 'white';
            ctx.stroke();
            number_face++;
        }
    $('#answer_result').val(number_face);
}