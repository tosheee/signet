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
                            <br>

                            <div class="gallery-wrapper">
                                <button type="button" id="upload-img" class="upload-img-butt btn btn-info btn-xs" style="visibility: hidden;">Add picture</button>
                                <br>

                                @foreach($content['images'] as $i => $image)

                                    <div class="gallery-image-wrapper" id="g_wrapper{{$i}}">
                                        <a class="remove-image-button"><i style="color: red;" aria-hidden="true" class="fa fa-times"></i></a>
                                        <div class="file-upload">
                                            <div class="image-upload-wrap" style="display: none;">
                                                <input class="file-upload-input" name="images[]" type="file" onchange="readURL(this);" accept="image/*">
                                                <input class="old-file-upload-input" name="old_images[]" type="hidden"  value="{{$image}}">

                                                <div class="drag-text">
                                                    <h3>Drag and drop a file or select add Image</h3>
                                                </div>
                                            </div>

                                            <div class="file-upload-content" style="display: block;">
                                                <img class="file-upload-image" src="/storage/images/base_templates/{{$record_id}}/{{$image}}">

                                                <div class="image-title-wrap">
                                                    <button type="button" onclick="removeUpload(this)" class="" disabled>
                                                        Title: <span class="image-title">{{$image}}</span>
                                                    </button>
                                                </div>

                                                <div class="range-content">
                                                    <input type="range" data-width="530" data-height="630" name="resize_percent" id="range_weight" value="100" min="1" max="100" oninput="range_weight_disp.value = range_weight.value">
                                                    <output id="range_weight_disp"></output>

                                                    <p>Original dimensions: <span class="dimensions"></span></p>
                                                    <p>New dimensions: <span class="new-dimensions"></span></p>
                                                    <p>Recommended around: <span> 530 x 630 </span></p>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                    </div>

                                @endforeach

                            </div>
                            <input type="hidden" id="all-percent-images" name="percent_images">
                            <br>
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