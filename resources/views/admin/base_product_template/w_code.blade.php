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

        $('#chooseImage').on('change', function() {
            imagesPreview(this, 'div.gallery');
        });
    });
</script>

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