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
            <br>
            <div class="gallery-wrapper">
                <button type="button" class="upload-img-butt btn btn-info btn-xs">Add picture</button>
                <br>
            </div>
            <br>

            <div class="actions">
                <input name="_method" type="hidden" value="PUT">
                <input type="submit" name="commit" value="Обнови" class="btn btn-success">
            </div>
        </form>
    </div>
    @include('admin.admin_partials.admin_menu_bottom')
    @include('admin.admin_partials.images_script')
@endsection