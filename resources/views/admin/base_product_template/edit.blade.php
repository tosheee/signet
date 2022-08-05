@extends('layouts.app_admin')
@section('content')
    @include('admin.admin_partials.admin_menu')

        <a href="/admin/base_product_template" class="btn btn-default">Back</a>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New base product template</div>
                    <div class="panel-body">

                        <form class="form-horizontal" id="form-with-images" method="POST" action="{{ route('base_product_template.store') }}/{{ $baseProductTemplate->id }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if(isset($adminCategories))
                                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    <label>
                                        <span>Категории:</span>
                                        <select class="form-control" name="category_id" id="select-category">
                                            <option value="">Избери категория</option>
                                            @foreach($categories as $category)
                                                @if ($baseProductTemplate->category_id == $category->id )
                                                    <option selected="selected" value="{{ $category->id }}">{{ isset($category->name) ?  $category->name : '' }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ isset($category->name) ?  $category->name : ''  }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            @endif

                            <?php $content = json_decode($baseProductTemplate->content, true); ?>


                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Име</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$content['name']}}"required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <label>
                                <span style="margin: 0;">Активен продукт в магазина: </span>
                                <input type="radio" name="active" value="1" checked> ДА
                                <input type="radio" name="active" value="0"> НЕ
                            </label>

                            @include('admin.admin_partials.images_box')

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