@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

    <div class="basic-grey">
        <form action="/admin/slider/{{ $slider->id }}" id="form-with-images" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <a class="btn btn-primary btn-xs" href="/admin/slider">Back</a>
            <label>
                <span>Заглавие:</span>
                <input type="text" name="img_title" value="{{ $slider->title }}" id="admin_product_description" class="label-values"/>
            </label>

            <label>
                <span>Описание:</span>
                <textarea name="img_description" id="admin_prod_description" class="label-values"/>{{ $slider->description }}</textarea>
            </label>


            <br>
            <?php $content = json_decode($slider->slider_img, true); ?>
            <div class="gallery-wrapper">
                <button type="button" id="upload-img" class="upload-img-butt btn btn-info btn-xs" style="visibility: hidden;">Add picture</button>
                <br>

                @foreach($content['images'] as $i => $image)

                    <div class="gallery-image-wrapper" id="g_wrapper{{$i}}">
                        <div class="file-upload">
                            <a class="remove-image-button"><i style="color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                            <div class="image-upload-wrap" style="display: none;">

                                <input class="file-upload-input" name="images[]" type="file" onchange="readURL(this);" accept="image/*">
                                <input class="old-file-upload-input" name="old_images[]" type="hidden"  value="{{$image}}">

                                <div class="drag-text">
                                    <h3>Drag and drop a file or select add Image</h3>
                                </div>
                            </div>

                            <div class="file-upload-content" style="display: block;">
                                <img class="file-upload-image" src="/storage/images/slider/{{$slider->id}}/{{$image}}">

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
            <br>

            <div class="actions">
                <input name="_method" type="hidden" value="PUT">
                <input type="submit" name="commit" value="Обнови" class="btn btn-success">
            </div>
        </form>
    </div>
    @include('admin.admin_partials.admin_menu_bottom')
    @include('admin.admin_partials.images_script')
@endsection