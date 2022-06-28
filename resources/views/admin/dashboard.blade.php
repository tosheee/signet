@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')
 
    
    @if(count($orders) > 0)
        @foreach($orders as $order)
            <table class="table table-striped">
                <tr style="color: #ffffff; background-color: #084951">
                    <th>Kлиент</th>
                    <th>Адрес</th>
                    <th>Доставка и плащане</th>
                    <th>Бележка</th>
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
                    
                    <td>{{ $order->note }}</td>
                    
                    @if(!empty($order->company))
                        <td>{{ $order->company }}</td>
                    @endif

                    @if(!empty($order->company))
                        <td>{{ $order->bulstat }}</td>
                    @endif
                </tr>

                <tr>
                      <table class="table table-striped">
                          @if($order->completed_order == 1)
                              <tr style="background-color:#e3efd2">
                          @else
                              <tr>
                          @endif
                              <th>Общо количество </th>
                              <th>Обща цена </th>
                              <th></th>
                              <th>Име на продукта</th>
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
                                      <td><a href="/admin/products/{{ $product['item']['id'] }}">{{ $descriptions['title_product'] }}</a></td>
                                      <td>{{ $descriptions['price']}} лв.</td>
                                  </tr>
                          @endforeach
                      </table>
                </tr>

                <tr>
                    | Общ брой на продуктите в поръчката: <strong style="font-size: 130%">{{ $products->totalQty }} бр.</strong>
                    | Общо за изплащане: <strong style="font-size: 130%" >{{ $products->totalPrice }} лв.</strong>
                    | Дата:  {{ $order->created_at }} |
                </tr>
                <script>
                   $(document).ready(function(){
                       $('.completed-order').html();

                    });

                </script>

                <div>
                    <a class="btn btn-info" href="/admin/dashboard/{{ $order->id }}">Преглед на поръчката</a>

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
            </table>
            <br/>
            <br/>
            <br/>
            <br/>
            @endforeach
            {{ $orders->links() }}
       

    @else
        <p>Няма поръчки</p>
    @endif

    @include('admin.admin_partials.admin_menu_bottom')
@endsection