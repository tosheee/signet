/**
 * Created by toshe on 07/06/22.
 */
// Add image from local

var canvas;


$(document).ready(function() {
    // setup front side canvas
    canvas = new fabric.Canvas('canvas', {
        width:420,
        height: 420,
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

    $('body').on('click', '.img-base-polaroid', function (e){

        console.log('alabala')

        var el = e.target;
            fabric.Image.fromURL(el.src, function (img) {
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                    scaleX: canvas.width / img.width,
                    scaleY: canvas.height / img.height
                });
            });
    });


    document.getElementById('add-text').onclick = function() {
        var text = $("#text-string").val();
        var textSample = new fabric.Text(text, {
            left: fabric.util.getRandomInt(0, 200),
            top: fabric.util.getRandomInt(0, 400),
            fontFamily: 'helvetica',
            angle: 0,
            fill: '#000000',
            scaleX: 0.5,
            scaleY: 0.5,
            fontWeight: '',
            hasRotatingPoint:true
        });
        canvas.add(textSample);
        canvas.item(canvas.item.length-1).hasRotatingPoint = true;
        $("#texteditor").css('display', 'block');
        $("#imageeditor").css('display', 'block');
    };

    $("#text-string").keyup(function(){
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.text = this.value;
            canvas.renderAll();
        }
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


    document.getElementById('remove-selected').onclick = function() {

        //console.log('alabala')
        var activeObject = canvas.getActiveObject();//, activeGroup = canvas.getActiveGroup();

        if (activeObject) {
            canvas.remove(activeObject);
            $("#text-string").val("");
        }
        /*
        else if (activeGroup) {
            var objectsInGroup = activeGroup.getObjects();
            canvas.discardActiveGroup();
            objectsInGroup.forEach(function(object) {
                canvas.remove(object);
            });
        }*/
    };
/*
    document.getElementById('bring-to-front').onclick = function() {
        var activeObject = canvas.getActiveObject(),
            activeGroup = canvas.getActiveGroup();
        if (activeObject) {
            activeObject.bringToFront();
        }
        else if (activeGroup) {
            var objectsInGroup = activeGroup.getObjects();
            canvas.discardActiveGroup();
            objectsInGroup.forEach(function(object) {
                object.bringToFront();
            });
        }
    };

    document.getElementById('send-to-back').onclick = function() {
        var activeObject = canvas.getActiveObject(),
            activeGroup = canvas.getActiveGroup();
        if (activeObject) {
            activeObject.sendToBack();
        }
        else if (activeGroup) {
            var objectsInGroup = activeGroup.getObjects();
            canvas.discardActiveGroup();
            objectsInGroup.forEach(function(object) {
                object.sendToBack();
            });
        }
    };

*/



    $("#text-bold").click(function() {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontWeight = (activeObject.fontWeight == 'bold' ? '' : 'bold');
            canvas.renderAll();
        }
    });

    $("#text-italic").click(function() {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            console.log('alabala')
            activeObject.fontStyle = (activeObject.fontStyle == 'italic' ? '' : 'italic');
            canvas.renderAll();
        }
    });

    $("#text-strike").click(function() {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textDecoration = (activeObject.textDecoration == 'line-through' ? '' : 'line-through');
            canvas.renderAll();
        }
    });

    $("#text-underline").click(function() {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textDecoration = (activeObject.textDecoration == 'underline' ? '' : 'underline');
            canvas.renderAll();
        }
    });

    $("#text-left").click(function() {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'left';
            canvas.renderAll();
        }
    });

    $("#text-center").click(function() {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'center';
            canvas.renderAll();
        }
    });

    $("#text-right").click(function() {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'right';
            canvas.renderAll();
        }
    });

    $("#font-family").change(function() {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontFamily = this.value;
            canvas.renderAll();
        }
    });




});//doc ready
