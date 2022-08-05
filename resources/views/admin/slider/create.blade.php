@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <div class="basic-grey">
            <form action="{{ route('slider.store') }}" id="form-with-images" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <a class="btn btn-primary btn-xs" href="/admin/slider">Back</a>

                <label>
                    <span>Title:</span>
                    <input type="text" name="img_title" value="" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span>Link:</span>
                    <input type="text" name="link" value="" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span>Description:</span>
                    <textarea name="img_description" value="" id="admin_prod_description" class="label-values"/></textarea>
                </label>

                <label>
                    <span style="margin: 0;">Active: </span>
                    <input type="radio" name="active" value="1" checked> Yes
                    <input type="radio" name="active" value="0"> No
                </label>

                <br>

                <div class="gallery-wrapper">
                    <button type="button" class="upload-img-butt btn btn-info btn-xs">Add picture</button>
                    <br>
                </div>

                <br>
                <br>

                <div class="actions">
                    <input type="submit" name="commit" value="Създай" class="btn btn-success">
                </div>
            </form>
        </div>
    @include('admin.admin_partials.admin_menu_bottom')
    @include('admin.admin_partials.images_script')
@endsection