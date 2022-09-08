@extends('layouts.app_admin')

@section('content')


    @include('admin.admin_partials.admin_menu')

<!--


add type technology into description

-->

<div class="basic-grey">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="new_form">
            {{ csrf_field() }}

            <h2>Create product:</h2>

            <br>
            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label>
                    <span>Категории:<sup style="color: red;">*</sup></span>
                    <select class="form-control" name="category_id" id="select-category" required="required"  oninvalid="this.setCustomValidity('Моля, въведете категория!')" oninput="setCustomValidity('')">
                        <option value="">Category: </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" data-content="{{$category->filters}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div id="base-templates-box"></div>

            <div id="print-template-box"></div>

            <div class="pull-right" align="" id="imageeditor" style="">
                <div class="btn-group">
                    <button class="btn" id="bring-to-front" title="Bring to Front"><i class="icon-fast-backward rotate" style="height:19px;"></i></button>
                    <button class="btn" id="send-to-back" title="Send to Back"><i class="icon-fast-forward rotate" style="height:19px;"></i></button>
                    <button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>
                    <button id="remove-selected" class="btn" title="Delete selected item"><i class="icon-trash" style="height:19px;"></i></button>
                </div>
            </div>
            <br>
            <br>

            <div id="desing-wrappers" style="text-align: -webkit-center;">
                <div class="desing-wrapper">
                    <canvas id="canvas"></canvas>
                </div>
            </div>


            <br><br><br>
            <label>
                <span style="margin: 0;">Активен продукт в магазина: </span>
                <input type="radio" name="active" value="1" checked> ДА
                <input type="radio" name="active" value="0"> НЕ
            </label>
            <br>

            <label>
                <span>Име на продукта:</span>
                <input type="text" name="description[title_product]" value="" id="admin_product_description" class="label-values" require />
            </label>

            <label>
                <span style="margin: 0;">В разпродажба: </span>
                <input type="radio" name="sale" value="0" checked> НЕ
                <input type="radio" name="sale" value="1" > ДА
            </label>
            <br>

            <label>
                <span style="margin: 0;">Препоръчан: </span>
                <input type="radio" name="recommended" value="0" checked> НЕ
                <input type="radio" name="recommended" value="1"> ДА
            </label>
            <br>

            <label>
                <span style="margin: 0;">Най - продаван: </span>
                <input type="radio" name="best_sellers" value="0" checked> НЕ
                <input type="radio" name="best_sellers" value="1"> ДА
            </label>
            <br>

            <label>
                <span style="margin: 0;">Наличност: </span>
                <input type="radio" name="description[product_status]" value="Наличен" checked> Наличен
                <input type="radio" name="description[product_status]" value="По поръчка"> По поръчка
                <input type="radio" name="description[product_status]" value="Не е наличен"> Не е наличен
            </label>
            <br>

            <label>
                <span>Доставна цена:</span>
                <input type="text" name="description[delivery_price]" value="" id="admin_product_description" class="label-values"/>
            </label>

            <label>
                <span>Цена в магазина:</span>
                <input type="text" name="description[price]" value="" id="admin_product_description" class="label-values"/>
            </label>

            <label>
                <span>Стара цена:</span>
                <input type="text" name="description[old_price]" value="" id="admin_product_description" class="label-values"/>
            </label>

            <label>
                <span style="margin: 0;">Валута:</span>
                <input type="radio" name="description[currency]" value="лв." checked> BGN:
                <input type="radio" name="description[currency]" value="euro"> EUR:
                <input type="radio" name="description[currency]" value="usd">  USD:
            </label>
            <br>

            <label>
                <span>Късо описание на продукта:</span>
                <textarea name="description[short_description]" value="" id="admin_product_description" class="label-values"/></textarea>
            </label>

            <span>Описание на продукта:</span>

            <label>
                <textarea name="description[general_description]" id="editor-create" ></textarea>
            </label>
            <br>

            <label>
                <span style="margin: 0;">Resize Images percent:</span>
                <input type="number" name="resize_percent" min="0" max="100" step="10" value="50"/>
            </label>
            <br><br><br>

            <br>
            <div class="specification_fields_wrap">
                <button class="add_spec_field_button btn-primary btn-xs">Добавяна на спецификация</button>
                <br>
                <br>
            </div>

            <div class="input-append">
                <input class="span2" id="text-string" type="text" placeholder="Add text ...">
                <button id="add-text" class="btn" title="text">
                    Add text
                </button>
                <hr>
            </div>

        </form>
    </div>

    @include('admin.products.product_scripts')
    @include('admin.admin_partials.admin_menu_bottom')
@endsection