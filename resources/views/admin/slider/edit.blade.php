@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')
    <div class="basic-grey">
        <form action="/admin/slider/{{ $slider->id }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <label>
                <span>Заглавие:</span>
                <input type="text" name="img_title" value="{{ $slider->title }}" id="admin_product_description" class="label-values"/>
            </label>

            <label>
                <span>Описание:</span>
                <textarea name="img_description" id="admin_prod_description" class="label-values"/>{{ $slider->description }}</textarea>
            </label>

            <label class="basic-img-wrap">
                <span >Logo: <a class="upload-basic-img-butt">Click to change</a></span>
                <input style="padding-top: 10px;" type="text" value="{{ $slider->slider_img }}" name="img_name" id="url-basic-image-field"/>

            </label>


            <script>
                $(document).ready(function() {
                    var wrapper    = $(".basic-img-wrap");
                    var button_upload_basic_img = $(".upload-basic-img-butt");
                    var button_url_basic_img    = $(".field-basic-img-butt");

                    $(button_upload_basic_img).click(function(e) {
                        e.preventDefault();
                        var change_picture = confirm("Do you want to change the logo?");

                        if (change_picture == true) {
                            $('.upload-basic-img-butt').remove();
                            $('#url-basic-image-field').remove();
                            $(wrapper).append('<input style="padding-top: 10px;" type="file" name="img_file" class="label-values"/>');
                        }
                    });
                });

            </script>

            <br>
            <br>

            <div class="actions">
                <input name="_method" type="hidden" value="PUT">
                <input type="submit" name="commit" value="Обнови" class="btn btn-success">
            </div>
        </form>
    </div>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection