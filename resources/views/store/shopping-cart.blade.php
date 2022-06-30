@extends('layouts.app')

@section('content')

    <div class="col-md-2" id="vertical-nav-bar">
        @include('partials.old_vertical_navigation')
    </div>

    <script>
        $('#new-view-cart').hide();
        $('#menu-scroll-cart').hide();
    </script>

    <br/><br/><br/>
    <div class="col-sm-10">
        @if(isset($products))
            <div class="basket">

                <div class="basket-module">
                    <h3>Количка за пазаруване</h3>
                </div>

                <div class="basket-labels">
                    <ul>
                        <li class="item-shopping-cart item-heading">Продукт</li>
                        <li class="price-shopping-cart">Цена</li>
                        <li class="quantity-shopping-cart">Количество</li>
                        <li class="subtotal">Общо</li>
                    </ul>
                </div>

                @foreach($products as $product)
                    <?php $descriptions = json_decode($product['item']->description, true); ?>

                    <div class="basket-product">
                        <div class="item-shopping-cart">
                            <div class="product-image">
                                @if (isset($descriptions['main_picture_url']))
                                    <a class="thumbnail pull-left" href="/store/{{ $product['item']->id}}">
                                        <img   src="{{ $descriptions['main_picture_url'] }}" alt="pic" />
                                    </a>
                                @elseif(isset($descriptions['upload_main_picture']))
                                    <a class="thumbnail pull-left" href="/store/{{ $product['item']->id }}">
                                        <img  src="/storage/upload_pictures/{{ $product['item']->id }}/{{ $descriptions['upload_main_picture'] }}" alt="pic" />
                                    </a>
                                @else
                                    <a class="thumbnail pull-left" href="/store/{{ $product['item']->id }}">
                                        <img  src="/storage/common_pictures/noimage.jpg" alt="pic" />
                                    </a>
                                @endif
                            </div>

                            <div class="product-details-shopping-cart">
                                <h5><a href="/store/{{ $product['item']->id }}" target="_blank">{{ $descriptions['title_product'] }}</a></h5>
                                <p><strong></strong></p>
                                <p>Продуктов код: {{ $descriptions['article_id'] }}</p>
                            </div>

                        </div>

                        <div class="price-shopping-cart"><strong>{{ number_format($descriptions['price'], 2) }}</strong> {{ $descriptions['currency'] }}</div>

                        <div class="quantity-shopping-cart">
                            <input type="number" value="{{ $product['qty'] }}" min="1" class="quantity-field">
                            <input id="id-product" type="hidden" name="q" value="{{ $product['item']['id'] }}"/>
                        </div>

                        <div class="subtotal">{{ number_format($product['qty'] * $descriptions['price'], 2) }}  {{ $descriptions['currency'] }}</div>

                        <div class="remove">
                            <button type="button" class="remove-item-button" style="width:40%; background-color: #ff4208; border-color:#ff4208; " title="Премахване на продукт">
                                <i class="fa fa-close" style="color: #ffffff"></i>
                                <input id="id-product" type="hidden" value="{{ $product['item']->id }}"/>
                            </button>

                        </div>

                    </div>
                @endforeach

            </div>
            <aside>
            <div class="summary">
                <div class="summary-total-items" style="font-size: 1.2em;">Информация за поръчката<span class="total-items"></span></div>

                <div class="summary-subtotal">
                    <div class="subtotal-title">Общ брой:</div>
                    <div class="subtotal-value final-value" id="basket-subtotal">{{ $totalQuantity }} бр.</div>
                    <div class="summary-promo hide">
                        <div class="promo-title">Promotion</div>
                        <div class="promo-value final-value" id="basket-promo"></div>
                    </div>
                </div>

                <div class="summary-delivery">
                    Куриерската услуга не е включена в цената и е за сметка на купувача.
                </div>

                <div class="summary-total">
                    <div class="total-title">Общо:</div>
                    <div class="total-value final-value" id="basket-total">{{ $totalPrice }} лв.</div>
                </div>

                <div class="summary-checkout">
                    <button class="checkout-cta" onclick="location.href='/checkout'">Продължи</button>
                </div>
            </div>
        </aside>
        @else
            <div class="page-empty-cart">
                @include('partials.old_empty_cart')
                <div>
                    <a class="btn btn-info" href="/">Към началната страница </a>
                </div>
                <h3>Количка за пазаруване е празна!</h3>
            </div>
        @endif
    </div>

@endsection