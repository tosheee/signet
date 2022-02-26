<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/casual-t-shirt-.png"/>
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE]>
    <script type="text/javascript" src="{{ asset('js/designer_js/excanvas.js')}}"></script><![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/designer_js/fabric.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/designer_js/tshirtEditor.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/designer_js/jquery.miniColors.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/designer_js/html5.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/designer_js/loading.js')}}"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/eligrey/FileSaver.js/5733e40e5af936eb3f48554cf6a8a7075d71d18a/FileSaver.js"></script>

    <!-- Le styles -->
    <link href="{{ asset('css/designer_css/jquery.miniColors.css')}}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('css/designer_css/bootstrap.min.css')}}" rel="stylesheet">
    <link href=" {{ asset('css/designer_css/loader.css')}}" rel="stylesheet">
    <link href="{{ asset('css/designer_css/bootstrap-responsive.min.css')}}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script type="text/javascript"></script>

    <style type="text/css">
        .footer {
            padding: 70px 0;
            margin-top: 70px;
            border-top: 1px solid #E5E5E5;
            background-color: whiteSmoke;
        }

        body {
            padding-top: 60px;
        }

        .color-preview {
            border: 1px solid #CCC;
            margin: 2px;
            zoom: 1;
            vertical-align: top;
            display: inline-block;
            cursor: pointer;
            overflow: hidden;
            width: 20px;
            height: 20px;
        }

        .rotate {
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            /* filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1.5); */
            -ms-transform: rotate(90deg);
        }

        .Arial {
            font-family: "Arial";
        }

        .Helvetica {
            font-family: "Helvetica";
        }

        .MyriadPro {
            font-family: "Myriad Pro";
        }

        .Delicious {
            font-family: "Delicious";
        }

        .Verdana {
            font-family: "Verdana";
        }

        .Georgia {
            font-family: "Georgia";
        }

        .Courier {
            font-family: "Courier";
        }

        .ComicSansMS {
            font-family: "Comic Sans MS";
        }

        .Impact {
            font-family: "Impact";
        }

        .Monaco {
            font-family: "Monaco";
        }

        .Optima {
            font-family: "Optima";
        }

        .HoeflerText {
            font-family: "Hoefler Text";
        }

        .Plaster {
            font-family: "Plaster";
        }

        .Engagement {
            font-family: "Engagement";
        }

        .img-polaroid {
            padding: 0;
            margin: 0;
            border: 2px solid transparent;
            max-height: 92px;
            max-width: 92px;
            min-height: 92px;
            min-width: 92px;

        }

        .img-polaroid:hover {
            cursor: pointer;
            border-color: #00a5f7;
        }

        .tt {
            margin-right: 4px;
        }
    </style>
</head>

<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <a class="brand" href="">Text</a>


            <ul class="nav navbar-nav">
                @foreach($categoriesButtonsName as $categoryButton)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false" title="{{ $categoryButton->name }}">{{ $categoryButton->name }}<i class="fa fa-angle-down ml-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-left">
                            @foreach($subCategoriesButtonsName as $subCategoryButton)
                                @if ($subCategoryButton->category_id == $categoryButton->id)
                                    <li><a href="/store/search?sub_category={{ $subCategoryButton->identifier }}" title="{{ $subCategoryButton->name }}">{{ $subCategoryButton->name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach






                <script>
                    //$(document).ready(function(){
                    //  $('#store-button').click(function(){
                    //    window.location.href ='/store'
                    // });
                    //});
                </script>
                @foreach($pagesButtonsRender as $pageButton)
                    <li><a href="/page?show={{ $pageButton->url_page }}" class="dropdown-toggle"  data-hover="dropdown" data-close-others="false" title="{{ $pageButton->name_page }}">{{ $pageButton->name_page }}</a></li>
                @endforeach




            </ul>



        </div>
    </div>

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
</div>

@yield('content')


</body>
</html>
