@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create category</div>
                    <div class="panel-body">
                        <form id="form-category" class="form-horizontal" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include('admin.categories.fields_form')
                            <br>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.categories.json_editor_script')
    @include('admin.admin_partials.admin_menu_bottom')
    @include('admin.admin_partials.images_script')
@endsection
