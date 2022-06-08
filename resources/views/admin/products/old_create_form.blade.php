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

<div class="pull-right" align="" id="imageeditor" style="">
    <div class="btn-group">
        <button class="btn" id="bring-to-front" title="Bring to Front"><i class="icon-fast-backward rotate" style="height:19px;"></i></button>
        <button class="btn" id="send-to-back" title="Send to Back"><i class="icon-fast-forward rotate" style="height:19px;"></i></button>
        <button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>
        <button id="remove-selected" class="btn" title="Delete selected item"><i class="icon-trash" style="height:19px;"></i></button>
    </div>
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


<script type="text/javascript">
    /*
     var fileReader = new FileReader();
     var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

     fileReader.onload = function (event) {
     var image = new Image();

     image.onload=function(){
     document.getElementById("original-Img").src=image.src;
     var canvas=document.createElement("canvas");
     var context=canvas.getContext("2d");
     canvas.width=image.width/4;
     canvas.height=image.height/4;
     context.drawImage(image,
     0,
     0,
     image.width,
     image.height,
     0,
     0,
     canvas.width,
     canvas.height
     );

     document.getElementById("upload-Preview").src = canvas.toDataURL();
     }
     image.src=event.target.result;
     };

     var loooadImageFile = function () {
     var uploadImage = document.getElementById("upload-Image");

     //check and retuns the length of uploded file.
     if (uploadImage.files.length === 0) {
     return;
     }

     //Is Used for validate a valid file.
     var uploadFile = document.getElementById("upload-Image").files[0];
     if (!filterType.test(uploadFile.type)) {
     alert("Please select a valid image.");
     return;
     }

     fileReader.readAsDataURL(uploadFile);
     }
     */
</script>


<script>
    /*
     // gallery images
     $(document).ready(function() {
     var max_fields = 2;
     var wrapper = $("#view_images_wrapper");
     var upload_img_gallery_button = $(".upload-img-gallery-button");
     var field_img_gallery_button  = $(".add_img_button");
     var x = 1;

     var div_fields = document.createElement("div");
     div_fields.classList.add("fields");

     var a_remove_field = document.createElement("a");
     a_remove_field.classList.add("remove_field");

     div_fields.append();

     wrapper.append(div_fields);




     $(field_img_gallery_button).click(function(e){
     e.preventDefault();
     if(x < max_fields){
     x++;
     $(wrapper).append(
     '<div class="fields" ><label><span></span><br>' +
     '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
     '<input id="id_upload_image'+ x +'" type="file" name="upload_gallery_pictures[]" onchange="loadImageFile(this);"  multiple"/><br>' +
     '</label></div>');
     }
     });




     $(wrapper).on("click", ".remove_field", function(e){
     e.preventDefault();
     $(this).parent('div.fields label').parent('.fields').remove();
     x--;
     });
     });

     var loadImageFile = function (selectObject) {

     var fileReader = new FileReader();
     var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
     var uploadImage = document.getElementById(selectObject.id);
     //check and retuns the length of uploded file.
     if (uploadImage.files.length === 0) {
     return;
     }

     var uploadFile = document.getElementById(selectObject.id).files[0];

     if (!filterType.test(uploadFile.type)) {
     alert("Please select a valid image.");
     return;
     }

     //console.log(selectObject.value);

     fileReader.readAsDataURL(uploadFile);

     fileReader.onload = function (event) {
     var image = new Image();

     image.onload = function(){
     var label_wrapper = document.getElementById(selectObject.id).parentNode;
     var img_tag = document.createElement("img");
     img_tag.id = "tshirtFacing";

     var shirt_div = document.createElement("div");
     shirt_div.id = "shirtDiv";
     shirt_div.classList.add("page");
     shirt_div.style = "width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);";

     var canvas = document.createElement("canvas");
     var context = canvas.getContext("2d");

     canvas.width = 500;
     canvas.height = 500;

     context.drawImage(image, 0, 0, image.width, image.height, 0, 0, canvas.width, canvas.height);
     img_tag.src = canvas.toDataURL();

     var drawing_area = document.createElement("div");
     drawing_area.id = "drawingArea";
     drawing_area.style = "position: absolute;top: 100px;left: 160px;z-index: 10;width: 200px;height: 400px;";

     var canvas_container = document.createElement("div");
     canvas_container.classList.add("canvas-container");
     canvas_container.style = "width: 200px; height: 400px; position: relative; user-select: none;"
     drawing_area.append(canvas_container);

     var tcanvas = document.createElement("canvas");
     tcanvas.id = "tcanvas";
     tcanvas.classList.add("hover", "lower-canvas");
     tcanvas.width = 200;
     tcanvas.height = 400;
     tcanvas.style = "user-select: none; position: absolute; width: 200px; height: 400px; left: 0px; top: 0px;";

     var upper_canvas = document.createElement("canvas");
     upper_canvas.classList.add("upper-canvas");
     upper_canvas.width = 200;
     upper_canvas.height = 400;
     upper_canvas.style = "position: absolute; width: 200px; height: 400px; left: 0px; top: 0px; user-select: none; cursor: default;";

     canvas_container.append(tcanvas);
     canvas_container.append(upper_canvas);

     shirt_div.append(img_tag);
     shirt_div.append(drawing_area);
     label_wrapper.append(shirt_div);

     //var input_tag = document.createElement("input");
     //input_tag.type="file";
     //input_tag.value=event.target.result;
     //label_wrapper.append(input_tag);

     }

     image.src = event.target.result;
     };

     }*/
</script>


<script>
    //var input_width_num_tag = document.createElement("input");
    //var input_height_num_tag = document.createElement("input");

    //input_width_num_tag.type = "number";
    //input_width_num_tag.value = image.width;
    //label_wrapper.append(input_width_num_tag);

    //input_height_num_tag.type = "number";
    //input_height_num_tag.value = image.width;
    //label_wrapper.append(input_height_num_tag);
</script>


<script>
    /*
     $(".add_desings").click(function(e){
     e.preventDefault();
     var br = document.createElement("br");
     var desing_wrapper = document.createElement("div");
     desing_wrapper.classList.add("desing-wrapper");

     var input_tag = document.createElement("input");
     input_tag.classList.add("upload-img-file");
     input_tag.id = "upload-Image";
     input_tag.setAttribute("onchange", "loadImageFile();");
     input_tag.type="file";

     var remove_desing = document.createElement("a");
     remove_desing.classList.add("remove_desing", "btn-danger", "btn-xs");
     remove_desing.href = "#";
     remove_desing.textContent = 'Remove desing';

     desing_wrapper.append(input_tag);
     desing_wrapper.append(remove_desing);
     desing_wrapper.append(br);

     var shirt_div = document.createElement("div");
     shirt_div.id = "shirtDiv";
     shirt_div.classList.add("page");
     shirt_div.style = "width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);";

     var canvas = document.createElement("canvas");
     var context = canvas.getContext("2d");

     canvas.width = 500;
     canvas.height = 500;

     var img_tag = document.createElement("img");
     img_tag.id = "tshirtFacing";
     shirt_div.append(img_tag);
     //context.drawImage(image, 0, 0, image.width, image.height, 0, 0, canvas.width, canvas.height);
     //img_tag.src = canvas.toDataURL();

     var drawing_area = document.createElement("div");
     drawing_area.id = "drawingArea";
     drawing_area.style = "position: absolute;top: 100px;left: 160px;z-index: 10;width: 200px;height: 400px;";

     var canvas_container = document.createElement("div");
     canvas_container.classList.add("canvas-container");
     canvas_container.style = "width: 200px; height: 400px; position: relative; user-select: none;"
     drawing_area.append(canvas_container);

     var tcanvas = document.createElement("canvas");
     tcanvas.id = "tcanvas";
     tcanvas.classList.add("hover", "lower-canvas");
     tcanvas.width = 200;
     tcanvas.height = 400;
     tcanvas.style = "user-select: none; position: absolute; width: 200px; height: 400px; left: 0px; top: 0px;";

     var upper_canvas = document.createElement("canvas");
     upper_canvas.classList.add("upper-canvas");
     upper_canvas.width = 200;
     upper_canvas.height = 400;
     upper_canvas.style = "position: absolute; width: 200px; height: 400px; left: 0px; top: 0px; user-select: none; cursor: default;";

     canvas_container.append(tcanvas);
     canvas_container.append(upper_canvas);

     shirt_div.append(drawing_area);
     desing_wrapper.append(shirt_div);
     $("#desing-wrappers").append(desing_wrapper);


     $(".remove_desing").on('click', function(e){
     e.preventDefault();
     $(this).parent('div.desing-wrapper').remove();

     });


     });
     */

</script>

<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-35639689-1']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

    $(document).ready(function () {

        /*******************************************************************************/
        function getContentImage() {
            html2canvas(document.querySelector("#shirtDiv")).then(canvas => {
                // document.body.appendChild(canvas)
                $(canvas).get(0).toBlob(function (blob) {
                var urlCreator = window.URL || window.webkitURL;
                var imageUrl = urlCreator.createObjectURL(blob);
                $('#test').append('<img src="' + imageUrl + '"><br>');

            });
        })
            ;
        }

        function LoadeShirts() {
            $('.loading-blink').loading();
            $('.loading-blink').show();
            getContentImage();

            setTimeout(function () {
                rotate();
            }, 500);
            setTimeout(function () {
                getContentImage();
            }, 1200);
        }

        /*******************************************************************************/



        $('.loading-blink').hide();

        $('#imgsavejpg').on('click', function () {
            function save() {
                html2canvas(document.querySelector("#test")).then(canvas => {
                    // document.body.appendChild(canvas)
                    $(canvas).get(0).toBlob(function (blob) {
                    var filesaver = saveAs(blob, "TShirt.png");
                    filesaver.onwriteend = function () {
                        $('.loading-blink').hide();
                        $('#test').empty();
                    }


                });
            })
                ;
            }

            LoadeShirts();
            setTimeout(function () {
                save();
            }, 1700);

        });

        $('#rotate').click(function (e) {
            e.preventDefault();
            rotate();
        });

        function rotate() {
            $('#flip').click();
        }

        $("#addimg").on('click', function () {
            $('#imgInp').click();
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#avatarlist').append('<img class="img-polaroid tt" src="' + e.target.result + '">');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });

        $('#shirtstyle').on('change', function () {
            $('#tshirtFacing').attr("src", "img/t-shirts/" + $(this).val() + "_front.png");
            IMAGE_NAME = $(this).val();
        });

        $('#imgsavepdf').on('click', function () {
            $('.loading-blink').loading();
            $('.loading-blink').show();
            var doc = new jsPDF();
            doc.setFontSize(20);

            setTimeout(function () {
                html2canvas(document.querySelector("#shirtDiv")).then(canvas => {
                    function convertCanvasToImage(c)
                {
                    var image = new Image();
                    image.src = c.toDataURL("image/jpeg");
                    doc.addImage(image.src, 'JPEG', 30, 5, 145, 145);
                    return image;
                }
                convertCanvasToImage(canvas);

            })
                ;
            }, 100);
            setTimeout(function () {
                rotate();

            }, 700);
            setTimeout(function () {
                html2canvas(document.querySelector("#shirtDiv")).then(canvas => {
                    function convertCanvasToImage(c)
                {
                    var image = new Image();
                    image.src = c.toDataURL("image/jpeg");
                    doc.addImage(image.src, 'JPEG', 30, 150, 145, 145);
                    return image;
                }
                convertCanvasToImage(canvas);
            })
                ;
            }, 1100);
            setTimeout(function () {
                doc.save("T-Shirt.pdf");
                $('.loading-blink').hide();
                $('#test').empty();
            }, 1700);

        });

    });

</script>

<script>



    $(document).ready(function() {
        var max_fields = 10;
        var x = 1;
        var desing_wrapper = $("#desing-wrappers")

        $("#btn_add_desings").click(function(e){
            e.preventDefault();

            if(x < max_fields){
                x++;
                desing_wrapper.append(
                        '<div class="desing-wrapper"><div id="desing-buttons" class="desing-buttons">'+
                        '<input type="file" id="upload-Image" class="upload-img-file" >'+
                        '<a id="remove-desing" class="remove-desing btn-danger btn-xs" href="#">Remove desing</a>' +
                        '<div class="" align="" id="imageeditor" style="">'+
                        '<div class="btn-group">'+
                        '<button id="bring-to-front"  class="btn btn-success"  title="Bring to Front"><i class="icon-fast-backward rotate" style="height:19px;"></i></button>' +
                        '<button id="send-to-back"    class="btn btn-primary"  title="Send to Back"><i class="icon-fast-forward rotate" style="height:19px;"></i></button>' +
                        '<button id="flip"            class="btn btn-success" type="button" title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>' +
                        '<button id="remove-selected" class="btn btn-primary" title="Delete selected item"><i class="icon-trash" style="height:19px;"></i></button>' +
                        '</div></div></div><br>'+
                        '<div id="shirtDiv" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);">'+
                        '<img id="tshirtFacing" src="">'+
                        '<div id="drawingArea" style="position: absolute; top: 100px; left: 160px; z-index: 10; width: 200px; height: 400px;">'+
                        '<canvas id="tcanvas" class="hover lower-canvas" width="200" height="400" style="user-select: none; position: absolute; width: 200px; height:400px; left: 0px; top: 0px;"></canvas>'+
                        '</div></div></div>'
                )
            }

        });

        desing_wrapper.on("click", "a.remove-desing", function(e){
            e.preventDefault();
            $(this).parent('div.desing-buttons').parent('div.desing-wrapper').remove();
            x--;
        });
    });


</script>

<script>

    $(".img-polaroid").click(function(e){
        var el = e.target;
        var design = $(this).attr("src");

        $('#phoneDiv').css({
            'backgroundImage': 'url(' + design +')',
            'backgroundRepeat': 'no-repeat',
            'backgroundPosition': 'top center',
            'background-size': '10% 10%'

        });
        //  document.getElementById("phoneDiv").style.backgroundImage="url("+ design +")";
    });



    var fileReader = new FileReader();
    var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

    fileReader.onload = function (event) {
        var image = new Image();

        image.onload=function(){
            var img_prod = document.getElementById("tshirtFacing");
            img_prod.src = image.src;
            var base_img = document.getElementById("base_img");
            base_img.value = image.src;


            //document.getElementById("tshirtFacing").src = image.src;

            var canvas=document.createElement("canvas");
            var context=canvas.getContext("2d");
            canvas.width=image.width/4;
            canvas.height=image.height/4;

            var data = context.getImageData(0, 0, canvas.width, canvas.height);
            //console.log(data);
            //console.log(JSON.stringify(data));
            context.drawImage(image,
                    0,
                    0,
                    //image.width,
                    //image.height,
                    100,
                    100,
                    0,
                    0,
                    canvas.width,
                    canvas.height
            );

            //document.getElementById("upload-Preview").src = canvas.toDataURL();
        }
        image.src=event.target.result;
    };

    var loadImageFile = function (element_id) {

        var uploadImage = document.getElementById("upload-Image");
        //var input_base_img = document.createElement("input");
        //input_base_img.type = 'hidden';
        //input_base_img.name = 'base_img';
        //input_base_img.id = 'base_img';

        //var desing_wrapper = uploadImage.parentNode;
        //desing_wrapper.append(input_base_img);

        //check and retuns the length of uploded file.


        if (uploadImage.files.length === 0) {
            return;
        }

        //Is Used for validate a valid file.
        var uploadFile = document.getElementById("upload-Image").files[0];
        if (!filterType.test(uploadFile.type)) {
            alert("Please select a valid image.");
            return;
        }


        fileReader.readAsDataURL(uploadFile);
    }
</script>



<!--last code -->

<div id="desing-wrappers">

    <div class="desing-wrapper">
        <input type="file" id="upload-Image" class="upload-img-file" onchange="loadImageFile('#upload-Image');" >
        <input type="hidden" name="canvas_content" id="id-canvas-content" class="cl-canvas-content" >

        <a class="remove_desing btn-danger btn-xs" href="#">Remove desing</a>

        <br>
        <div id="shirtDiv" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);">
            <img id="tshirtFacing" src="">
            <div id="drawingArea" style="position: absolute; top: 100px; left: 160px; z-index: 10; width: 200px; height: 400px;">
                <canvas id="tcanvas" class="hover lower-canvas" width="200" height="400" style="user-select: none; position: absolute; width: 200px; height:400px; left: 0px; top: 0px;"></canvas>
            </div>
        </div>
    </div>

    <br>
    <div class="desing-wrapper">

        <div id="shirtDiv-b" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);">
            <div id="drawingArea-b" style="position: absolute; top: 100px; left: 160px; z-index: 10; width: 200px; height: 400px;">
                <canvas id="tcanvas-b" class="hover lower-canvas-b" width="200" height="400" style="user-select: none; position: absolute; width: 200px; height:400px; left: 0px; top: 0px;"></canvas>
                <canvas class="upper-canvas-b" width="200" height="400" style="position: absolute; width: 200px; height: 400px; left: 0px; top: 0px; user-select: none;"></canvas>
            </div>
        </div>
    </div>


</div>
<!--<canvas id="myCanvas"  width="530" height="630" style="border:1px solid #d3d3d3;">-->
<script>

    $(".img-polaroid").click(function(e){
        var el = e.target;
        var design = $(this).attr("src");

        $('#phoneDiv').css({
            'backgroundImage': 'url(' + design +')',
            'backgroundRepeat': 'no-repeat',
            'backgroundPosition': 'top center',
            'background-size': '100% 100%'

        });
        //  document.getElementById("phoneDiv").style.backgroundImage="url("+ design +")";
    });

    $(".remove_desing").on('click', function(e){
        e.preventDefault();
        $(this).parent('div.desing-wrapper').remove();

    });

    var fileReader = new FileReader();
    var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

    fileReader.onload = function (event) {
        var image = new Image();

        image.onload=function(){
            //get and put img url
            var img_prod = document.getElementById("tshirtFacing");
            img_prod.src = image.src;

            var input_canvas_content = document.getElementById('id-canvas-content');


            var canvas = document.createElement("canvas");
            var context = canvas.getContext("2d");

            var data = context.getImageData(0, 0, 530, 630);
            input_canvas_content.value = data;

            var c = document.getElementById("tcanvas-b");
            var con = c.getContext("2d");

            context.drawImage(image, 0, 0, 530, 630, 0, 0, canvas.width, canvas.height);
            con.putImageData(  data, 0, 0, 530, 630, 0, 0, canvas.width, canvas.height);
        }


        image.src=event.target.result;
    };

    var loadImageFile = function (element_id) {
        var uploadImage = document.getElementById("upload-Image");
        if (uploadImage.files.length === 0) {
            return;
        }

        //Is Used for validate a valid file.
        var uploadFile = document.getElementById("upload-Image").files[0];
        if (!filterType.test(uploadFile.type)) {
            alert("Please select a valid image.");
            return;
        }


        fileReader.readAsDataURL(uploadFile);
    }
</script>



<!-- test code -->


<script>

    // Add image from local
    var canvas = new fabric.Canvas('c');

    // display/hide text controls

    canvas.on('object:selected', function(e){
        if(e.target.type === 'i-text'){
            document.getElementById('textControls').hidden = false;
        }
    });

    canvas.on('before:selection:cleared', function(){
       if(e.target.type === 'i-text'){
           document.getElementById('textControls').hidden = true;
       }
    });

    document.getElementById('file').addEventListener('change', function(e){
       var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function(f){
            var data = f.target.result;
            fabric.Image.fromURL(data, function(img){
                var oImg = img.set({
                    left: 0,
                    top: 0,
                    angle: 00,
                    border: '#000',
                    stroke: '#F0F0F0', // <-- set this
                    strokeWidth: 40 // <-- set this

                }).scale(0.2);
                canvas.add(oImg).renderAll();
                // var a = canvas.setActivateObject(oImg);
                var dataURL = canvas.toDataURL({
                    format: 'png',
                    quality: 1
                });
            });
        };
        reader.readAsDataURL(file);
    });

    // Delete selected object

    window.deleteObject = function() {
        var activeGroup = canvas.getActiveGroup();
        if (activeGroup){
            var activeObjects = activeGroup.getObjects();
            for (let i in activeObjects){
                canvas.remove(activeObjects[i]);
            }

            canvas.discardActiveGroup();
            canvas.renderAll();

        }
        else
        {

            canvas.getActiveObject().remove()

        }
    }

    // Refresh page

    function refresh(){setTimeout(function() { location.reload() }, 100);}

    // Add text

    function Addtext(){
        canvas.add(new fabric.IText('Tab and Type', {
            left: 50,
            top: 100,
            fontFamily: 'helvetica neue',
            fill: '#000',
            stroke: '#fff',
            strokeWidth:.1,
            fontSize: 45

        }));
    }

    // Edit Text

    document.getElementById('text-color').onchange = function(){
      canvas.getActiveObject().setFill(this.value);
        canvas.renderAll();
    };
    document.getElementById('text-color').onchange = function(){
        canvas.getActiveObject().setFill(this.value);
        canvas.renderAll();
    };
    document.getElementById('text-bg-color').onchange = function(){
        canvas.getActiveObject().setBackgroundColor(this.value);
        canvas.renderAll();
    };
    document.getElementById('text-lines-bg-color').onchange = function(){
        canvas.getActiveObject().setTextBackgroundColor(this.value);
        canvas.renderAll();
    };
    document.getElementById('text-stroke-color').onchange = function(){
        canvas.getActiveObject().setStroke(this.value);
        canvas.renderAll();
    };
    document.getElementById('text-stroke-width').onchange = function(){
        canvas.getActiveObject().setStrokeWidth(this.value);
        canvas.renderAll();
    };
    document.getElementById('font-family').onchange = function(){
        canvas.getActiveObject().setFontFamily(this.value);
        canvas.renderAll();
    };
    document.getElementById('text-font-size').onchange = function(){
        canvas.getActiveObject().setFontSize(this.value);
        canvas.renderAll();
    };
    document.getElementById('text-line-height').onchange = function(){
        canvas.getActiveObject().setLineHeight(this.value);
        canvas.renderAll();
    };
    document.getElementById('text-align').onchange = function(){
        canvas.getActiveObject().setTextAlign(this.value);
        canvas.renderAll();
    };

    radios5 = document.getElementsByName('fonttype'); //wijzig naar button

    for(var i = 0, max = radios5.length; i < max; i++){
        radios5[i].onclick = function(){
            if(document.getElementById(this.id).checked == true){
                if(this.id == 'text-cmd-bold'){
                    canvas.getActiveObject().set('fontWeight', 'bold');
                }
                if(this.id == 'text-cmd-italic'){
                    canvas.getActiveObject().set('fontStyle', 'italic');
                }
                if(this.id == 'text-cmd-underline'){
                    canvas.getActiveObject().set('textDecoration', 'underline');
                }
                if(this.id == 'text-cmd-linethrough'){
                    canvas.getActiveObject().set('textDecoration', 'linethrough');
                }
                if(this.id == 'text-cmd-overline'){
                    canvas.getActiveObject().set('textDecoration', 'overline');
                }
            }else{
                if(this.id == 'text-cmd-bold'){
                    canvas.getActiveObject().set('fontWeight', '');
                }
                if(this.id == 'text-cmd-italic'){
                    canvas.getActiveObject().set('fontStyle', '');
                }
                if(this.id == 'text-cmd-underline'){
                    canvas.getActiveObject().set('textDecoration', '');
                }
                if(this.id == 'text-cmd-linethrough'){
                    canvas.getActiveObject().set('textDecoration', '');
                }
                if(this.id == 'text-cmd-overline'){
                    canvas.getActiveObject().set('textDecoration', '');
                }
            }
            canvas.renderAll();
        }
    }


    // Send selected object to front or back

    var selectedObject;
    canvas.on('object:selected', function(event){
       selectedObject = event.target;
    });

    var sendSelectedObjectBack = function(){
        canvas.sendToBack(selectedObject);
    }

    var sendSelectedObjectToFront = function(){
        canvas.sendToFront(selectedObject);
    }

    // Download

    var imageSaver = document.getElementById('inkDownload');
    imageSaver.addEventListener('click', saveImage, false);

    function saveImage(e){
        this.href = canvas.toDataURL({
            format: 'png',
            quality: 0.8
        });
        this.download = 'custom.png'
    }

    // Do some initializing stuff

    fabric.Object.prototype.set({
        transparentCorners: true,
        cornerColor: '#22A7FO',
        borderColor: '#22A7FO',
        cornerSize: 12,
        padding: 5
    });



</script>

<style>

    body{
        padding: 10px 10px 10px 10px;
        font-family: "Helvetica Neue";
    }


    canvas{
        border: 1px solid #bdc3c7;
        margin: 10px 0px 0px 0px;
    }

    .myFile{
        position: relative;
        overflow: hidden;
        float: left;
        clear: left;
    }

    .myFile input[type="file"]{
        display: block;
        position: absolute;
        top: 0;
        right: 0;
        opacity: 0;
        font-size: 30px;
        filter: alpha(opacity=0);
    }

    .title{
        color: black;
        text-decoration: none;
        margin-bottom: 20px;
        display: block;
    }

    hr{
        text-align: left;
        margin: 30px auto 0 0;
        width: 700px;
    }

    a:visited{
        text-decoration: none;
        color: #000;
    }


    a:active{
        text-decoration: none;
        color: #000;
    }

</style>


<script scr="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.11/fabric.js"></script>


<!DOCTYPE html>
<html>


<head>

    <meta charset="utf-8">
    <title>Brand</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="icons/css/materialdesignicons.css">
    <script scr="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>


<labe>
    <a style="text-decoration: none;", href="#">
        <span class="mdi mdi-lightbulb-on-online">Brand</span>
    </a>
</labe>


<label for="" title="Add an image", class="myFile">
    <span class="mdi mdi-image">Add Photo</span>
    <input type="file", id="file">
</label>

<a onclick="Addtext()" title="" href="#"><span>Add text</span></a>
<a onclick="sendSelectedObjectToFront()" title="" href="#"><span>Front</span></a>
<a onclick="sendSelectedObjectBack()" title="" href="#"><span>Back</span></a>
<a onclick="deleteObject()" title="" href="#"><span>Delete</span></a>
<a onclick="refresh()" title="" href="#"><span>Clear All</span></a>

<a id="InkDownload" title="Save" href="#"><span>Save</span></a>


<div id="textControls" hidden>
    <div id="text-wrapper" data-ng-show="getText()">
        <div id="text-controls">
            <select name="" id="font-family">

                <option value="arial" selected>Arial</option>
                <option value="Helvetica Neue">Helvetica Neue</option>
                <option value="myriad pro"> Myriad Pro</option>
                <option value="delicious"> Delicious</option>
                <option value="verdana">Verdana</option>
                <option value="georgia">Georgia</option>
                <option value="coutier">Courier</option>
                <option value="comic sans ms"> Comic Sans MS</option>
                <option value="impact">Impact</option>
                <option value="monaco">Monaco</option>
                <option value="optima">Optima</option>
                <option value="hoefler text">Hoefler Text</option>
                <option value="plaster">Plaster</option>
                <option value="engagement">Engagement</option>
            </select>

            <input type="color", id="text-color" size="10">
            <select name="" id="text-align">
                <option value="left">Align Left</option>
                <option value="center">Align Center</option>
                <option value="right">Align Right</option>
                <option value="justify">Align Justify</option>
            </select>


            <label for="text-stroke-color">Stroke C:</label>
            <input type="color" id="text-stroke-color">

            <label for="text-stroke-width">Stroke W:</label>
            <input type="number" value="1" min="1" max="5" id="text-stroke-width">

            <label for="text-font-size">Font S:</label>
            <input type="number" step="1" min="12" max="120" id="text-font-size">

            <label for="text-line-height">Line H:</label>
            <input type="number" step="0.1" min="0" max="10" id="text-line-height">

            <label for="text-bg-color">BG Color:</label>
            <input type="color" id="text-bg-color" size="10">

            <label for="text-lines-bg-color">BG Text Color:</label>
            <input type="color" id="text-lines-bg-color" size="10">


            <input type="checkbox" name="fonttype" id="text-cmd-bold"> <b>B</b>
            <input type="checkbox" name="fonttype" id="text-cmd-italic"> <em>I</em>
            <input type="checkbox" name="fonttype" id="text-cmd-underline"> Underline
            <input type="checkbox" name="fonttype" id="text-cmd-linethrough"> Linethrough
            <input type="checkbox" name="fonttype" id="text-cmd-overline"> Overline

        </div>
    </div>

</div>



<canvas id="c" width="700" height="500"></canvas>
<script src="fabric/fabric.min.js"></script>
<script src="javascript.js"></script>

</body>
</html>


<button class="add_desings btn-primary btn-xs">Add desing</button>

-------------------
<script>

    var fileReader = new FileReader();
    var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;



    fileReader.onload = function (event) {

        var image = new Image();

        image.onload=function(){
            //get and put img url
            var img_prod = document.getElementById("tshirtFacing");
            img_prod.src = image.src;
            var canvas = document.createElement("canvas");
            var context = canvas.getContext("2d");
            context.drawImage(image, 0, 0, 530, 630, 0, 0, canvas.width, canvas.height);
        }


        image.src=event.target.result;
    };

    var loadImageFile = function (element_id) {
        var uploadImage = document.getElementById("upload-Image");
        if (uploadImage.files.length === 0) {
            return;
        }

        //Is Used for validate a valid file.
        var uploadFile = document.getElementById("upload-Image").files[0];
        if (!filterType.test(uploadFile.type)) {
            alert("Please select a valid image.");
            return;
        }


        fileReader.readAsDataURL(uploadFile);
    }
    ///////////////////////////////////////

    $(".finish_desing").on('click', function(e){
        e.preventDefault();
        var input_canvas_content = document.getElementById('id-canvas-content');

        var canvas_data = JSON.stringify(canvas.toDatalessJSON());
        input_canvas_content.value = canvas_data;

    });

</script>

<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-35639689-1']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

    $(document).ready(function () {

        /*******************************************************************************/
        function getContentImage() {
            html2canvas(document.querySelector("#shirtDiv")).then(canvas => {
                // document.body.appendChild(canvas)
                $(canvas).get(0).toBlob(function (blob) {
                var urlCreator = window.URL || window.webkitURL;
                var imageUrl = urlCreator.createObjectURL(blob);
                $('#test').append('<img src="' + imageUrl + '"><br>');

            });
        })
            ;
        }

        function LoadeShirts() {
            $('.loading-blink').loading();
            $('.loading-blink').show();
            getContentImage();

            setTimeout(function () {
                rotate();
            }, 500);
            setTimeout(function () {
                getContentImage();
            }, 1200);
        }

        /*******************************************************************************/



        $('.loading-blink').hide();

        $('#imgsavejpg').on('click', function () {
            function save() {
                html2canvas(document.querySelector("#test")).then(canvas => {
                    // document.body.appendChild(canvas)
                    $(canvas).get(0).toBlob(function (blob) {
                    var filesaver = saveAs(blob, "TShirt.png");
                    filesaver.onwriteend = function () {
                        $('.loading-blink').hide();
                        $('#test').empty();
                    }


                });
            })
                ;
            }

            LoadeShirts();
            setTimeout(function () {
                save();
            }, 1700);

        });

        $('#rotate').click(function (e) {
            e.preventDefault();
            rotate();
        });

        function rotate() {
            $('#flip').click();
        }

        $("#addimg").on('click', function () {
            $('#imgInp').click();
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#avatarlist').append('<img class="img-polaroid tt" src="' + e.target.result + '">');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });

        $('#shirtstyle').on('change', function () {
            $('#tshirtFacing').attr("src", "img/t-shirts/" + $(this).val() + "_front.png");
            IMAGE_NAME = $(this).val();
        });

        $('#imgsavepdf').on('click', function () {
            $('.loading-blink').loading();
            $('.loading-blink').show();
            var doc = new jsPDF();
            doc.setFontSize(20);

            setTimeout(function () {
                html2canvas(document.querySelector("#shirtDiv")).then(canvas => {
                    function convertCanvasToImage(c)
                {
                    var image = new Image();
                    image.src = c.toDataURL("image/jpeg");
                    doc.addImage(image.src, 'JPEG', 30, 5, 145, 145);
                    return image;
                }
                convertCanvasToImage(canvas);

            })
                ;
            }, 100);
            setTimeout(function () {
                rotate();

            }, 700);
            setTimeout(function () {
                html2canvas(document.querySelector("#shirtDiv")).then(canvas => {
                    function convertCanvasToImage(c)
                {
                    var image = new Image();
                    image.src = c.toDataURL("image/jpeg");
                    doc.addImage(image.src, 'JPEG', 30, 150, 145, 145);
                    return image;
                }
                convertCanvasToImage(canvas);
            })
                ;
            }, 1100);
            setTimeout(function () {
                doc.save("T-Shirt.pdf");
                $('.loading-blink').hide();
                $('#test').empty();
            }, 1700);

        });

    });

</script>
