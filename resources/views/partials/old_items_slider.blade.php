<style>


</style>

<div class="slider-item-content">
    @if(count($productsSale) > 0)

        <h1 class="slider_titles">Разпродажба</h1>

        <div class="owl-carousel" id="slider_product_sale">
            @foreach($productsSale as $product)
                <?php $descriptSale = json_decode($product->description, true); ?>
                <div class="item-product-slider">

                    <div class="product">
                        <div class="ribbon-wrapper-1">
                            <div class="ribbon-1" style="z-index: 100; font-size: 12px; background-color: #ff99a1;">Разпродажба</div>
                        </div>
                        <div class="info-large">
                            <h4 title="{{ $descriptSale['title_product'] }}">{{ $descriptSale['title_product'] }}</h4>
                            <div class="sku">
                                PRODUCT SKU: <strong>89356</strong>
                            </div>

                            <div class="price-big">
                                        <span>
                                           @if(isset($descriptSale['old_price']))
                                                {{ $descriptSale['old_price'] }}
                                                {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                                            @endif
                                        </span>
                                {{ isset($descriptSale['price']) ? $descriptSale['price'] : '' }}
                                {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                            </div>
                        </div>
                        <div class="make3D">

                            <div class="product-front">

                                @if (isset($descriptSale['main_picture_url']))
                                    <img style="max-width: 270px; max-height: 320px;" src="{{ $descriptSale['main_picture_url'] }}"  alt="{{ $descriptSale['title_product'] }}"/>
                                @elseif(isset($descriptSale['upload_main_picture']))
                                    <img style="max-width: 270px; max-height: 320px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptSale['upload_main_picture'] }}" alt="{{ $descriptSale['title_product'] }}"/>
                                @else
                                    <img style="max-width: 270px; max-height: 320px;" src="/storage/common_pictures/noimage.jpg" alt="{{ $descriptSale['title_product'] }}" />
                                @endif

                                <div class="image_overlay"></div>
                                <div class="view_gallery">Галерия</div>
                                <a href="/store/{{ $product->id }}">
                                    <div class="view_product">Виж подробности
                                    </div>
                                </a>

                                <div class="stats">

                                    <div class="stats-container">
                                        <span class="product_name" title="{{ $descriptSale['title_product'] }}">{{ $descriptSale['title_product'] }}</span>
                                        <br/>
                                            <span class="product_price">
                                                <div>
                                                    <span class="price">

                                                        <strong>
                                                            {{ isset($descriptSale['price']) ? $descriptSale['price'] : '' }}
                                                            {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                                                        </strong>
                                                     </span>

                                                    @if(isset($descriptSale['old_price']))
                                                        <span class="price_old">
                                                            <del>
                                                                {{ $descriptSale['old_price'] }}
                                                                {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                                                            </del>
                                                        </span>
                                                    @endif
                                                </div>
                                            </span>
                                        <br/>

                                        <div class="product-options">
                                            <strong></strong>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-back">
                                <div class="shadow"></div>
                                <div class="carousel">
                                    <ul class="carousel-container">
                                        @if (isset($descriptSale['main_picture_url']))
                                            <li><img style="max-width: 270px; max-height: 320px;" src="{{ $descriptSale['main_picture_url'] }}" alt="{{ $descriptSale['title_product'] }}" /></li>
                                        @elseif(isset($descriptSale['upload_main_picture']))
                                            <li><img style="max-width: 270px; max-height: 320px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptSale['upload_main_picture'] }}" alt="{{ $descriptSale['title_product'] }}" /></li>
                                        @else
                                            <li><img style="max-width: 270px; max-height: 320px;" src="/storage/common_pictures/noimage.jpg" alt="{{ $descriptSale['title_product'] }}" /></li>
                                        @endif

                                        @if(isset($descriptSale['gallery']))
                                            @foreach( $descriptSale['gallery'] as $type_pictures)
                                                @foreach($type_pictures as $key_picture => $picture)
                                                    <li>
                                                        @if($key_picture == 'upload_picture')
                                                            <img style="max-width: 270px; max-height: 320px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $type_pictures[$key_picture] }}">
                                                        @else
                                                            <img style="max-width: 270px; max-height: 320px;" src="{{ $type_pictures[$key_picture] }}">
                                                        @endif
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        @endif

                                    </ul>
                                    <div class="arrows-perspective">
                                        <div class="carouselPrev">
                                            <div class="y"></div>
                                            <div class="x"></div>
                                        </div>
                                        <div class="carouselNext">
                                            <div class="y"></div>
                                            <div class="x"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flip-back">
                                    <div class="cy"></div>
                                    <div class="cx"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="slider-item-content">
    @if(count($productsRecommended) > 0)

        <h1 class="slider_titles">Препоръчан</h1>

        <div class="owl-carousel" id="slider_product_sale">
            @foreach($productsRecommended as $product)
                <?php $descriptSale = json_decode($product->description, true); ?>
                <div class="item-product-slider">

                    <div class="product">
                        <div class="ribbon-wrapper-1">
                            <div class="ribbon-1" style="z-index: 100; font-size: 12px; background-color: #ff99a1;">Препоръчан</div>
                        </div>
                        <div class="info-large">
                            <h4 title="{{ $descriptSale['title_product'] }}">{{ $descriptSale['title_product'] }}</h4>
                            <div class="sku">
                                PRODUCT SKU: <strong>89356</strong>
                            </div>

                            <div class="price-big">
                                        <span>
                                           @if(isset($descriptSale['old_price']))
                                                {{ $descriptSale['old_price'] }}
                                                {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                                            @endif
                                        </span>
                                {{ isset($descriptSale['price']) ? $descriptSale['price'] : '' }}
                                {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                            </div>
                        </div>
                        <div class="make3D">

                            <div class="product-front">

                                @if (isset($descriptSale['main_picture_url']))
                                    <img style="max-width: 270px; max-height: 320px;" src="{{ $descriptSale['main_picture_url'] }}"  alt="{{ $descriptSale['title_product'] }}"/>
                                @elseif(isset($descriptSale['upload_main_picture']))
                                    <img style="max-width: 270px; max-height: 320px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptSale['upload_main_picture'] }}" alt="{{ $descriptSale['title_product'] }}" />
                                @else
                                    <img style="max-width: 270px; max-height: 320px;" src="/storage/common_pictures/noimage.jpg" alt="{{ $descriptSale['title_product'] }}" />
                                @endif

                                <div class="image_overlay"></div>
                                <div class="view_gallery">Галерия</div>
                                <a href="/store/{{ $product->id }}">
                                    <div class="view_product">Виж подробности
                                    </div>
                                </a>

                                <div class="stats">

                                    <div class="stats-container">
                                        <span class="product_name" title="{{ $descriptSale['title_product'] }}">{{ $descriptSale['title_product'] }}</span>
                                        <br/>
                                            <span class="product_price">
                                                <div>
                                                    <span class="price">

                                                        <strong>
                                                            {{ isset($descriptSale['price']) ? $descriptSale['price'] : '' }}
                                                            {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                                                        </strong>
                                                     </span>

                                                    @if(isset($descriptSale['old_price']))
                                                        <span class="price_old">
                                                            <del>
                                                                {{ $descriptSale['old_price'] }}
                                                                {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                                                            </del>
                                                        </span>
                                                    @endif
                                                </div>
                                            </span>
                                        <br/>

                                        <div class="product-options">
                                            <strong></strong>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-back">
                                <div class="shadow"></div>
                                <div class="carousel">
                                    <ul class="carousel-container">
                                        @if (isset($descriptSale['main_picture_url']))
                                            <li><img style="max-width: 270px; max-height: 320px;" src="{{ $descriptSale['main_picture_url'] }}"  alt="{{ $descriptSale['title_product'] }}"/></li>
                                        @elseif(isset($descriptSale['upload_main_picture']))
                                            <li><img style="max-width: 270px; max-height: 320px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptSale['upload_main_picture'] }}" alt="{{ $descriptSale['title_product'] }}" /></li>
                                        @else
                                            <li><img style="max-width: 270px; max-height: 320px;" src="/storage/common_pictures/noimage.jpg" alt="{{ $descriptSale['title_product'] }}" /></li>
                                        @endif

                                        @if(isset($descriptSale['gallery']))
                                            @foreach( $descriptSale['gallery'] as $type_pictures)
                                                @foreach($type_pictures as $key_picture => $picture)
                                                    <li>
                                                        @if($key_picture == 'upload_picture')
                                                            <img style="max-width: 270px; max-height: 320px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $type_pictures[$key_picture] }}">
                                                        @else
                                                            <img style="max-width: 270px; max-height: 320px;" src="{{ $type_pictures[$key_picture] }}">
                                                        @endif
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        @endif

                                    </ul>
                                    <div class="arrows-perspective">
                                        <div class="carouselPrev">
                                            <div class="y"></div>
                                            <div class="x"></div>
                                        </div>
                                        <div class="carouselNext">
                                            <div class="y"></div>
                                            <div class="x"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flip-back">
                                    <div class="cy"></div>
                                    <div class="cx"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="slider-item-content">
    @if(count($productsBestSeller) > 0)

        <h1 class="slider_titles">Най-продаван</h1>

        <div class="owl-carousel" id="slider_product_sale">
            @foreach($productsBestSeller as $product)
                <?php $descriptSale = json_decode($product->description, true); ?>
                <div class="item-product-slider">

                    <div class="product">
                        <div class="ribbon-wrapper-1">
                            <div class="ribbon-1" style="z-index: 100; font-size: 12px; background-color: #6daaab;">Най-продаван</div>
                        </div>
                        <div class="info-large">
                            <h4 title="{{ $descriptSale['title_product'] }}" >{{ $descriptSale['title_product'] }}</h4>
                            <div class="sku">
                                PRODUCT SKU: <strong>89356</strong>
                            </div>

                            <div class="price-big">
                                        <span>
                                           @if(isset($descriptSale['old_price']))
                                                {{ $descriptSale['old_price'] }}
                                                {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                                            @endif
                                        </span>
                                {{ isset($descriptSale['price']) ? $descriptSale['price'] : '' }}
                                {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                            </div>
                        </div>
                        <div class="make3D">

                            <div class="product-front">

                                @if (isset($descriptSale['main_picture_url']))
                                    <img style="max-width: 270px; max-height: 320px;" src="{{ $descriptSale['main_picture_url'] }}"  alt="{{ $descriptSale['title_product'] }}"/>
                                @elseif(isset($descriptSale['upload_main_picture']))
                                    <img style="max-width: 270px; max-height: 320px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptSale['upload_main_picture'] }}" alt="{{ $descriptSale['title_product'] }}" />
                                @else
                                    <img style="max-width: 270px; max-height: 320px;" src="/storage/common_pictures/noimage.jpg" alt="{{ $descriptSale['title_product'] }}" />
                                @endif

                                <div class="image_overlay"></div>
                                <div class="view_gallery">Галерия</div>
                                <a href="/store/{{ $product->id }}">
                                    <div class="view_product">Виж подробности
                                    </div>
                                </a>

                                <div class="stats">

                                    <div class="stats-container">
                                        <span class="product_name" title="{{ $descriptSale['title_product'] }}">{{ $descriptSale['title_product'] }}</span>
                                        <br/>
                                            <span class="product_price">
                                                <div>
                                                    <span class="price">

                                                        <strong>
                                                            {{ isset($descriptSale['price']) ? $descriptSale['price'] : '' }}
                                                            {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                                                        </strong>
                                                     </span>

                                                    @if(isset($descriptSale['old_price']))
                                                        <span class="price_old">
                                                            <del>
                                                                {{ $descriptSale['old_price'] }}
                                                                {{ isset($descriptSale['currency']) ? $descriptSale['currency'] : '' }}
                                                            </del>
                                                        </span>
                                                    @endif
                                                </div>
                                            </span>
                                        <br/>

                                        <div class="product-options">
                                            <strong></strong>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-back">
                                <div class="shadow"></div>
                                <div class="carousel">
                                    <ul class="carousel-container">
                                        @if (isset($descriptSale['main_picture_url']))
                                            <li><img style="max-width: 270px; max-height: 320px;" src="{{ $descriptSale['main_picture_url'] }}"  alt="{{ $descriptSale['title_product'] }}"/></li>
                                        @elseif(isset($descriptSale['upload_main_picture']))
                                            <li><img style="max-width: 270px; max-height: 320px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptSale['upload_main_picture'] }}" alt="{{ $descriptSale['title_product'] }}" /></li>
                                        @else
                                            <li><img style="max-width: 270px; max-height: 320px;" src="/storage/common_pictures/noimage.jpg" alt="{{ $descriptSale['title_product'] }}" /></li>
                                        @endif

                                        @if(isset($descriptSale['gallery']))
                                            @foreach( $descriptSale['gallery'] as $type_pictures)
                                                @foreach($type_pictures as $key_picture => $picture)
                                                    <li>
                                                        @if($key_picture == 'upload_picture')
                                                            <img style="max-width: 270px; max-height: 320px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $type_pictures[$key_picture] }}">
                                                        @else
                                                            <img style="max-width: 270px; max-height: 320px;" src="{{ $type_pictures[$key_picture] }}">
                                                        @endif
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        @endif

                                    </ul>
                                    <div class="arrows-perspective">
                                        <div class="carouselPrev">
                                            <div class="y"></div>
                                            <div class="x"></div>
                                        </div>
                                        <div class="carouselNext">
                                            <div class="y"></div>
                                            <div class="x"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flip-back">
                                    <div class="cy"></div>
                                    <div class="cx"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>


<!-- script -->
<script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>

<script>

    $(document).ready(function(){

        $(".largeGrid").click(function(){
            $(this).find('a').addClass('active');
            $('.smallGrid a').removeClass('active');

            $('#grid').find('.product_content').removeClass( "col-md-4" );
            //$( "p" ).removeClass( "myClass noClass" ).addClass( "yourClass" );

            $('.product').addClass('large').each(function(){
            });
            setTimeout(function(){
                $('.info-large').show();
            }, 200);
            setTimeout(function(){

                $('.view_gallery').trigger("click");
            }, 400);

            return false;
        });

        $(".smallGrid").click(function(){
            $(this).find('a').addClass('active');
            $('.largeGrid a').removeClass('active');
            $('#grid').find('.product_content').addClass( "col-md-4" );
            //$( "p" ).removeClass( "myClass noClass" ).addClass( "yourClass" );

            $('div.product').removeClass('large');
            $(".make3D").removeClass('animate');
            $('.info-large').fadeOut("fast");
            setTimeout(function(){
                $('div.flip-back').trigger("click");
            }, 400);
            return false;
        });

        $(".smallGrid").click(function(){
            $('.product').removeClass('large');
            return false;
        });

        $('.colors-large a').click(function(){return false;});


        $('.product').each(function(i, el){

            // Lift card and show stats on Mouseover
            $(el).find('.make3D').hover(function(){
                $(this).parent().css('z-index', "20");
                $(this).addClass('animate');
                $(this).find('div.carouselNext, div.carouselPrev').addClass('visible');
                $(this).find('.view_product').css('opacity', '1')
            }, function(){
                $(this).removeClass('animate');
                $(this).parent().css('z-index', "1");
                $(this).find('div.carouselNext, div.carouselPrev').removeClass('visible');
                $(this).find('.view_product').css('opacity', '0')
            });

            // Flip card to the back side
            $(el).find('.view_gallery').click(function(){

                $(el).find('div.carouselNext, div.carouselPrev').removeClass('visible');
                $(el).find('.make3D').addClass('flip-10');
                setTimeout(function(){
                    $(el).find('.make3D').removeClass('flip-10').addClass('flip90').find('div.shadow').show().fadeTo( 80 , 1, function(){
                        $(el).find('.product-front, .product-front div.shadow').hide();
                    });
                }, 50);

                setTimeout(function(){
                    $(el).find('.make3D').removeClass('flip90').addClass('flip190');
                    $(el).find('.product-back').show().find('div.shadow').show().fadeTo( 90 , 0);
                    setTimeout(function(){
                        $(el).find('.make3D').removeClass('flip190').addClass('flip180').find('div.shadow').hide();
                        setTimeout(function(){
                            $(el).find('.make3D').css('transition', '100ms ease-out');
                            $(el).find('.cx, .cy').addClass('s1');
                            setTimeout(function(){$(el).find('.cx, .cy').addClass('s2');}, 100);
                            setTimeout(function(){$(el).find('.cx, .cy').addClass('s3');}, 200);
                            $(el).find('div.carouselNext, div.carouselPrev').addClass('visible');
                        }, 100);
                    }, 100);
                }, 150);
            });

            // Flip card back to the front side
            $(el).find('.flip-back').click(function(){

                $(el).find('.make3D').removeClass('flip180').addClass('flip190');
                setTimeout(function(){
                    $(el).find('.make3D').removeClass('flip190').addClass('flip90');

                    $(el).find('.product-back div.shadow').css('opacity', 0).fadeTo( 100 , 1, function(){
                        $(el).find('.product-back, .product-back div.shadow').hide();
                        $(el).find('.product-front, .product-front div.shadow').show();
                    });
                }, 50);

                setTimeout(function(){
                    $(el).find('.make3D').removeClass('flip90').addClass('flip-10');
                    $(el).find('.product-front div.shadow').show().fadeTo( 100 , 0);
                    setTimeout(function(){
                        $(el).find('.product-front div.shadow').hide();
                        $(el).find('.make3D').removeClass('flip-10').css('transition', '100ms ease-out');
                        $(el).find('.cx, .cy').removeClass('s1 s2 s3');
                    }, 100);
                }, 150);

            });

            makeCarousel(el);
        });

        $('.add-cart-large').each(function(i, el){
            $(el).click(function(){
                var carousel = $(this).parent().parent().find(".carousel-container");
                var img = carousel.find('img').eq(carousel.attr("rel"))[0];
                var position = $(img).offset();
                console.log(position);

                var productName = $(this).parent().find('h4').get(0).innerHTML;

                $("body").append('<div class="floating-cart"></div>');
                var cart = $('div.floating-cart');
                $("<img width='20' height='20' src='"+img.src+"' class='floating-image-large' />").appendTo(cart);

                $(cart).css({'top' : position.top + 'px', "right" : position.right + 'px'}).fadeIn("slow").addClass('moveToCart');
                setTimeout(function(){$("body").addClass("MakeFloatingCart");}, 800);

                setTimeout(function(){
                    $('div.floating-cart').remove();
                    $("body").removeClass("MakeFloatingCart");


                    var cartItem = "<div class='cart-item'><div class='img-wrap'><img src='"+img.src+"' alt='' /></div><span>"+productName+"</span><strong>$39</strong><div class='cart-item-border'></div><div class='delete-item'></div></div>";

                    $("#cart .empty").hide();
                    $("#cart").append(cartItem);
                    $("#checkout").fadeIn(500);

                    $("#cart .cart-item").last()
                            .addClass("flash")
                            .find(".delete-item").click(function(){
                                $(this).parent().fadeOut(300, function(){
                                    $(this).remove();
                                    if($("#cart .cart-item").size() == 0){
                                        $("#cart .empty").fadeIn(500);
                                        $("#checkout").fadeOut(500);
                                    }
                                })
                            });
                    setTimeout(function(){
                        $("#cart .cart-item").last().removeClass("flash");
                    }, 10 );

                }, 1000);


            });
        });

        /* ----  Image Gallery Carousel   ---- */
        function makeCarousel(el){


            var carousel = $(el).find('.carousel ul');
            var carouselSlideWidth = 315;
            var carouselWidth = 0;
            var isAnimating = false;
            var currSlide = 0;
            $(carousel).attr('rel', currSlide);

            // building the width of the casousel
            $(carousel).find('li').each(function(){
                carouselWidth += carouselSlideWidth;
            });
            $(carousel).css('width', carouselWidth);

            // Load Next Image
            $(el).find('div.carouselNext').on('click', function(){
                var currentLeft = Math.abs(parseInt($(carousel).css("left")));
                var newLeft = currentLeft + carouselSlideWidth;
                if(newLeft == carouselWidth || isAnimating === true){return;}
                $(carousel).css({'left': "-" + newLeft + "px",
                    "transition": "300ms ease-out"
                });
                isAnimating = true;
                currSlide++;
                $(carousel).attr('rel', currSlide);
                setTimeout(function(){isAnimating = false;}, 300);
            });

            // Load Previous Image
            $(el).find('div.carouselPrev').on('click', function(){
                var currentLeft = Math.abs(parseInt($(carousel).css("left")));
                var newLeft = currentLeft - carouselSlideWidth;
                if(newLeft < 0  || isAnimating === true){return;}
                $(carousel).css({'left': "-" + newLeft + "px",
                    "transition": "300ms ease-out"
                });
                isAnimating = true;
                currSlide--;
                $(carousel).attr('rel', currSlide);
                setTimeout(function(){isAnimating = false;}, 300);
            });
        }

        $('.sizes a span, .categories a span').each(function(i, el){
            $(el).append('<span class="x"></span><span class="y"></span>');

            $(el).parent().on('click', function(){
                if($(this).hasClass('checked')){
                    $(el).find('.y').removeClass('animate');
                    setTimeout(function(){
                        $(el).find('.x').removeClass('animate');
                    }, 50);
                    $(this).removeClass('checked');
                    return false;
                }

                $(el).find('.x').addClass('animate');
                setTimeout(function(){
                    $(el).find('.y').addClass('animate');
                }, 100);
                $(this).addClass('checked');
                return false;
            });
        });

        $('.add_to_cart').click(function(){
            var productCard = $(this).parent();
            var position = productCard.offset();
            var productImage = $(productCard).find('img').get(0).src;
            var productName = $(productCard).find('.product_name').get(0).innerHTML;

            var kolichka = $('#new-view-cart').offset();

            console.log(kolichka.top);

            $("body").append('<div class="floating-cart"></div>');
            var window_width = $( window ).width();
            var cart = $('div.floating-cart');
            productCard.clone().appendTo(cart);
            $(cart).css({'top' : position.top + 'px', "left" : position.left + 'px'}).fadeIn("slow").addClass('moveToCart').animate({left: kolichka.left + 'px', top: '-10px'});;
            setTimeout(function(){$("body").addClass("MakeFloatingCart").css('left', '2000px');}, 800);
            setTimeout(function(){
                $('div.floating-cart').remove();
                $("body").removeClass("MakeFloatingCart");


                var cartItem = "<div class='cart-item'><div class='img-wrap'><img src='"+productImage+"' alt='' /></div><span>"+productName+"</span><strong>$39</strong><div class='cart-item-border'></div><div class='delete-item'></div></div>";

                $("#cart .empty").hide();
                $("#cart").append(cartItem);
                $("#checkout").fadeIn(500);

                $("#cart .cart-item").last()
                        .addClass("flash")
                        .find(".delete-item").click(function(){
                            $(this).parent().fadeOut(300, function(){
                                $(this).remove();
                                if($("#cart .cart-item").size() == 0){
                                    $("#cart .empty").fadeIn(500);
                                    $("#checkout").fadeOut(500);
                                }
                            })
                        });
                setTimeout(function(){
                    $("#cart .cart-item").last().removeClass("flash");
                }, 10 );

            }, 1000);
        });
    });
</script>