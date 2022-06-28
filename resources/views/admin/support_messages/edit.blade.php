@extends('layouts.app_admin')

@section('content')
    <style>

    </style>
    @include('admin.admin_partials.admin_menu')
    <div class="basic-grey">
        <form action="/admin/support_messages/{{ $supportMessage->id }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <label>
                <span>Идентификатор</span>
                <input type="text" name="name_support_messages" value="{{$supportMessage->name_support_messages}}" id="name_support_messages" class="label-values" require />
            </label>

            <span>Съдържание:</span>
            <label>
                <textarea name="content_support_messages" id="editor-create" >{{ $supportMessage->content_support_messages }}</textarea>
            </label>

            <div class="actions">
                <input name="_method" type="hidden" value="PUT">
                <input class="btn btn-primary" type="submit" value="Промени">
            </div>
        </form>
    </div>

    <script src="{{ URL::to('/') }}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'editor-create' );
    </script>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection