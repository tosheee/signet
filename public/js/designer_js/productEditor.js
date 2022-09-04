/**
 * Created by toshe on 07/06/22.
 */
// Add image from local

var canvas;


$(document).ready(function() {
    // setup front side canvas
    canvas = new fabric.Canvas('canvas', {
        width:320,
        height: 320,
        hoverCursor: 'pointer',
        selection: true,
        selectionBorderColor: 'blue',
        backgroundColor: 'white'
    });

    var add_base_img = document.getElementById('add-base-img');

    if (add_base_img){
        document.getElementById('add-base-img').addEventListener("change", function (e) {

        var file = e.target.files[0];
        var reader = new FileReader();

        reader.onload = function (f) {
            //var url = 'http://localhost:8000/img/t-shirts/' + file.name;
            var url = 'http://localhost:8000/img/img_templates/base_product_templates/' + file.name;

            fabric.Image.fromURL(url, function (img) {
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                    scaleX: canvas.width / img.width,
                    scaleY: canvas.height / img.height
                });
            });
        };

        reader.readAsDataURL(file);
    });

    }

    $('body').on('click', '.add-base-img', function (e){

        var el = e.target;
            fabric.Image.fromURL(el.src, function (img) {
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                    scaleX: canvas.width / img.width,
                    scaleY: canvas.height / img.height
                });
            });



    });
    $('body').on('click', '.img-polaroid', function (e){
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
