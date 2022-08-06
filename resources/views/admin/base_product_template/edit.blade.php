@extends('layouts.app_admin')
@section('content')
    @include('admin.admin_partials.admin_menu')

        <a href="/admin/base_product_template" class="btn btn-default">Back</a>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New base product template</div>
                    <div class="basic-grey">

                        <form class="form-horizontal" id="form-with-images" method="POST" action="{{ route('base_product_template.store') }}/{{ $baseProductTemplate->id }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include('admin.base_product_template.field_form')

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
    @include('admin.admin_partials.admin_menu_bottom')
    @include('admin.admin_partials.images_script')
@endsection