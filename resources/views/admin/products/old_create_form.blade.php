<div class="basic-grey">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
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
                  <span style="margin: 0;">Colors: </span>
                  <div class="custom-radios">
                        <div>
                            <input type="radio" id="product-color-green" name="product_color" value="green">
                            <label for="product-color-green">
                                <span><i class="fa fa-check-circle"></i></span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="product-color-blue" name="product_color" value="blue">
                            <label for="product-color-blue">
                                <span><i class="fa fa-check-circle"></i></span></span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="product-color-yellow" name="product_color" value="yellow">
                            <label for="product-color-yellow">
                                <span><i class="fa fa-check-circle"></i></span></span>
                            </label>
                        </div>

                        <div>
                          <input type="radio" id="product-color-red" name="product_color" value="red">
                          <label for="product-color-red">
                              <span><i class="fa fa-check-circle"></i></span></span>
                          </label>
                      </div>

                      <div>
                          <input type="radio" id="product-color-white" name="product_color" value="white">
                          <label for="product-color-white">
                              <span><i class="fa fa-check-circle"></i></span></span>
                          </label>
                      </div>

                      <div>
                          <input type="radio" id="product-color-pink" name="product_color" value="pink">
                          <label for="product-color-pink">
                              <span><i class="fa fa-check-circle"></i></span></span>
                          </label>
                      </div>

                      <div>
                          <input type="radio" id="product-color-orange" name="product_color" value="orange">
                          <label for="product-color-orange">
                              <span><i class="fa fa-check-circle"></i></span></span>
                          </label>
                      </div>

                      <div>
                          <input type="radio" id="product-color-purple" name="product_color" value="purple">
                          <label for="product-color-purple">
                              <span><i class="fa fa-check-circle"></i></span></span>
                          </label>
                      </div>

                      <div>
                          <input type="radio" id="product-color-grey" name="product_color" value="grey">
                          <label for="product-color-grey">
                              <span><i class="fa fa-check-circle"></i></span></span>
                          </label>
                      </div>

                      <div>
                          <input type="radio" id="product-color-brown" name="product_color" value="brown">
                          <label for="product-color-brown">
                              <span><i class="fa fa-check-circle"></i></span></span>
                          </label>
                      </div>

                      <div>
                          <input type="radio" id="product-color-black" name="product_color" value="black">
                          <label for="product-color-black">
                              <span><i class="fa fa-check-circle"></i></span></span>
                          </label>
                      </div>
                  </div>
              </label>
              <br/>


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

                </label>
                    Оразмеряване в % <input style="width: 50px;" type="number" class="label-values" name="resize_percent" min="1" max="100" value="25" />
                 </label>

                <br/><br/>

                <label>
                    <input id="file-input" type="file" name="upload_gallery_pictures[]" multiple />
                    <br>
                    <div id="preview"></div>
                </label>

                <div class="input_fields_wrap">
                    <button class="field-img-gallery-button btn btn-warning btn-xs">Добавяне на снимка от линк</button>
                    <br>
                    <br>
                </div>




                <div class="specification_fields_wrap">
                    <button class="add_spec_field_button btn-primary btn-xs">Добавяна на спецификация</button>
                    <br>
                    <br>
                </div>

                <div class="actions">
                    <input type="submit" name="commit" value="Създай" class="btn btn-success">
                </div>
            </form>
        </div>


<script>
    /*
     $(document).ready(function() {
     var max_fields = 2;
     var wrapper    = $(".basic-img-wrap");
     var button_upload_basic_img = $(".upload-basic-img-butt");
     var button_url_basic_img    = $(".field-basic-img-butt");
     var x = 1;
     $(button_url_basic_img).click(function(e){
     e.preventDefault();
     if(x < max_fields){
     x++;
     $(wrapper).append('<div class="url-basic-image-field" ><label><span>Основна снимка от линк:</span>' +
     '<input type="text" name="description[main_picture_url]" value="" id="admin_product_description" class="label-values"/>' +
     '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
     '</label></div>');
     }
     });
     $(wrapper).on("click", ".remove_field", function(e){
     e.preventDefault(); $(this).parent('div.url-basic-image-field label').remove(); x--;
     });
     $(button_upload_basic_img).click(function(e){
     e.preventDefault();
     if(x < max_fields){
     x++;
     $(wrapper).append('<div class="upload-basic-img-wrapp">' +
     '<input type="file" name="upload_main_picture" class="label-values" id="image"/>' +

     '<input type="hidden" name="x1" value="" />'+
     '<input type="hidden" name="y1" value="" />'+
     '<input type="hidden" name="w" value="" />'+
     '<input type="hidden" name="h" value="" />'+
     '<p><img id="previewimage" style="display:none; width: 20%;"/></p>'+
     '<a href="#" class="remove-img-upload-button">' +
     '<i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
     '</div>');
     }

     $(function($) {
     var p = $("#previewimage");
     $(".upload-basic-img-wrapp").on("change", "#image", function(){
     var imageReader = new FileReader();
     imageReader.readAsDataURL(document.getElementById("image").files[0]);
     imageReader.onload = function (oFREvent) {
     p.attr('src', oFREvent.target.result).fadeIn();
     };

     $('#previewimage').imgAreaSelect({
     onSelectEnd: function (img, selection) {
     $('input[name="x1"]').val(selection.x1);
     $('input[name="y1"]').val(selection.y1);
     $('input[name="w"]').val(selection.width);
     $('input[name="h"]').val(selection.height);
     }
     });
     });
     });
     });


     $(wrapper).on("click", ".remove-img-upload-button", function(e){
     e.preventDefault(); $(this).parent('div.upload-basic-img-wrapp').remove(); x--;
     });
     });
     */
</script>