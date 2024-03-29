@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="btn btn-primary btn-xs" href="/admin/print_templates">Back</a>
                        Update stamp
                    </div>
                    <div class="basic-grey">

                        <form action="/admin/print_templates/{{ $printTemplate->id }}" class="form-horizontal" id="form-with-images" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include('admin.print_templates.field_form')

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