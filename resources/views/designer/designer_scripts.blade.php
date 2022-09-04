

<!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<![endif]-->
<![endif]-->
<!--[if IE]>
<script type="text/javascript" src="{{ asset('js/designer_js/excanvas.js')}}"></script><![endif]-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script scr="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.11/fabric.js"></script>
<script type="text/javascript" src="{{ asset('js/designer_js/fabric.min.js')}}"></script>
<!--<script type="text/javascript" src="{{ asset('js/designer_js/tshirtEditor.js')}}"></script>-->
<script type="text/javascript" src="{{ asset('js/designer_js/productEditor.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/designer_js/jquery.miniColors.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/designer_js/html5.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/designer_js/loading.js')}}"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/eligrey/FileSaver.js/5733e40e5af936eb3f48554cf6a8a7075d71d18a/FileSaver.js"></script>



<script>

    $('#new_form').submit(function() {
        var input_canvas_content_json = document.getElementById('id-canvas-content-json');
        input_canvas_content_json.value = JSON.stringify(canvas.toDatalessJSON());

        var input_canvas_content_svg = document.getElementById('id-canvas-content-svg');
        console.log(canvas.toSVG());
        input_canvas_content_svg.value = JSON.stringify(canvas.toSVG());
    })
</script>
