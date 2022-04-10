@extends('layouts.app')

@section('content')

<div class="container-fluid">
        <div class="col-md-2" id="vertical-nav-bar" style="width: 22%">
            @include('partials.vertical_navigation')
        </div>

    <div id="grid">
        <div class="col-md-9">
            @if(count($products) > 0 )
            <div id="grid-selector">
                @if ( count($products) > 9)
                    Намерени 1–9 на <strong> {{ count($products) }} </strong> продукта
                @else
                    Намерени <strong> {{ count($products) }} </strong> продукта
                @endif

                <div id="grid-menu">
                    View:
                    <ul>
                        <li class="largeGrid"><a href="#"><i class="fa fa-th-list"></i></a></li>
                        <li class="smallGrid"><a class="active" href="#"><i class="fa fa-th"></i></a></li>
                    </ul>
                </div>
            </div>

        <!-- end col-md-10-->
            <div class="row">
                @foreach($products as $product)
                    <?php $descriptions = json_decode($product->description, true); ?>
                        <div class="col-md-3 product">

                            @if ($product->sale == 1)
                                <div class="ribbon-wrapper-1">
                                    <div class="ribbon-1" style="z-index: 100; font-size: 12px;  background-color: #ff3f0e;">Разпродажба</div>
                                </div>
                            @elseif($product->recommended == 1)
                                <div class="ribbon-wrapper-1">
                                    <div class="ribbon-1" style="z-index: 100; font-size: 12px;  background-color: #ff99a1;">Препоръчан</div>
                                </div>

                            @elseif($product->best_sellers == 1)
                                <div class="ribbon-wrapper-1">
                                    <div class="ribbon-1" style="z-index: 100; font-size: 12px;   background-color: #6daaab;">Най-продаван</div>
                                </div>
                            @endif

                            <div class="info-large">
                                <h4 title="{{ $descriptions['title_product'] }}" >{{ $descriptions['title_product'] }}</h4>
                                <div class="sku">
                                    PRODUCT SKU: <strong>89356</strong>
                                </div>

                                <div class="price-big">
                                        <span>
                                           @if(isset($descriptions['old_price']))
                                                {{ $descriptions['old_price'] }}
                                                {{ isset($descriptions['currency']) ? $descriptions['currency'] : '' }}
                                            @endif
                                        </span>
                                    {{ isset($descriptions['price']) ? $descriptions['price'] : '' }}
                                    {{ isset($descriptions['currency']) ? $descriptions['currency'] : '' }}
                                </div>

                                <!--
                                    <h3>COLORS</h3>
                                    <div class="colors-large">
                                        <ul>
                                            <li><a href="" style="background:#222"><span></span></a></li>
                                            <li><a href="" style="background:#6e8cd5"><span></span></a></li>
                                            <li><a href="" style="background:#f56060"><span></span></a></li>
                                            <li><a href="" style="background:#44c28d"><span></span></a></li>
                                        </ul>
                                    </div>

                                    <h3>SIZE</h3>
                                    <div class="sizes-large">
                                       <p> {{ isset($descriptions['short_description']) ? $descriptions['short_description'] : '' }}</p>
                                    </div>
-->
                            @if ($descriptions['product_status']!= 'Не е наличен')
                                <button class="add-cart-large add-product-button">
                                    Добави
                                    <i class="fa fa-shopping-cart" ></i>

                                    <?php if(Session::has('cart'))
                                    {
                                        $oldCart = Session::get('cart');
                                        if(isset($oldCart->items[$product->id]['qty']))
                                        {
                                            $product_qty = $oldCart->items[$product->id]['qty'];
                                        }

                                    }
                                    ?>

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
                                <button class="add_to_cart" style="background-color: #ff99a1" disabled title="Очаква се доставка">Очаквайте</button>
                            @endif

                            </div>
                            <div class="make3D">
                                <div class="product-front">
                                    <div class="shadow"></div>

                                    @if (isset($descriptions['main_picture_url']))
                                        <img style="max-width: 270px; max-height: 320px;" src="{{ $descriptions['main_picture_url'] }}"  alt="{{ $descriptions['title_product'] }}"/>
                                    @elseif(isset($descriptions['upload_main_picture']))
                                        <img style="max-width: 270px; max-height: 320px;" src="{{ asset('product_images/') }}/{{ $product->id }}/{{ $descriptions['upload_main_picture'] }}" alt="{{ $descriptions['title_product'] }}" />
                                    @else
                                        <img style="max-width: 400px; max-height: 450px;" src="{{ asset('product_images/') }}noimage.jpg" alt="{{ $descriptions['title_product'] }}" />
                                    @endif

                                    <div class="image_overlay"></div>


                                    @if ($descriptions['product_status']!= 'Не е наличен')
                                         <button class="add-product-button add_to_cart" title="Добави в количката" >
                                            Добави
                                            <i class="fa fa-shopping-cart" ></i>
                                             <?php if(Session::has('cart'))
                                            {
                                                $oldCart = Session::get('cart');
                                                if(isset($oldCart->items[$product->id]['qty']))
                                                {
                                                    $product_qty = $oldCart->items[$product->id]['qty'];
                                                }
                                            }
                                            ?>
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
                                        <button class="add-product-button add_to_cart" style="background-color: #ff99a1" disabled title="Очаква се доставка">Очаквайте</button>
                                    @endif

                                    <div class="view_gallery">Галерия</div>
                                    <a href="/store/{{ $product->id }}">
                                        <div class="view_product">Виж подробности
                                        </div>
                                    </a>

                                    <div class="stats">
                                        <div class="stats-container">

                                            <span class="product_name" title="{{ $descriptions['title_product'] }}">{{ $descriptions['title_product'] }}</span>
                                            <br/>
                                                <span class="product_price">
                                                    <div>
                                                        <span class="price">

                                                            <strong>
                                                            {{ isset($descriptions['price']) ? $descriptions['price'] : '' }}
                                                            {{ isset($descriptions['currency']) ? $descriptions['currency'] : '' }}
                                                            </strong>
                                                         </span>

                                                        @if(isset($descriptions['old_price']))
                                                            <span class="price_old">
                                                                <del>
                                                                    {{ $descriptions['old_price'] }}
                                                                    {{ isset($descriptions['currency']) ? $descriptions['currency'] : '' }}
                                                                </del>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </span>
                                            <br/>

                                            <div class="product-options">
                                                <strong></strong>
                                                    <span>
                                                        @foreach($subCategories as $subCategory)
                                                            @if($product->sub_category_id == $subCategory->id)
                                                                {{ $subCategory->name }}
                                                            @endif
                                                        @endforeach
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-back">
                                    <div class="shadow"></div>
                                    <div class="carousel">
                                        <ul class="carousel-container">
                                            @if (isset($descriptions['main_picture_url']))
                                                <li><img src="{{ $descriptions['main_picture_url'] }}"  alt="{{ $descriptions['title_product'] }}"/></li>
                                            @elseif(isset($descriptions['upload_main_picture']))
                                                <li><img src="{{ asset('product_images/') }}/{{ $product->id }}/{{ $descriptions['upload_main_picture'] }}" alt="{{ $descriptions['title_product'] }}" /></li>
                                            @else
                                                <li><img src="{{ asset('product_images/') }}noimage.jpg" alt="no image" alt="{{ $descriptions['title_product'] }}"/></li>
                                            @endif

                                            @if(isset($descriptions['gallery']))
                                                @foreach( $descriptions['gallery'] as $type_pictures)
                                                    @foreach($type_pictures as $key_picture => $picture)
                                                        <li>
                                                            @if($key_picture == 'upload_picture')
                                                                <img src="{{ asset('product_images/') }}/{{ $product->id }}/{{ $type_pictures[$key_picture] }}">
                                                            @else
                                                                <img src="{{ $type_pictures[$key_picture] }}">
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
                @endforeach
            </div>
        </div>
        <!-- end col-md-10-->

        <div style="margin-left: 10%">
            @if( method_exists($products,'links') )
                {{  $products ->links() }}
            @endif
        </div>
        @else
            <div style="text-align: center;">
                Резултати от търсенето: <p style="color: #ff7a11;font-size: large;"><h2>Няма намерени резултати!</h2></p>
                <div style="margin-top: -30%">
                <script>//setTimeout(function(){ window.location.href = '/'; }, 3000); </script>
                </div>
            </div>
        @endif
        </div>
</div>


<script>
    $(window).resize(function () {
        var viewportWidth = $(window).width();

        if (viewportWidth < 800) {
            $("#vertical-nav-bar").css('display', 'none')
        }else{
            $("#vertical-nav-bar").css('display', 'inline-block')
        }
    });
</script>
@endsection