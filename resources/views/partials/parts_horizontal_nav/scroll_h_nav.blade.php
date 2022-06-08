<nav id="menu-scroll" class="navbar navbar-main navbar-default navbar-fixed-top" role="navigation" style="opacity: 1;">
    <div class="container" style="width: 95%" >

        <div class="navbar-header">
            <span ><a href="/"><img style="margin: 5px 2px 0 0" height="40" width="180"  alt=""></a></span>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <!-- Products menu -->

        <div class="collapse navbar-collapse navbar-1" style="margin-top: 0px;">
            <ul class="nav navbar-nav">
                <li class="dropdown megaDropMenu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false" id="store-button">Продукти <i class="fa fa-angle-down ml-5"></i></a>
                    <ul class="dropdown-menu row">
                        @foreach($categoriesButtonsName as $categoryButton)
                            <li class="col-sm-3 col-xs-12">
                                <ul class="list-unstyled">
                                    <li><a href="/store/search?category={{ $categoryButton->id }}" title="{{ $categoryButton->name }}"><strong>{{ $categoryButton->name }}</strong></a></li>
                                    @foreach($subCategoriesButtonsName as $subCategoryButton)
                                        @if ($subCategoryButton->category_id == $categoryButton->id)
                                            <li><a href="/store/search?sub_category={{ $subCategoryButton->identifier }}" title="{{ $subCategoryButton->name }}">{{ $subCategoryButton->name }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>

                @foreach($pagesButtonsRender as $pageButton)
                    <li><a href="/page?show={{ $pageButton->url_page }}" class="dropdown-toggle"  data-hover="dropdown" data-close-others="false" title="{{ $pageButton->name_page }}">{{ $pageButton->name_page }}</a></li>
                @endforeach
            </ul>


<!-- right menu -->


            <ul class="topBarNav nav navbar-nav navbar-right">
            <li class="dropdown"></li>

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

                <?php
                if(Session::has('cart'))
                {
                    $oldCart = Session::get('cart');
                    $cart = new App\Cart($oldCart);
                    $productsCart = $cart->items;
                }
                ?>

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
                                        <h5 class="cart-bottom-total-price">Общо: {{ $cart->totalPrice }} {{ $descriptions['currency'] }} </h5>
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
    </div></div>
</nav>

<script>
    $(window).scroll(function()
    {
        if($(document).scrollTop() > 150)
        {
            $('#menu-scroll').css('visibility', 'visible');
        }
        else
        {
            $('#menu-scroll').css('visibility', 'hidden');
        }
    });

</script>

<script type="text/javascript">
    ! function($, n, e) {
        var o = $();
        $.fn.dropdownHover = function(e) {
            return "ontouchstart" in document ? this : (o = o.add(this.parent()), this.each(function() {
                function t(e) {
                    o.find(":focus").blur(), h.instantlyCloseOthers === !0 && o.removeClass("open"), n.clearTimeout(c), i.addClass("open"), r.trigger(a)
                }
                var r = $(this),
                        i = r.parent(),
                        d = {
                            delay: 100,
                            instantlyCloseOthers: !0
                        },
                        s = {
                            delay: $(this).data("delay"),
                            instantlyCloseOthers: $(this).data("close-others")
                        },
                        a = "show.bs.dropdown",
                        u = "hide.bs.dropdown",
                        h = $.extend(!0, {}, d, e, s),
                        c;
                i.hover(function(n) {
                    return i.hasClass("open") || r.is(n.target) ? void t(n) : !0
                }, function() {
                    c = n.setTimeout(function() {
                        i.removeClass("open"), r.trigger(u)
                    }, h.delay)
                }), r.hover(function(n) {
                    return i.hasClass("open") || i.is(n.target) ? void t(n) : !0
                }), i.find(".dropdown-submenu").each(function() {
                    var e = $(this),
                            o;
                    e.hover(function() {
                        n.clearTimeout(o), e.children(".dropdown-menu").show(), e.siblings().children(".dropdown-menu").hide()
                    }, function() {
                        var t = e.children(".dropdown-menu");
                        o = n.setTimeout(function() {
                            t.hide()
                        }, h.delay)
                    })
                })
            }))
        }, $(document).ready(function() {
            $('[data-hover="dropdown"]').dropdownHover()
        })
    }(jQuery, this);
</script>