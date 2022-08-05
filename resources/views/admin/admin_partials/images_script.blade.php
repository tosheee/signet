<script>
        $(document).ready(function() {

            if ($('div.gallery-image-wrapper').length == 0)
            {
                $('#upload-img').css('visibility', 'visible');
            }
            else
            {
                $('#upload-img').css('visibility', 'hidden');
            }

            var wrapper = $(".gallery-wrapper");
            var button_upload_img = $(".upload-img-butt");
            var button_url_img    = $(".field-img-butt");
            var max_images = parseInt("{{  isset($maxImages) ?$maxImages : '1' }}");
            var x = $('.gallery-image-wrapper').length;

            $(button_upload_img).click(function(e){
                e.preventDefault();
                if(x < max_images) {
                    x++;
                    wrapper.append('' +
                            '<div class="gallery-image-wrapper" id="g_wrapper' + x +'"'+'>' +
                            '<div class="file-upload">' +
                            '<a class="remove-image-button"><i style="color: red;" class="fa fa-trash" aria-hidden="true"></i></a>'+
                            '<div class="image-upload-wrap">' +
                            '<input class="file-upload-input" name="images[]" type="file" onchange="readURL(this);" accept="image/*" />' +
                            '<div class="drag-text">' +
                            '<h3>Drag and drop a file or select add Image</h3></div></div>' +
                            '<div class="file-upload-content">' +
                            '<img class="file-upload-image" src="" alt="your image" />' +
                            '<div class="image-title-wrap">' +
                            '<button type="button" onclick="removeUpload(this)" class="remove-image">' +
                            'Remove <span class="image-title">Uploaded Image</span>' +
                            '</button></div><div class="range-content"></div></div></div><br></div>' +
                            '');
                }
            });

            $('.gallery-wrapper').on("click", ".remove-image-button", function(e){
                e.preventDefault();
                $('div.gallery-image-wrapper').remove();
                $('#upload-img').css('visibility', 'visible');
                x--;
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {

                var input_tag = $(input);
                var img_upload_wrap = input_tag.parent();
                var file_upload = img_upload_wrap.parent();
                var reader = new FileReader();

                reader.onload = function(e) {
                    var image = new Image();
                    image.src = event.target.result;
                    img_upload_wrap.hide();
                    file_upload.find('.file-upload-image').attr('src', e.target.result);
                    var file_upload_content = file_upload.find('.file-upload-content');
                    file_upload_content.show();
                    file_upload_content.find('.image-title').html(input.files[0].name);
                    file_upload.find('.range-content').children().remove();
                    var recommended_dim = "{{$recommended_dim ?? 'not implement'}}"

                    var range_tag = '' +
                            '<input type="range" data-width="" data-height=""  name="resize_percent" ' +
                            'class="resize_percent" id="range_weight" value="100" min="1" max="100" ' +
                            'oninput="range_weight_disp.value = range_weight.value">' +
                            '<output  id="range_weight_disp"></output>' +
                            '<p>Original dimensions: <span class="dimensions"></span>' +
                            '<p>New dimensions: <span class="new-dimensions"></span></p>' +
                            '<p>Recommended around: <span>'+ recommended_dim +'</span></p>';

                    var range_content = file_upload_content.find('.range-content');
                    range_content.append(range_tag);

                    image.onload = function() {
                        range_content.find('.dimensions').html(image.width+' x '+image.height);
                        range_content.find('input').attr("data-width", image.width);
                        range_content.find('input').attr('data-height', image.height)
                    };
                };

                reader.readAsDataURL(input.files[0]);
            }
            else
            {
                removeUpload();
            }
        }

        function removeUpload(btn) {
            var file_upload = $(btn).parent().parent().parent();
            file_upload.find('.file-upload-input').replaceWith($('.file-upload-input').clone());
            file_upload.find('.file-upload-content').hide();
            file_upload.find('.image-upload-wrap').show();
            file_upload.find('.old-file-upload-input').remove();
        }

        $('.image-upload-wrap').bind('dragover', function () {
            console.log('alabala');
            $('.image-upload-wrap').addClass('image-dropping');
        });

        $('.image-upload-wrap').bind('dragleave', function () {
            $('.image-upload-wrap').removeClass('image-dropping');
        });

        $(document).on('input', '#range_weight', function() {
            var img_width = $(this).attr('data-width');
            var img_height = $(this).attr('data-height');

            var new_img_width = ($(this).val() / 100) * img_width;
            var new_img_height = ($(this).val() / 100) * img_height;

            var add_to_html = Math.ceil(new_img_width) +  ' x '+ Math.ceil(new_img_height)
            $(this).parent().find('.new-dimensions').html(add_to_html);
        });

        $('#form-with-images').submit(function() {
            var fruits = [];
            $('.resize_percent').each(function(idx){
                fruits.push($(this).val());
            });
            console.log(fruits)
            $('#all-percent-images').val(fruits.join('|'))

        })
    </script>