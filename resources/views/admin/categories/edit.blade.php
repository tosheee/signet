@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <a href="/admin/categories" class="btn btn-default">Обратно</a>

        <form method="POST" action="/admin/categories/{{ $category->id }}" accept-charset="UTF-8" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Category</label>
                <input class="form-control" placeholder="Name" name="name" type="text" value="{{ $category->name }}" id="name">
            </div>

            <div class="form-group">
                <label for="name">Identifier</label>
                <input class="form-control" placeholder="Identifier" name="identifier" type="text" value="{{ $category->identifier }}" id="identifier">
            </div>

            <div class="form-group{{ $errors->has('filters') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Filters</label>
                <div class="col-md-6">
                    <textarea  class="form-control" id="exampleFormControlTextarea1" name="filters" rows="4" cols="50">{{ $category->filters or '' }}</textarea>

                    @if ($errors->has('filters'))
                        <span class="help-block"><strong>{{ $errors->first('filters') }}</strong></span>
                    @endif
                </div>
            </div>

            <input name="_method" type="hidden" value="PUT">
            <input class="btn btn-primary" type="submit" value="Промяна">
        </form>

@include('admin.admin_partials.admin_menu_bottom')
@endsection