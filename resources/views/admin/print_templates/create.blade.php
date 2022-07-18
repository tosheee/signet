@extends('layouts.app_admin')


<style>
    .file-upload {
        background-color: #ffffff;
        width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .file-upload-btn {
        width: 100%;
        margin: 0;
        color: #fff;
        background: rgba(172, 178, 177, 0.59);
        border: none;
        padding: 10px;
        border-radius: 1px;
        border-bottom: 1px solid #bdd5dc;
        transition: all .2s ease;
        outline: none;
        text-transform: uppercase;
        font-weight: 700;
    }

    .file-upload-btn:hover {
        background: #acb2b1;
        color: #ffffff;
        transition: all .2s ease;
        cursor: pointer;
    }

    .file-upload-btn:active {
        border: 0;
        transition: all .2s ease;
    }

    .file-upload-content {
        display: none;
        text-align: center;
    }

    .file-upload-input {
        position: absolute;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        outline: none;
        opacity: 0;
        cursor: pointer;
    }

    .image-upload-wrap {
        margin-top: 20px;
        border: 1px dashed #bdd5dc;
        position: relative;
    }

    .image-dropping,
    .image-upload-wrap:hover {
        background-color: #acb2b1;
        border: 1px dashed #ffffff;
    }

    .image-title-wrap {
        padding: 0 15px 15px 15px;
        color: #222;
    }

    .drag-text {
        text-align: center;
    }

    .drag-text h3 {
        font-weight: 100;
        text-transform: uppercase;
        color: #bdd5dc;
        padding: 60px 0;
    }

    .file-upload-image {
        max-height: 200px;
        max-width: 200px;
        margin: auto;
        padding: 20px;
    }

    .remove-image {

        margin: 0;
        color: #fff;
        background: #cd4535;
        border: none;
        padding: 10px;
        border-radius: 1px;
        border-bottom: 1px solid #b02818;
        transition: all .2s ease;
        outline: none;
        text-transform: uppercase;
    }

    .remove-image:hover {
        background: #c13b2a;
        color: #ffffff;
        transition: all .2s ease;
        cursor: pointer;
    }

    .remove-image:active {
        border: 0;
        transition: all .2s ease;
    }
</style>

@section('content')
    @include('admin.admin_partials.admin_menu')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Създаване на нов щампа</div>
                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="{{ route('print_templates.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if(isset($categories))
                                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    <label>
                                        <span>Категории:<sup style="color: red;">*</sup></span>
                                        <select class="form-control" name="category_id" id="select-category" required="required"  oninvalid="this.setCustomValidity('Моля, въведете категория!')" oninput="setCustomValidity('')">
                                            <option value="">Избери категория</option>

                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach

                                        </select>
                                    </label>
                                </div>
                            @endif

                            @if(isset($subCategories))
                                <div class="form-group{{ $errors->has('sub_category_id') ? ' has-error' : '' }}">
                                    <label>
                                        <span>Подкатегория:<sup style="color: red;">*</sup></span>
                                        <select class="form-control" name="sub_category_id" id="select-sub-category" required="required"  oninvalid="this.setCustomValidity('Моля, въведете подкатегория!')" oninput="setCustomValidity('')">
                                            <option value="">Избери подкатегория</option>
                                                @foreach($subCategories as $sub_category)
                                                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                                @endforeach
                                        </select>
                                    </label>
                                </div>
                            @endif

                            @if(isset($typePrintTemplates))
                                <div class="form-group{{ $errors->has('sub_category_id') ? ' has-error' : '' }}">
                                    <label>
                                        <span>Theme:<sup style="color: red;">*</sup></span>
                                        <select class="form-control" name="type_print_template_id" id="type_print_template" required="required"  oninvalid="this.setCustomValidity('Please enter type!')" oninput="setCustomValidity('')">
                                            <option value="">Chose Type Print Template</option>
                                                @foreach($typePrintTemplates as $typePrintTemplate)
                                                    <option value="{{ $typePrintTemplate->id }}">{{ $typePrintTemplate->name }}</option>
                                                @endforeach
                                        </select>
                                    </label>
                                </div>
                            @endif


                            <label>
                                <span style="margin: 0;">Activ stamps: </span>
                                <input type="radio" name="active" value="1" checked> ДА
                                <input type="radio" name="active" value="0"> НЕ
                            </label>
                            <br>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Име</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="gallery-wrapper">
                                <button class="upload-img-butt btn btn-info btn-xs">Add picture</button>
                                <br>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    var wrapper = $(".gallery-wrapper");
                                    var button_upload_img = $(".upload-img-butt");
                                    var button_url_img    = $(".field-img-butt");
                                    var max_fields = 5;
                                    var x = $('.gallery-image-wrapper').length;

                                    $(button_upload_img).click(function(e){
                                        e.preventDefault();
                                        if(x < max_fields) {
                                            x++;
                                            wrapper.append('' +
                                                    '<div class="gallery-image-wrapper" id="g_wrapper' + x +'"'+'>' +
                                                    '<a class="remove-image-button">' +
                                                    '<i style="color: red;" aria-hidden="true" class="fa fa-times"></i></a>' +
                                                    '<div class="file-upload">' +
                                                    '<div class="image-upload-wrap">' +
                                                    '<input class="file-upload-input" name="images[]" type="file" onchange="readURL(this);" accept="image/*" />' +
                                                    '<div class="drag-text">' +
                                                    '<h3>Drag and drop a file or select add Image</h3></div></div>' +
                                                    '<div class="file-upload-content">' +
                                                    '<img class="file-upload-image" src="#" alt="your image" />' +
                                                    '<div class="image-title-wrap">' +
                                                    '<button type="button" onclick="removeUpload()" class="remove-image">' +
                                                    'Remove <span class="image-title">Uploaded Image</span>' +
                                                    '</button></div><div class="range-content"></div></div></div><br></div>' +
                                                    '');
                                        }
                                    });

                                    $('.gallery-wrapper').on("click", ".remove-image-button", function(e){
                                        e.preventDefault();
                                        $(this).parent('div.gallery-image-wrapper').remove();
                                        x--;
                                    });
                                });
                            </script>

                            <br>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Запис
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {


                var input_tag = $(input);
                var img_upload_wrap = input_tag.parent();
                var file_upload = img_upload_wrap.parent();


                var reader = new FileReader();

                reader.onload = function(e) {

                    var image = new Image();
                    image.src = event.target.result;
                    img_upload_wrap.hide();

                    file_upload.find('.file-upload-image').attr('src', e.target.result);
                    var file_upload_content = file_upload.find('.file-upload-content');

                    file_upload_content.show();
                    file_upload_content.find('.image-title').html(input.files[0].name);



                    var range_tag = '<input type="range" data-width="" data-height=""  name="weight" id="range_weight" value="100" min="1" max="100" oninput="range_weight_disp.value = range_weight.value">' +
                            '<output  id="range_weight_disp"></output>' +
                            ''+
                            '<p>Original dimensions: <span class="dimensions"></span>' +
                            '<p>New dimensions: <span class="new-dimensions"></span></p>' +
                            '<p>Recommended around: <span> 150 x 176 </span></p>';
                    var range_content = file_upload_content.find('.range-content');
                    range_content.append(range_tag);

                    image.onload = function() {
                        range_content.find('.dimensions').html(image.width+' x '+image.height);
                        range_content.find('input').attr("data-width", image.width);
                        range_content.find('input').attr('data-height', image.height)
                    };
                };

                reader.readAsDataURL(input.files[0]);

            }
            else
            {
                removeUpload();
            }


        }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }


        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function () {
            $('.image-upload-wrap').removeClass('image-dropping');
        });

        $(document).on('input', '#range_weight', function() {
            var img_width = $(this).attr('data-width');
            var img_height = $(this).attr('data-height');

            var new_img_width = ($(this).val() / 100) * img_width;
            var new_img_height = ($(this).val() / 100) * img_height;

            var add_to_html = Math.ceil(new_img_width) +  ' x '+ Math.ceil(new_img_height)
            $(this).parent().find('.new-dimensions').html(add_to_html);
        });

    </script>





    <script>

        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;
                    var catImageWidth = 0;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var image = new Image();
                            image.src = event.target.result;

                            var img = $($.parseHTML('<img>'));
                            img.attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                            img.attr('wight', '200');
                            img.attr('height', '200');
                            img.attr('class', 'img-base-templates');

                            image.onload = function() {
                                img.parent().append(image.width+' x '+image.height);
                            };
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };

            $('#chooseImage').on('change', function() {
                imagesPreview(this, 'div.gallery');
            });
        });
    </script>

    @include('admin.admin_partials.admin_menu_bottom')
@endsection
