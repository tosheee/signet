<!-- Navbar BOTTOM Start -->
<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Продукти</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>

            <nav class="collapse {{ isset($show_sidebar) && $show_sidebar ? 'show' : '' }} position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 2;">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    <!--
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown">Dresses <i class="fa fa-angle-down float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <a href="" class="dropdown-item">Men's Dresses</a>
                            <a href="" class="dropdown-item">Women's Dresses</a>
                            <a href="" class="dropdown-item">Baby's Dresses</a>
                        </div>
                    </div>
                    -->
                    @if(isset($customSideBar))
                        @foreach($customSideBar as $csbItem)
                            @if(isset($categoryId) && $sbItem->id == $categoryId)
                                <a href="/{{$pathLink}}?cat={{$csbItem->identifier}}" class="nav-item nav-link" style="color: #56c56f"><b>{{$csbItem->name}}</b></a>
                            @else
                                <a href="/{{$pathLink}}?cat={{$csbItem->identifier}}" class="nav-item nav-link">{{  $csbItem->name }}</a>
                            @endif
                        @endforeach
                    @else
                        @foreach($sideBarCategories as $sbItem)
                            @if(isset($categoryId) && $sbItem->id == $categoryId)
                                <a href="/store?cat={{$sbItem->identifier}}" class="nav-item nav-link" style="color: #56c56f"><b>{{$sbItem->name}}</b></a>
                            @else
                                <a href="/store?cat={{$sbItem->identifier}}" class="nav-item nav-link">{{  $sbItem->name }}</a>
                            @endif
                        @endforeach
                    @endif
                </div>
            </nav>
        </div>

        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="/" class="nav-item nav-link">Начало</a>
                        <a href="/store" class="nav-item nav-link active">Продукти</a>
                        <a href="/designer" class="nav-item nav-link">Собствен дизайн</a>

                        <!--<a href="detail.html" class="nav-item nav-link">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                <a href="checkout.html" class="dropdown-item">Checkout</a>
                            </div>
                        </div>-->

                        <a href="/contact" class="nav-item nav-link">Контакти</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        @if (Auth::guest())
                            <a href="{{ route('login') }}" class="nav-item nav-link">Вход</a>
                            <a href="{{ route('register') }}" class="nav-item nav-link">Регистрация</a>
                        @else
                            <a href="#" class="nav-item nav-link">{{ Auth::user()->name }}</a>
                            <a href="/store/view_user_orders/{{ Auth::user()->id }}" class="nav-item nav-link">Моите поръчки</a>
                            <a href="{{ route('logout') }}" class="nav-item nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Изход</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </div>
                </div>
            </nav>
            <!-- Slider -->
            @if(isset($show_slider) && isset($slider))
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($slider as $key => $item)
                            <?php $item_img = json_decode($item->slider_img, true)?>

                            <div class="{{$key = 0 ? 'carousel-item active' : 'carousel-item'}}" style="height: 410px;">

                                <img class="img-fluid" src="/storage/images/slider/{{$item->id}}/{{$item_img['images'][0]}}" alt="Image">

                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">{{$item->description ?? ''}}</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{$item->title ?? ''}}</h3>
                                        <a href="{{$item->link ?? ''}}" class="btn btn-light py-2 px-3">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="img/carousel-1.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="img/carousel-2.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- Slider end -->
        </div>
    </div>
</div>
<!-- Navbar BOTTOM End -->