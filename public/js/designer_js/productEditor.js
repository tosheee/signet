/**
 * Created by toshe on 07/06/22.
 */
// Add image from local

var canvas;


$(document).ready(function() {
    //setup front side canvas
    canvas = new fabric.Canvas('canvas', {
        width:550,
        height: 600,
        hoverCursor: 'pointer',
        selection: true,
        selectionBorderColor: 'blue',
        backgroundColor: 'white'
    });

    document.getElementById('add-base-img').addEventListener("change", function (e) {

        var file = e.target.files[0];
        var reader = new FileReader();

        reader.onload = function (f) {
            // var image = new Image();

            // image.onload=function(){
                //console.log(image);
            //}

            // data = f.target.result;
            // var url = image.src;

            // fabric.Image.fromURL(data, function (img) {
            var url = 'http://localhost:8000/img/t-shirts/' + file.name
            fabric.Image.fromURL(url, function (img) {
                // add background image
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                    //scaleX: canvas.width,
                    //scaleY: canvas.height
                });
            });
        };

        reader.readAsDataURL(file);
    });

    //$(".img-polaroid").on('click',function(e){
    $('body').on('click', '.img-polaroid', function (e){
        //alert("OK");
        var el = e.target;
        /*temp code*/
        var offset = 50;
        var left = fabric.util.getRandomInt(0 + offset, 200 - offset);
        var top = fabric.util.getRandomInt(0 + offset, 400 - offset);
        var angle = fabric.util.getRandomInt(-20, 40);
        var width = fabric.util.getRandomInt(30, 50);
        var opacity = (function(min, max){ return Math.random() * (max - min) + min; })(0.5, 1);

        fabric.Image.fromURL(el.src, function(image) {
            image.set({
                left: left,
                top: top,
                angle: 0,
                padding: 10,
                cornersize: 10,
                hasRotatingPoint:true
            });
            //image.scale(getRandomNum(0.1, 0.25)).setCoords();
            canvas.add(image);
        });
    });




});//doc ready
