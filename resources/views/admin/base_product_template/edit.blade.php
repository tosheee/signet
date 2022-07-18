@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <a href="/admin/base_product_template" class="btn btn-default">Обратно</a>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New base product template</div>
                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="{{ route('base_product_template.store') }}/{{ $baseProductTemplate->id }}" enctype="multipart/form-data">
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

                            <div class="image-wrapper-basic" >

                                @foreach($content['images'] as $i => $image)
                                    <img src="/storage/images/base_templates/{{ $baseProductTemplate->id }}/{{ $image }}" alt="" height="100px"/>
                                    <span>Файл: </span>
                                    <input type="text" name="description[upload_main_picture]" value="{{$image}}" id="admin_product_description" class="label-values" />
                                    <input type="hidden" name="old_uploaded_picture[]" value="{{$image}}" id="admin_product_description" class="label-values"/>

                                    <a href="#" class="remove-image-button-basic"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>
                                    <input  style="width: 50px;" type="number" id="resize_percent" class="label-values" name="resize_percent" step="5" min="10" max="100" value="100" />     Оразмеряване в %

                                    <br><br>
                                @endforeach

                            </div>


                            <div class="custom-file">
                                <input type="file" name="images[]" class="custom-file-input" id="gallery-photo-add"  multiple />
                                <br><br>
                                <div class="gallery"></div>
                            </div>

                            <br><br>

                            <script>

                                $(function() {
                                    // Multiple images preview in browser
                                    var imagesPreview = function(input, placeToInsertImagePreview) {

                                        if (input.files) {
                                            var filesAmount = input.files.length;
                                            var catImageWidth = 0;
                                            for (i = 0; i < filesAmount; i++) {
                                                var reader = new FileReader();

                                                reader.onload = function(event) {
                                                    var image = new Image();
                                                    image.src = event.target.result;

                                                    var img = $($.parseHTML('<img>'));
                                                    img.attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                                                    img.attr('wight', '200');
                                                    img.attr('height', '200');
                                                    img.attr('class', 'img-base-templates');

                                                    image.onload = function() {
                                                        img.parent().append(image.width+' x '+image.height);
                                                    };
                                                }
                                                reader.readAsDataURL(input.files[i]);
                                            }
                                        }
                                    };

                                    $('#gallery-photo-add').on('change', function() {
                                        imagesPreview(this, 'div.gallery');
                                    });
                                });
                            </script>


                            </label>
                            <input  style="width: 50px;" type="number" id="resize_percent" class="label-values" name="resize_percent" step="5" min="10" max="100" value="100" />     Оразмеряване в %
                            </label>
                            <br><br>

                            <script>
                                $('#resize_percent').on('click', function(){

                                    console.log($(this).val())


                                });

                            </script>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Запис
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('admin.admin_partials.admin_menu_bottom')
@endsection