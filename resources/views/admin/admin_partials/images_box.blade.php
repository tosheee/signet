<div class="gallery-wrapper">
    <button type="button" class="upload-img-butt btn btn-info btn-xs">Add picture</button>
    <br><br>
    @if(isset($content['images']))
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
                        <?php $record_id = array_slice(explode('/', URL::current()), -2, 1, true)?>

                            <img class="file-upload-image" src="{{$image}}">

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
                            <p>Recommended around: <span> {{$recommended_dim ?? 'not implement'}} </span></p>
                        </div>

                    </div>
                </div>
                <br>
            </div>

        @endforeach
    @endif
    <input type="hidden" id="all-percent-images" name="percent_images">
</div>

