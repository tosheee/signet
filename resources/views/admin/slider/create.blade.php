@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')
        <div class="basic-grey">
            <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <label>
                    <span>Заглавие:</span>
                    <input type="text" name="img_title" value="" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span>Описание:</span>
                    <textarea name="img_description" value="" id="admin_prod_description" class="label-values"/></textarea>
                </label>

                <label>
                    <span>Снимка: </span>
                    <div class="upload-basic-img-wrapp" style="padding-top: 10px;">
                        <input type="file" name="img_file" class="label-values"/>
                    </div>
                </label>

                <br>
                <br>

                <div class="actions">
                    <input type="submit" name="commit" value="Създай" class="btn btn-success">
                </div>
            </form>
        </div>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection