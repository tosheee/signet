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

        <a href="/admin/base_product_template" class="btn btn-default">Обратно</a>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New base product template</div>
                    <div class="panel-body">

                        <form class="form-horizontal" id="form-with-images" method="POST" action="{{ route('base_product_template.store') }}/{{ $baseProductTemplate->id }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if(isset($adminCategories))
                                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    <label>
                                        <span>Категории:</span>
                                        <select class="form-control" name="category_id" id="select-category">
                                            <option value="">Избери категория</option>
                                            @foreach($categories as $category)
                                                @if ($baseProductTemplate->category_id == $category->id )
                                                    <option selected="selected" value="{{ $category->id }}">{{ isset($category->name) ?  $category->name : '' }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ isset($category->name) ?  $category->name : ''  }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            @endif

                            <?php $content = json_decode($baseProductTemplate->content, true); ?>


                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Име</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$content['name']}}"required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <label>
                                <span style="margin: 0;">Активен продукт в магазина: </span>
                                <input type="radio" name="active" value="1" checked> ДА
                                <input type="radio" name="active" value="0"> НЕ
                            </label>
                            <br>

                            <div class="gallery-wrapper">
                                <button type="button" id="upload-img" class="upload-img-butt btn btn-info btn-xs" style="visibility: hidden;">Add picture</button>
                                <br>

                                @foreach($content['images'] as $i => $image)

                                    <div class="gallery-image-wrapper" id="g_wrapper{{$i}}">
                                        <a class="remove-image-button"><i style="color: red;" aria-hidden="true" class="fa fa-times"></i></a>
                                        <div class="file-upload">
                                            <div class="image-upload-wrap" style="display: none;">
                                                <input class="file-upload-input" name="images[]" type="file" onchange="readURL(this);" accept="image/*">
                                                <input class="old-file-upload-input" name="old_images[]" type="hidden"  value="{{$image}}">

                                                <div class="drag-text">
                                                    <h3>Drag and drop a file or select add Image</h3>
                                                </div>
                                            </div>

                                            <div class="file-upload-content" style="display: block;">
                                                <img class="file-upload-image" src="/storage/images/base_templates/{{$record_id}}/{{$image}}">

                                                <div class="image-title-wrap">
                                                    <button type="button" onclick="removeUpload(this)" class="remove-image">
                                                        Remove: <span class="image-title">{{$image}}</span>
                                                    </button>
                                                </div>

                                                <div class="range-content">
                                                    <input type="range" data-width="530" data-height="630" name="resize_percent" id="range_weight" value="100" min="1" max="100" oninput="range_weight_disp.value = range_weight.value">
                                                    <output id="range_weight_disp"></output>

                                                    <p>Original dimensions: <span class="dimensions"></span></p>
                                                    <p>New dimensions: <span class="new-dimensions"></span></p>
                                                    <p>Recommended around: <span> 530 x 630 </span></p>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                    </div>

                                @endforeach

                            </div>
                            <input type="hidden" id="all-percent-images" name="percent_images">
                            <br>
                            <div class="actions">
                                <input name="_method" type="hidden" value="PUT">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            if ($('div.gallery-image-wrapper').length == 0)
            {
                $('#upload-img').css('visibility', 'visible');
            }
            else
            {
                $('#upload-img').css('visibility', 'hidden');
            }

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
                            '<img class="file-upload-image" src="" alt="your image" />' +
                            '<div class="image-title-wrap">' +
                            '<button type="button" onclick="removeUpload(this)" class="remove-image">' +
                            'Remove <span class="image-title">Uploaded Image</span>' +
                            '</button></div><div class="range-content"></div></div></div><br></div>' +
                            '');
                }
            });

            $('.gallery-wrapper').on("click", ".remove-image-button", function(e){
                e.preventDefault();
                $('div.gallery-image-wrapper').remove();
                $('#upload-img').css('visibility', 'visible');
                x--;
            });

        });


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
                    file_upload.find('.range-content').children().remove();

                    var range_tag = '' +
                            '<input type="range" data-width="" data-height=""  name="resize_percent" ' +
                            'class="resize_percent" id="range_weight" value="100" min="1" max="100" ' +
                            'oninput="range_weight_disp.value = range_weight.value">' +
                            '<output  id="range_weight_disp"></output>' +
                            '<p>Original dimensions: <span class="dimensions"></span>' +
                            '<p>New dimensions: <span class="new-dimensions"></span></p>' +
                            '<p>Recommended around: <span> 530 x 630 </span></p>';

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

        function removeUpload(btn) {
            var file_upload = $(btn).parent().parent().parent();
            file_upload.find('.file-upload-input').replaceWith($('.file-upload-input').clone());
            file_upload.find('.file-upload-content').hide();
            file_upload.find('.image-upload-wrap').show();
            file_upload.find('.old-file-upload-input').remove();
        }

        $('.image-upload-wrap').bind('dragover', function () {
            console.log('alabala');
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

        $('#form-with-images').submit(function() {
            var fruits = [];
            $('.resize_percent').each(function(idx){
                fruits.push($(this).val());
            });

            $('#all-percent-images').val(fruits.join('|'))

        })

    </script>

@include('admin.admin_partials.admin_menu_bottom')
@endsection