<script>
    $( "#select-category" ).change(function(e) {
        e.preventDefault();
        var category_val =  $( "#select-category option:selected" ).val();

        var selected_filters = $(this).find(':selected').data('content');
        var filters = Object.entries(selected_filters);

        $(".dynamic-content").remove();
        $(".actions").remove();
        var wrapper_form = $("#new_form");

        for (const filter of filters) {
            var input_name = Object.values(filter)[0];
            var input_label = Object.values(filter)[1]['key'];
            var input_values = Object.values(filter)[1]['values'];
            var input_type = Object.values(filter)[1]['type'];

            wrapper_form.append('<label class="dynamic-content" id="label_tag_'+ input_name +'">' +
                    '<span style="margin: 0;">'+ input_label +':</span></label>');

            for (const value of input_values) {
                var input_tag =' <input type="'+ input_type +
                        '" name="'+ input_name +' " ' +
                        'value="description['+ Object.keys(value)[0] +']"> '+Object.values(value)[0];

                var lable_tag = '#label_tag_' + input_name
                $(lable_tag).append(input_tag);
            }
        }
        wrapper_form.append('<div class="actions"> ' +
                '<input type="submit" name="commit" value="Създай" class="btn btn-success"> ' +
                '</div>')
    });

    $("#base-templates-box").on('change', '#select-print-templates', function(e) {
        e.preventDefault();
        var print_template_val =  $( "#select-print-templates option:selected" ).val();
        $("#print-template-box").children().remove();

        console.log(print_template_val);
        $.ajax({
            method: "GET",
            url: "/admin/products/get_print_templates/" + print_template_val,
            data: { "_token": "{{ csrf_token() }}" },
            success: function(print_templates) {
                $("#print-template-box").append(print_templates);
            }
        });
    });

    $("#select-category").change(function() {
        var category_val =  $( "#select-category option:selected" ).val();
        $("#base-templates-box").children().remove();
        $("#print-template-box").children().remove();
        $.ajax({
            method: "GET",
            url: "/admin/products/get_base_product_templates/" + category_val,
            data: { "_token": "{{ csrf_token() }}" },
            success: function(base_product_templates) {
                $("#base-templates-box").append(base_product_templates);
            }
        });
    });

    // gallery images
    $(document).ready(function() {
        var max_fields = 6;
        var wrapper    = $(".input_fields_wrap");
        var upload_img_gallery_button = $(".upload-img-gallery-button");
        var field_img_gallery_button  = $(".field-img-gallery-button");
        var x = 1;


        $(field_img_gallery_button).click(function(e){
            e.preventDefault();
            if(x < max_fields){
                x++;
                $(wrapper).append(
                        '<div class="fields" ><label><span>Снимка от линк:</span>' +
                        '<input type="text" name="description[gallery][][picture_url]"/>' +
                        '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                        '</label></div>');
            }
        });
        $(wrapper).on("click",".remove_field", function(e){
            e.preventDefault(); $(this).parent('div.fields label').remove(); x--;
        });



        $(upload_img_gallery_button).click(function(e){
            e.preventDefault();
            if(x < max_fields){
                x++;
                $(wrapper).append('<div class="upload-img-gallery-button">' +
                        '<input type="file" name="upload_gallery_pictures[]" class="label-values" />' +
                        '<a href="#" class="remove-img-gallery-button">' +
                        '<i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                        '</div>');
            }
        });

        $(wrapper).on("click",".remove-img-gallery-button", function(e){
            e.preventDefault(); $(this).parent('div.upload-img-gallery-button').remove(); x--;
        });
    });


    // specification
    $(document).ready(function() {
        var max_fields      = 20; //maximum input boxes allowed
        var wrapper         = $(".specification_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_spec_field_button"); //Add button ID
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                        '<div class="fields" ><label>' +
                        '<input style="width: 200px" type="text" name="description[properties][][name]" id="admin_product_description" class="label-names">' +
                        '                     <input type="text" name="description[properties][][text]" id="admin_product_description" class="label-values">' +
                        '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                        '</label></div>'); //add input box
            }
        });
        $(wrapper).on("click", ".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div.fields label').remove(); x--;
        });
    });

    $('[id^="btnO"]').click(function() {
        var notchecked = $('input[type="radio"][name="menucolor"]').not(':checked');
        $('.navbar.'+notchecked.val()).toggleClass('navbar-default navbar-inverse');
        notchecked.prop("checked", true);
        $(this).parent().find('a').each(function() {
            if($(this).attr('id') == 'btnOn'){
                $(this).toggleClass('active btn-success btn-default');
            } else {
                $(this).toggleClass('active btn-danger btn-default');
            }

        });
        doChange(notchecked);
    });

    $('input[type="radio"][name="menucolor"]').change(function() {
        doChange(this);
    });

    function doChange(object){
        if($(object).val() == "navbar-default"){
            $('#btnOn').removeClass('active');
            $('#btnOn .glyphicon-ok').css('opacity','0');
            $('#btnOff .glyphicon-remove').css('opacity','1');
            $('#btnOff').focus();
        }
        if($(object).val() == "navbar-inverse"){
            $('#btnOff').removeClass('active');
            $('#btnOff .glyphicon-remove').css('opacity','0');
            $('#btnOn .glyphicon-ok').css('opacity','1');
            $('#btnOn').focus();
        }
    }
</script>\

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

<script src="{{ URL::to('/') }}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

<script>
    CKEDITOR.replace('editor-create');
</script>
