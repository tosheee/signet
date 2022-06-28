@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')
        <br><br>

        <a class="btn btn-default" href="/admin/dashboard/">Обратно</a>
        <input type="button" class="btn btn-info" onclick="printDiv('printableArea')" value="Принтирай офертата" />
        <br/><br/>

        <div id="printableArea" style="font-size: 16px;">

            <div style="text-align: center">
                <h4>ОНЛАЙН МАГАЗИН за</h4>
                
                <h1><img width="280" src="/storage/common_pictures/logo.png" alt=""></h1>
                <i class="fa fa-phone" aria-hidden="true"></i>  {{ isset($siteViewInformation->phone_com) ? $siteViewInformation->phone_com : '0888 888 888'}}   |
                <i class="fa fa-envelope-open" aria-hidden="true"></i> {{ isset($siteViewInformation->phone_com) ? $siteViewInformation->email_com : 'example@com.com' }} </li>
            </div>

            <br/><br/>
            <table class="table table-striped">
                <tr style="color: #ffffff; background-color: #084951">
                    <th >Клиент</th>
                    <th>Адрес</th>
                    <th>Доставка и плащане</th>
                    @if(!empty($order->note))
                        <th>Бележка от клиента</th>
                    @endif
                    @if(!empty($order->company))
                        <th>Фирма</th>
                    @endif
                    @if(!empty($order->bulstat))
                        <th>Булстат</th>
                    @endif
                </tr>

                @if($order->completed_order == 1)
                    <tr style="background-color:#e3efd2">
                @else
                    <tr>
                @endif
                    <td>
                        <i class="fa fa-user mr-5">  -  {{ $order->name}} {{ $order->last_name}}<br>
                        <i class="fa fa-phone" aria-hidden="true"> -  {{ $order->phone }} <br>
                        <i class="fa fa-envelope-open" aria-hidden="true"> - {{ $order->email }} 
                    </td>
                    
                    <td>
                        <?php $address = json_decode($order->address, true); ?>
                        
                        
                           <?php $address = json_decode($order->address, true); ?>
                        @if($order->delivery_method == 'Тo_an_office')
                            <?php $partsOfAddress = explode(",", $address['street_office']); ?>
                            
                            @if(count($partsOfAddress) > 4)
                                <b>Населено място: </b> {{ isset($partsOfAddress[1]) ? $partsOfAddress[1] : '' }} <br>
                                <b>Телефон на офиса: </b>    {{ isset($partsOfAddress[2]) ? $partsOfAddress[2] : '' }}<br>
                                <b>Адрес: </b>    {{ isset($partsOfAddress[3]) ? $partsOfAddress[3] : '' }}<br>
                                <b>Код на офиса: </b>    {{ isset($partsOfAddress[0]) ? $partsOfAddress[0] : '' }}<br>
                            @else
                                <b>Населено място: </b>   {{ isset($address['populated_place']) ? $address['populated_place'] : '' }}<br>
                                <b>Улица на офиса: </b>            {{ isset($address['street_office']) ? $address['street_office'] : '' }}<br>
                                <b>Номер: </b>            {{ isset($address['number_street_office']) ? $address['number_street_office'] : '' }}<br>
                            @endif
                       @else 
                                   
                            <b>Населено място: </b>   {{ isset($address['populated_place']) ? $address['populated_place'] : '' }}<br>
                            <b>Улица: </b>            {{ isset($address['street_office']) ? $address['street_office'] : '' }}<br>
                            <b>Номер: </b>            {{ isset($address['number_street_office']) ? $address['number_street_office'] : '' }}<br>
                       @endif
                   
                    </td>
                    
                    <td>
                       <b>Доставка: </b> {{ $order->delivery_method == 'Тo_an_office' ? 'До офис' : 'До адрес' }}<br>
                       <b>Плащане: </b> {{ $order->payment_method }}
                    </td>
                    
                    @if(!empty($order->note))
                        <td>{{ $order->note }}</td>
                    @endif
                    @if(!empty($order->company))
                        <td>{{ $order->company }}</td>
                    @endif
                    @if(!empty($order->company))
                        <td>{{ $order->bulstat }}</td>
                    @endif
                </tr>
            </table>

            <table class="table table-striped">
                @if($order->completed_order == 1)
                    <tr style="background-color:#e3efd2">
                @else
                    <tr>
                @endif
                    <th>Количество</th>
                    <th>Общо</th>
                    <th></th>
                    <th>Продукт</th>
                    <th>Единична цена</th>
                </tr>

                <?php $products = unserialize(base64_decode($order->cart)) ?>

                @foreach($products->items as $product)
                        <?php $descriptions = json_decode($product['item']['description'], true); ?>
                        @if($order->completed_order == 1)
                            <tr style="background-color:#e3efd2">
                        @else
                            <tr>
                        @endif
                        <td>{{ $product['qty'] }} бр.</td>
                        <td>{{ $product['total_item_price'] }} лв.</td>
                        
                            <td>
                                @if (isset($descriptions['main_picture_url']))
                                    <img style="margin: 0 auto; width: 120px;height: 100px;" src="{{ $descriptions['main_picture_url'] }}" alt="pic" />
                                @elseif(isset($descriptions['upload_main_picture']))
                                    <img style="margin: 0 auto; width: 120px;height: 100px;" src="/storage/upload_pictures/{{ $product['item']['id'] }}/{{ $descriptions['upload_main_picture'] }}" alt="pic" />
                                @else
                                    <img style="margin: 0 auto; width: 120px;height: 100px;" src="/storage/common_pictures/noimage.jpg" alt="pic" />
                                @endif
                            </td>
                        <td>{{ $descriptions['title_product'] }}</td>
                        <td>{{ $descriptions['price']}} лв.</td>
                    </tr>
                @endforeach
            </table>

            <p>
                <p style="font-size: 16px;"> Общо количество: <strong>{{ $products->totalQty}} бр.</strong></p>
                <p style="font-size: 16px;">Обща сума: <strong>{{ $products->totalPrice }} лв.</strong></p>
                <p>Дата:  {{ $order->created_at }}</p>
            </p>
        </div>

        <div>
            @if($order->completed_order == 1)
                <a class="btn btn-warning" href="/admin/completed_order/{{ $order->id }}">Размаркирай като изпълнена</a>
            @else
                <a class="btn btn-primary" href="/admin/completed_order/{{ $order->id }}">Маркирай като изпълнена</a>
            @endif

            <form method="POST" action="/admin/dashboard/{{ $order->id }}" accept-charset="UTF-8" class="pull-right">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="DELETE">
                <input class="btn btn-danger" type="submit" value="Изтриване на поръчката">
            </form>
        </div>

        <script type="text/javascript" charset="utf-8">

                function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                }
        </script>

    @include('admin.admin_partials.admin_menu_bottom')
@endsection