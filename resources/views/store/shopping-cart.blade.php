@extends('layouts.app')

@section('content')
    <style>
        svg {
            display:block;
            position: absolute;
            height:8%;
            width:8%;
            margin: 0;
            padding: 0;
            border: none;
            overflow: hidden;
        }
    </style>

    <!-- Преизчисляване на поръчката при смяна на количеството, Изриване на продукт -->

        @if(isset($products))
        <!-- Cart Start -->
        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Продукт</th>
                            <th></th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Общо</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="align-middle">
                        @foreach($products as $product)
                            <?php $descriptions = json_decode($product['item']->description, true); ?>
                            <tr class="cart-items">
                                <td class="align-middle">
                                    @if (isset($descriptions['canvas_content_svg']))
                                        <div style="width: 48px; height: 48px;">{!! json_decode($descriptions['canvas_content_svg'], false) !!}</div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="/store/{{ $product['item']->id}}" target="_blank">{{ $descriptions['title_product'] }}</a>
                                </td>
                                <td class="align-middle row-price" data-content="{{ number_format($descriptions['price'], 2) }}">{{ number_format($descriptions['price'], 2) }} {{ $descriptions['currency'] }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" >
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center product-qty" value="{{ $product['qty'] }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle item-total-price">{{ number_format($product['qty'] * $descriptions['price'], 2) }}  {{ $descriptions['currency'] }}</td>
                                <td class="align-middle remove">
                                <button class="btn btn-sm btn-primary remove-item-button" style="background-color: #df5320; color: whitesmoke;">
                                    <i class="fa fa-times"></i>
                                    <input id="id-product" type="hidden" value="{{ $product['item']->id }}"/>
                                </button>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <form class="mb-5" action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-4" placeholder="Coupon Code">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Apply Coupon</button>
                            </div>
                        </div>
                    </form>
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Информация за поръчката</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Общ брой:</h6>
                                <h6 class="font-weight-medium" id="basket-total-qty" data-content="{{ $totalQuantity }}">{{ $totalQuantity }} бр.</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                @if(isset($freeShipping))
                                    <h6 class="font-weight-medium">Безплатна доставка</h6>
                                @else
                                    <h6 class="font-weight-medium">Куриерската услуга не е включена в цената и е за сметка на купувача.</h6>
                                    <!--<h6 class="font-weight-medium">{{ $totalPrice }} лв.</h6>-->
                                @endif

                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Общо:</h5>
                                <h5 class="font-weight-bold" id="basket-total-price" data-content="{{ $totalPrice }}">{{ $totalPrice }} лв.</h5>
                            </div>
                            <button class="btn btn-block btn-primary my-3 py-3" onclick="location.href='/checkout'" >Приключване на поръчката</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
        @else
            <div class="page-empty-cart">
                @include('partials.old_empty_cart')
                <div>
                    <a class="btn btn-info" href="/">Към началната страница </a>
                </div>
                <h3>Количка за пазаруване е празна!</h3>
            </div>
        @endif

@endsection