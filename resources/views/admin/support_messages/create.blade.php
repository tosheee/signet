@extends('layouts.app_admin')

@section('content')
    <style>

    </style>
    @include('admin.admin_partials.admin_menu')
    <div class="basic-grey">
        <form action="{{ route('support_messages.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <label>
                <span>Идентификатор</span>
                <input type="text" name="name_support_messages" value="" id="name_support_messages" class="label-values" require />
            </label>

            <span>Съдържание:</span>
            <label>
                <textarea name="content_support_messages" id="editor-create" ></textarea>
            </label>

            <div class="actions">
                <input type="submit" name="commit" value="Създай" class="btn btn-success">
            </div>
        </form>
    </div>

    <script src="{{ URL::to('/') }}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'editor-create' );
    </script>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection