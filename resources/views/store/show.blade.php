@extends('layouts.app')

@section('content')
    <style>
        .slider_titles {
            color: #fa5a7f;
            text-align: center;
            font-family: 'Marck Script', cursive;
            font-size: 3em;
            margin-bottom: 5%;
        }
    </style>



    <div class="col-md-2" id="vertical-nav-bar">
        @include('partials.vertical_navigation')
    </div>


    <?php $descriptions = json_decode($product->description, true); ?>
    <div class="col-md-10">
        <div class="row">
            <ul style="padding: 20px 20px 20px 20px; ">
                <li>
                    <div class="order-breadcrumb">
                        <a href="/" class="">Начало</a>
                        @foreach($categories as $category)
                            @if($product->category_id == $category->id)
                                › <a href="/store/search?category={{ $category->id }}" class=""> {{ $category->name }}</a>
                            @endif
                        @endforeach

                        @foreach($subCategories as $subCategory)
                            @if($product->sub_category_id == $subCategory->id)
                                › <a href="/store/search?sub_category={{ $subCategory->identifier }}" class="active">{{ $subCategory->name }}</a>
                            @endif
                        @endforeach
                    </div>
                </li>
            </ul>
            <div class="show-page-product">
                <div class="col-md-6">
                    <div id="showPageProductImages">
                        <div class="container-fluid">
                            <div class="product-slider" id="product-slider-id">
                                <div id="carousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            @if (isset($descriptions['main_picture_url']))
                                                <img width="40" height="40" src="{{ $descriptions['main_picture_url'] }}" alt="pic" />
                                            @elseif(isset($descriptions['upload_main_picture']))
                                                <img width="40" height="40" src="{{ asset('product_images/')}}/{{ $product->id }}/{{ $descriptions['upload_main_picture'] }}" alt="pic" />
                                            @else
                                                <img width="40" height="40" src="/storage/common_pictures/noimage.jpg" alt="pic" />
                                            @endif
                                        </div>

                                        @if (isset($descriptions['gallery']))
                                            @foreach( $descriptions['gallery'] as $key => $type_pictures)
                                                @foreach($type_pictures as $key_picture => $picture)
                                                    <div class="item">
                                                        @if($key_picture == 'upload_picture')
                                                            <img width="40" height="40" src="{{ asset('product_images/')}}/{{ $product->id }}/{{ $type_pictures[$key_picture] }}" class="img-responsive">
                                                        @else
                                                            <img width="40" height="40" src="{{ $type_pictures[$key_picture] }}" class="img-responsive">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div id="thumbcarousel" class="carousel slide" data-interval="false">
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <div data-target="#carousel" data-slide-to="0" class="thumb">

                                                </div>

                                                @if (isset($descriptions['gallery']))
                                                    @foreach( $descriptions['gallery'] as $key => $type_pictures)
                                                        @foreach($type_pictures as $key_picture => $picture)
                                                            <div data-target="#carousel" data-slide-to="{{ $key+1 }}" class="thumb">
                                                                @if($key_picture == 'upload_picture')
                                                                    <img width="40" height="40" src="{{ asset('product_images/')}}/{{ $product->id }}/{{ $type_pictures[$key_picture] }}" class="img-responsive">
                                                                @else
                                                                    <img width="40" height="40" src="{{ $type_pictures[$key_picture] }}" class="img-responsive">
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </a> <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                   <div class="productInfo">
                       <h1 class="title" title="{{ $descriptions['title_product'] }}">{{ $descriptions['title_product'] }}</h1>
                       <span class="productId">Продуктов код: {{ $descriptions['article_id'] }}</span>

                       <div class="subProdInfo">
                           <span class="price">
                            <p>Цена: <strong>{{ number_format($descriptions['price'], 2) }}</strong> {{ $descriptions['currency'] }}</p>
                            @if (isset($descriptions['old_price']))
                                <span class="price_old">  Вместо: <del style="color: red"> {{ number_format($descriptions['old_price'], 2) }} {{ $descriptions['currency'] }}</del></span>
                            @endif
                        </span>
                           <span class="stock"></span>
                       </div>

                       <p> {{ isset($descriptions['short_description']) ? $descriptions['short_description'] : '' }}</p>

                       <label><a href="#"></a></label>
                       <div class="select-wrapper">
                           <span class="stock">Статус: {{ isset($descriptions['product_status'])  ? $descriptions['product_status'] : '' }}</span>
                       </div>

                       <div class="colors">
                           <div class="section">
                                <div class="fb-share-button" data-href="{{ Request::fullUrl() }}" data-layout="button_count" data-size="small" data-mobile-iframe="true">
                                    <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}&amp;src=sdkpreparse">Споделяне</a>
                                </div>

                                <div id="fb-root"></div>
                                <script>
                                    (function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = 'https://connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v2.11';
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));
                                </script>
                            </div>
                       </div>
                       <?php if(Session::has('cart'))
                        {
                            $oldCart = Session::get('cart');
                            if(isset($oldCart->items[$product->id]['qty']))
                            {
                                $product_qty = $oldCart->items[$product->id]['qty'];
                            }
                        }?>

                       <div class="addToCart">
                          <div class="qntySection">
                                <span class="btn minus-button" data-type="remove">-</span>
                                <span class="show-page" id="quantity-product">{{ isset($product_qty) ? $product_qty : '1' }}</span>
                                <input id="id-product-show-page" type="hidden" name="q" value="{{ $product->id }}"/>
                                <span class="btn plus-button" data-type="add">+</span>
                            </div>
                          <script>
                                $(document).ready(function() {
                                    $(".plus-button").on('click', function() {
                                        var $quantityProduct = $('#quantity-product');
                                        var plusValue = parseInt($quantityProduct.html());

                                        if (!isNaN(plusValue)) {
                                            $quantityProduct.html(plusValue + 1);
                                        } else {
                                            $quantityProduct.html(1);
                                        }
                                    });

                                    $(".minus-button").on('click', function() {
                                        var $quantityProduct = $('#quantity-product');
                                        var minusValue = parseInt($quantityProduct.html());
                                        if (!isNaN(minusValue) && minusValue > 1) {
                                            $quantityProduct.html(minusValue - 1);
                                        } else {
                                            $quantityProduct.html(1);
                                        }
                                    });
                                });
                            </script>
                            @if ($descriptions['product_status']!= 'Не е наличен')
                                <button class="add-cart-large add-product-button">
                                    Добави
                                    <i class="fa fa-shopping-cart" ></i>
                                    @if(!empty($oldCart->items[$product->id]) )
                                        <sup id="sup-product-qty"> {{ isset($product_qty) ? $product_qty : '' }}</sup>
                                        <input id="quantity-product" type="hidden" value="{{ isset($product_qty) ? $product_qty + 1 : '1' }}"  >
                                    @else
                                        <sup id="sup-product-qty"></sup>
                                        <input id="quantity-product" type="hidden" value="1"  >
                                    @endif

                                    <input id="id-product" type="hidden" value="{{ $product->id }}"/>
                                </button>
                            @else
                                <button class="add-cart-large add-product-button" disabled title="Очаква се доставка">Очаквайте скоро</button>
                            @endif
                       </div>
                   </div>
                </div>
            </div>
        </div>

        @if(isset($descriptions['general_description']))
            <div class="col-md-9">
                <div>
                    <ul class="menu-items">
                        <li class="active">Информация за продукта</li>
                        <li></li>
                        <li></li>
                    </ul>
                    <div style="width:100%;border-top:1px solid silver">
                        <p style="padding:15px;"> <p style="font-size: 150%;"> {!! $descriptions['general_description'] !!} </p> </p>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($descriptions['properties']))
            <?php $table_data = array_chunk($descriptions['properties'], 2) ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="text-left">Детайли</th>
                    <th class="text-left"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($table_data as $row )
                    <tr>
                        <td class="text-left"> {{ isset($row[0]['name']) ?  $row[0]['name'] : '' }}</td>
                        <td class="text-left"> {{ isset($row[1]['text']) ?  $row[1]['text'] : '' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <div class="col-md-9">
        <script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>

        @include('partials.items_slider')
        <script type="text/javascript">
                $(document).ready(function () {
                    $('#slider_product_sale, #slider_product_recommended, #slider_best_seller').owlCarousel({
                        autoplay: true,
                        autoplayTimeout: 2000,
                        autoplayHoverPause: true,
                        margin: 30,
                        responsive:{
                            0:{items: 1},
                            600:{items: 2},
                            1300:{items: 3},
                            1580:{items: 4}
                        }
                    });
                });
            </script>
    </div>
    <script>
        var slider = document.getElementById("sliderImages");
        var sliderIndex = document.getElementById("sliderIndex");
        var slidingImages = slider.children;
        var amountOfImages = slidingImages.length;
        var increment = 100 / amountOfImages;

        slider.style.width = 100 * amountOfImages + "%";
        slider.style.transform = "translateX(0%)";

        for(var i = 1; i <= amountOfImages; i++){
            var node = document.createElement("div");
            node.classList.add("slide");
            if (i === 1) node.classList.add('active');
            node.setAttribute("data-amount", (i - 1));
            node.addEventListener("click", handleSlideClick);
            sliderIndex.appendChild(node);
        }

        function handleSlideClick(e){
            for(var x = 0; x < sliderIndex.children.length; x++){
                sliderIndex.children[x].classList.remove("active");
            }
            e.target.classList.add("active");
            var move = e.target.getAttribute('data-amount') * increment;
            slider.style.transform = "translateX(-"+move+"%)";
        }
    </script>


@endsection