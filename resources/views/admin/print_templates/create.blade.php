@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Създаване на нов щампа</div>
                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="{{ route('print_templates.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if(isset($categories))
                                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    <label>
                                        <span>Категории:<sup style="color: red;">*</sup></span>
                                        <select class="form-control" name="category_id" id="select-category" required="required"  oninvalid="this.setCustomValidity('Моля, въведете категория!')" oninput="setCustomValidity('')">
                                            <option value="">Избери категория</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            @endif

                            @if(isset($subCategories))
                                <div class="form-group{{ $errors->has('sub_category_id') ? ' has-error' : '' }}">
                                    <label>
                                        <span>Подкатегория:<sup style="color: red;">*</sup></span>
                                        <select class="form-control" name="sub_category_id" id="select-sub-category" required="required"  oninvalid="this.setCustomValidity('Моля, въведете подкатегория!')" oninput="setCustomValidity('')">
                                            <option value="">Избери подкатегория</option>
                                                @foreach($subCategories as $sub_category)
                                                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                                @endforeach
                                        </select>
                                    </label>
                                </div>
                            @endif

                            @if(isset($typePrintTemplates))
                                <div class="form-group{{ $errors->has('sub_category_id') ? ' has-error' : '' }}">
                                    <label>
                                        <span>Подкатегория:<sup style="color: red;">*</sup></span>
                                        <select class="form-control" name="type_print_template_id" id="type_print_template" required="required"  oninvalid="this.setCustomValidity('Please enter type!')" oninput="setCustomValidity('')">
                                            <option value="">Chose Type Print Template</option>
                                                @foreach($typePrintTemplates as $typePrintTemplate)
                                                    <option value="{{ $typePrintTemplate->id }}">{{ $typePrintTemplate->name }}</option>
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


                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="chooseImage"  multiple />
                                <label class="custom-file-label" for="chooseFile">Select image</label>
                            </div>

                            <label>
                                <span style="margin: 0;">Активен продукт в магазина: </span>
                                <input type="radio" name="active" value="1" checked> ДА
                                <input type="radio" name="active" value="0"> НЕ
                            </label>
                            <br>

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
