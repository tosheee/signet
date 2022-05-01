<nav id="menu-horizontal-top" class="topBar">
    <div class="container">

        <ul class="list-inline pull-left">
            <li>
                <i class="fa fa-phone" aria-hidden="true"></i>  {{ isset($siteViewInformation->phone_com) ? $siteViewInformation->phone_com : '0888 888 888'}}  |
                <i class="fa fa-envelope-open" aria-hidden="true"></i>   {{ isset($siteViewInformation->phone_com) ? $siteViewInformation->email_com : 'example@com.com' }}
            </li>
        </ul>

        <ul class="topBarNav  pull-right">

            @foreach($pagesButtonsRender as $pageButton)
                <li ><a href="/page?show={{ $pageButton->url_page }}" class="dropdown-toggle"  data-hover="dropdown" data-close-others="false" style="color: #f2f7ff;">{{ $pageButton->name_page }}</a></li>
            @endforeach

            <li class="dropdown">
                <ul class="dropdown-menu w-100" role="menu"></ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle h-top-nav-dropdown" data-toggle="dropdown" data-hover="dropdown" data-close-others="false"> <i class="fa fa-user mr-5"></i><span class="hidden-xs">Профил<i class="fa fa-angle-down ml-5"></i></span> </a>
                <ul class="dropdown-menu w-150" role="menu">
                    @if (Auth::guest())
                        <li><a class="top-bar-user-buttons"href="{{ route('login') }}">Вход</a></li>
                        <li><a class="top-bar-user-buttons" href="{{ route('register') }}">Регистрация</a></li>
                    @else
                        <li><a href="#">{{ Auth::user()->name }}</a></li>
                        <li><a href="/store/view_user_orders/{{ Auth::user()->id }}">Моите поръчки</a></li>
                        <li>
                            <a class="top-bar-user-buttons" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Изход
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </ul>
            </li>

            <?php
            if(Session::has('cart'))
            {
                $oldCart = Session::get('cart');
                $cart = new App\Cart($oldCart);
                $productsCart = $cart->items;
            }
            ?>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle h-top-nav-dropdown" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">
                    <i class="fa fa-cart-plus mr-5"></i>
                    <span class="hidden-xs">Количка
                        <strong>
                            <sup class="text-primary" style="color: #ffffff;">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</sup>
                        </strong>
                        <i class="fa fa-angle-down ml-5"></i>
                    </span>
                </a>



                <ul class="dropdown-menu cart w-250" role="menu">
                    <li>
                        <div class="cart-items">
                            <ol class="items">
                                @if(isset($productsCart))
                                    @foreach($productsCart as $product)
                                        <?php $descriptions = json_decode($product['item']->description, true); ?>

                                        <li>
                                            @if(isset($descriptions['main_picture_url']))
                                                <a href="#" class="product-image"> <img src="{{ $descriptions['main_picture_url'] }}" class="img-responsive" alt=""> </a>
                                            @elseif(isset($descriptions['upload_main_picture']))
                                                <a href="#" class="product-image"> <img src="/storage/upload_pictures/{{ $product['item']->id }}/{{ $descriptions['upload_main_picture'] }}" class="img-responsive" alt=""> </a>
                                            @else
                                                <a href="#" class="product-image"> <img src="/storage/common_pictures/noimage.jpg" class="img-responsive" alt=""> </a>
                                            @endif

                                            <div class="product-details">
                                                <div class="close-icon">
                                                    <button type="button" class="remove-item-button" style="background: transparent; border-color: #ffffff; border-style: solid;">
                                                        <input id="id-product" type="hidden" value="{{ $product['item']->id }}"/>
                                                        <i class="fa fa-close" style="color: #ff0000"></i>
                                                    </button>
                                                </div>
                                                <p class="product-name">
                                                    <a href="/store/{{ $product['item']->id }}" target="_blank">{{ $descriptions['title_product'] }}</a>
                                                </p>
                                                <p id="cart-content-qty-price">
                                                    <strong id="product-qty">{{ $product['qty']}}</strong> x <span class="price text-primary">{{ $descriptions['price'] }}  {{ $descriptions['currency'] }}</span>
                                                </p>
                                            </div>
                                            <!-- end product-details -->
                                        </li>

                                    @endforeach
                                        <h5 class="cart-bottom-total-price">Общо: {{ $cart->totalPrice }} {{ $descriptions['currency'] }}</h5>
                            </ol>
                        </div>
                    </li>

                    <li>
                        <div class="cart-footer">
                            <a href="{{ route('store.shoppingCart') }}" class="pull-left"><i class="fa fa-cart-plus mr-5"></i> Количка</a>
                            <a href="{{ route('store.checkout') }}" class="pull-right"><i class="fa fa-money" aria-hidden="true"></i> Поръчка</a>
                        </div>

                    </li>

                    @else
                        <li style="text-align: center; color: #ff1018; background-color: #ffffff;">
                            <strong>Вашата количка е празна!</strong>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</nav>