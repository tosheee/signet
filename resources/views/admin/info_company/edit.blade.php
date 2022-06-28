@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <div class="basic-grey">
            <form action="/admin/info_company/{{ $info_company->id }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label>
                    <span>Име на фирмата:</span>
                    <input type="text" name="name_company" value="{{ $info_company->name_company }}" class="label-values"/>
                </label>

                <label>
                    <span>Адрес:</span>
                    <textarea name="address_com" class="label-values"/> {{ $info_company->address_com }} </textarea>
                </label>

                <label>
                    <span>Имейл:</span>
                    <input type="text" name="email_com" value="{{ $info_company->email_com }}" class="label-values"/>
                </label>

                <label>
                    <span>Телефон:</span>
                    <input type="text" name="phone_com" value="{{ $info_company->phone_com }}" class="label-values"/>
                </label>

                <label>
                    <span>Работно време:</span>
                    <input type="text" name="work_time_com" value="{{ $info_company->work_time_com }}" class="label-values"/>
                </label>

                <label>
                    <span>Google Map:</span>
                    <textarea name="map_com" class="label-values"/> {{ $info_company->map_com }} </textarea>
                </label>
                
                <label>
                    <span></span>
                    <p> Логото и водният знак винаги трябва да бъдат с разширение .png</p>
                </label>

                <label class="basic-img-wrap">
                    <span >Logo: <a class="upload-basic-img-butt">Click to change</a></span>
                    <input style="padding-top: 10px;" type="text" value="{{ $info_company->logo_com }}" name="logo_name" id="url-basic-image-field"/>

                </label>
                
                <script>
                    $(document).ready(function() {
                        var wrapper    = $(".basic-img-wrap");
                        var button_upload_basic_img = $(".upload-basic-img-butt");
                        var button_url_basic_img    = $(".field-basic-img-butt");

                        $(button_upload_basic_img).click(function(e){
                            e.preventDefault();
                            var change_picture =  confirm("Do you want to change the logo?");

                            if (change_picture == true){
                                $('.upload-basic-img-butt').remove();
                                $('#url-basic-image-field').remove();
                                $(wrapper).append('<input style="padding-top: 10px;" type="file" name="upload_logo_picture" class="label-values"/>');
                            }
                        });

                  
                    });
                </script>
                
                
                
                
                <label class="watermark-img-wrap">
                    <span >Воден знак: <a class="upload-watermark-butt">Click to change</a></span>
                    <input style="padding-top: 10px;" type="text" value="{{ $info_company->watermark }}" name="watermark_name" id="watermark-field"/>

                </label>
                
                
                
                <script>
                    $(document).ready(function() {
                        var wrapper    = $(".watermark-img-wrap");
                        var button_watermark_img = $(".upload-watermark-butt");
                        //var button_url_basic_img    = $(".field-watermark-img-butt");

                        $(button_watermark_img).click(function(e){
                            e.preventDefault();
                            var change_picture =  confirm("Do you want to change the watermark?");

                            if (change_picture == true){
                                $('.upload-watermark-butt').remove();
                                $('#watermark-field').remove();
                                $(wrapper).append('<input style="padding-top: 10px;" type="file" name="watermark" class="label-values"/>');
                            }
                        });

                    
                    });
                </script>


                



                <br>
                <span><b>Описание на фирмата:</b></span>
                <label>
                    <textarea name="description_com"  id="editor-info-company-edit" >{{ $info_company->description_com }}</textarea>
                </label>

                <div class="actions">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="submit" name="commit" value="Промяна на информацията за компанията" class="btn btn-success">
                </div>
            </form>
        </div>

        <script src="{{ URL::to('/') }}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

        <script>
            CKEDITOR.replace( 'editor-info-company-edit' );
        </script>

    @include('admin.admin_partials.admin_menu_bottom')
@endsection