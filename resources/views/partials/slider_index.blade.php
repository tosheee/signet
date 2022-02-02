@if (isset($allSliderData))
    <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($allSliderData as $key=>$slider_data)
                @if($key == 0)
                    <li data-target="#carousel" data-slide-to="{{ $key }}" class="active"></li>
                @else
                    <li data-target="#carousel" data-slide-to="{{ $key }}"></li>
                @endif
            @endforeach
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner carousel-zoom">
            @foreach($allSliderData as $key=>$slider_data)
                @if($key == 0)
                    <div class="active item">
                @else
                    <div class="item">
                @endif
                    <img class="img-responsive" src="/storage/common_pictures/{{$slider_data->slider_img}}">
                    <div class="carousel-caption">
                        <h2>{{ $slider_data->title }}</h2>
                        <p>{{ $slider_data->description }}</p>
                    </div>
                </div>
            @endforeach


        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#carousel" data-slide="prev"></a>
        <a class="carousel-control right" href="#carousel" data-slide="next"></a>
    </div>
@endif