@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New base product template</div>
                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="{{ route('base_product_template.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if(isset($adminCategories))
                                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    <label>
                                        <span>Категории:<sup style="color: red;">*</sup></span>
                                        <select class="form-control" name="category_id" id="select-category" required="required"  oninvalid="this.setCustomValidity('Моля, въведете категория!')" oninput="setCustomValidity('')">
                                            <option value="">Избери категория</option>
                                            @foreach($adminCategories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            @endif




                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Име</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>

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

                            </label>
                            <input  style="width: 50px;" type="number" class="label-values" name="resize_percent" min="10" max="100" value="100" />     Оразмеряване в %
                            </label>




                            <br><br>


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
