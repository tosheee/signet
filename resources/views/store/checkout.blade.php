@extends('layouts.app')

@section('content')

    <style>
        @media (min-width: 576px){
            .modal-dialog {
                max-width: 1406px;
                margin: 1.75rem auto;
            }}
    </style>

    <div id="myModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Моля попълнете полето за населеното място, след това изберете най-удобния офис на Еконт за Вас.</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!--<iframe frameborder="0" id="officeLocator" scrolling="no" frameborder="0" style="border: medium none; width: 85em; height: 35em;" src="https://www.econt.com/office-locator/#!/" class="cboxIframe"></iframe>-->
                    <iframe frameborder="0" id="officeLocator" scrolling="no" frameborder="0" style="border: medium none; width: 85em; height: 35em;" src="https://www.bgmaps.com/templates/econt?office_type=to_office_courier&shop_url={{ Request::fullUrl() }}&address= --- Изберете ---" class="cboxIframe"></iframe>

                </div>

            </div>
        </div>
    </div>

@if (isset($cart))
    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form id="form-shipping" class="" name="form-shipping" action="/checkout" method="post">
        <div class="row px-xl-5">

                <div class="col-lg-8">
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Адрес за получаване</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Име<sup style="color: red; font-size: large;" title="Задължително поле">*</sup></label>
                                <input class="form-control" type="text" placeholder="Име" value="{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Фамилия<sup style="color: red; font-size: large;" title="Задължително поле">*</sup></label>
                                <input class="form-control" type="text" placeholder="Фамилия" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Имейл<sup style="color: red; font-size: large;" title="Задължително поле">*</sup></label>
                                <input class="form-control" type="text" placeholder="@email.com" value="{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Телефон<sup style="color: red; font-size: large;" title="Задължително поле">*</sup></label>
                                <input class="form-control" type="text" placeholder="">
                            </div>

                            <div id="panel-delivery-method" class="col-md-6 form-group">
                                Моля, изберете предпочитан метод на доставка за тази поръчка<sup style="color: red; font-size: large;" title="Задължително поле">*</sup>
                                <label>
                                    <input type="radio" name="delivery_method" id="radio-office" value="Тo_an_office" checked/> Доставка до офис&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </label>

                                <label>
                                    <input type="radio" name="delivery_method" id="radio-door" value="Тo_the_door"/> Доставка до адрес
                                </label>
                            </div>





                            <div class="col-md-6 form-group">
                                Моля, използвайте бутона "ОФИС ЛОКАТОР" за да намерите най - удобния офис на Еконт за Вас.
                                <label>
                                    <a href="#myModal" class="btn btn-primary btn-lg" data-toggle="modal"><b>ОФИС ЛОКАТОР</b></a>
                                </label></label>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>
                                    Населено място &nbsp;&nbsp;&nbsp;
                                    <a id="remove-addres" style="color: red;">Изтрий адрес</a>
                                </label>
                                <select id="select-search-city" name="address[populated_place]" class="custom-select search-city" >
                                    <option value="" id="billing_city"></option>
                                    <option value="Абланица">Абланица</option>
                                    <option value="Айдемир">Айдемир</option>
                                    <option value="Айтос">Айтос</option>
                                    <option value="Аксаково">Аксаково</option>
                                    <option value="Ардино">Ардино</option>
                                    <option value="Асеновград">Асеновград</option>
                                    <option value="Ахелой">Ахелой</option>
                                    <option value="Балчик">Балчик</option>
                                    <option value="Банкя">Банкя</option>
                                    <option value="Банско">Банско</option>
                                    <option value="Белене">Белене</option>
                                    <option value="Белово">Белово</option>
                                    <option value="Белоградчик">Белоградчик</option>
                                    <option value="Белозем">Белозем</option>
                                    <option value="Белослав">Белослав</option>
                                    <option value="Берковица">Берковица</option>
                                    <option value="Благоевград">Благоевград</option>
                                    <option value="Бобошево">Бобошево</option>
                                    <option value="Божурище">Божурище</option>
                                    <option value="Ботевград">Ботевград</option>
                                    <option value="Брегово">Брегово</option>
                                    <option value="Брезник">Брезник</option>
                                    <option value="Бургас">Бургас</option>
                                    <option value="Бяла Слатина">Бяла Слатина</option>
                                    <option value="Бяла, Варненско">Бяла, Варненско</option>
                                    <option value="Бяла, Русенско">Бяла, Русенско</option>
                                    <option value="Варна">Варна</option>
                                    <option value="Велико Търново">Велико Търново</option>
                                    <option value="Велинград">Велинград</option>
                                    <option value="Ветово">Ветово</option>
                                    <option value="Видин">Видин</option>
                                    <option value="Враца">Враца</option>
                                    <option value="Вълкосел">Вълкосел</option>
                                    <option value="Вълчедръм">Вълчедръм</option>
                                    <option value="Вълчи Дол">Вълчи Дол</option>
                                    <option value="Върбица">Върбица</option>
                                    <option value="Вършец">Вършец</option>
                                    <option value="Габрово">Габрово</option>
                                    <option value="Генерал Тошево">Генерал Тошево</option>
                                    <option value="Главиница">Главиница</option>
                                    <option value="Глоджево">Глоджево</option>
                                    <option value="Горна Оряховица">Горна Оряховица</option>
                                    <option value="Гоце Делчев">Гоце Делчев</option>
                                    <option value="Градец">Градец</option>
                                    <option value="Гълъбово">Гълъбово</option>
                                    <option value="Две Могили">Две Могили</option>
                                    <option value="Девин">Девин</option>
                                    <option value="Джебел">Джебел</option>
                                    <option value="Димитровград">Димитровград</option>
                                    <option value="Добринище">Добринище</option>
                                    <option value="Добрич">Добрич</option>
                                    <option value="Долна Митрополия">Долна Митрополия</option>
                                    <option value="Долна Оряховица">Долна Оряховица</option>
                                    <option value="Долни Дъбник">Долни Дъбник</option>
                                    <option value="Долни Чифлик">Долни Чифлик</option>
                                    <option value="Дорково">Дорково</option>
                                    <option value="Доспат">Доспат</option>
                                    <option value="Драгоман">Драгоман</option>
                                    <option value="Дряново">Дряново</option>
                                    <option value="Дулово">Дулово</option>
                                    <option value="Дупница">Дупница</option>
                                    <option value="Езерово">Езерово</option>
                                    <option value="Елена">Елена</option>
                                    <option value="Елин Пелин">Елин Пелин</option>
                                    <option value="Елхово">Елхово</option>
                                    <option value="Етрополе">Етрополе</option>
                                    <option value="Жеравна">Жеравна</option>
                                    <option value="Златица">Златица</option>
                                    <option value="Златоград">Златоград</option>
                                    <option value="Ивайловград">Ивайловград</option>
                                    <option value="Игнатиево">Игнатиево</option>
                                    <option value="Исперих">Исперих</option>
                                    <option value="Ихтиман">Ихтиман</option>
                                    <option value="Каблешково">Каблешково</option>
                                    <option value="Каварна">Каварна</option>
                                    <option value="Казанлък">Казанлък</option>
                                    <option value="Казичене">Казичене</option>
                                    <option value="Калипетрово">Калипетрово</option>
                                    <option value="Калофер">Калофер</option>
                                    <option value="Камено">Камено</option>
                                    <option value="Карлово">Карлово</option>
                                    <option value="Карнобат">Карнобат</option>
                                    <option value="Кирково">Кирково</option>
                                    <option value="Кнежа">Кнежа</option>
                                    <option value="Козлодуй">Козлодуй</option>
                                    <option value="Костандово">Костандово</option>
                                    <option value="Костенец">Костенец</option>
                                    <option value="Костинброд">Костинброд</option>
                                    <option value="Котел">Котел</option>
                                    <option value="Кочериново">Кочериново</option>
                                    <option value="Кричим">Кричим</option>
                                    <option value="Крумовград">Крумовград</option>
                                    <option value="Кубрат">Кубрат</option>
                                    <option value="Куклен">Куклен</option>
                                    <option value="Кърджали">Кърджали</option>
                                    <option value="Кюстендил">Кюстендил</option>
                                    <option value="Левски">Левски</option>
                                    <option value="Ловеч">Ловеч</option>
                                    <option value="Лозен">Лозен</option>
                                    <option value="Лозенец">Лозенец</option>
                                    <option value="Лозница">Лозница</option>
                                    <option value="Лом">Лом</option>
                                    <option value="Луковит">Луковит</option>
                                    <option value="Любимец">Любимец</option>
                                    <option value="Лясковец">Лясковец</option>
                                    <option value="Мадан">Мадан</option>
                                    <option value="Мартен">Мартен</option>
                                    <option value="Мездра">Мездра</option>
                                    <option value="Мизия">Мизия</option>
                                    <option value="Момчилград">Момчилград</option>
                                    <option value="Монтана">Монтана</option>
                                    <option value="Несебър">Несебър</option>
                                    <option value="Нова Загора">Нова Загора</option>
                                    <option value="Нови Искър">Нови Искър</option>
                                    <option value="Нови Пазар">Нови Пазар</option>
                                    <option value="Обзор">Обзор</option>
                                    <option value="Омуртаг">Омуртаг</option>
                                    <option value="Оряхово">Оряхово</option>
                                    <option value="Павел Баня">Павел Баня</option>
                                    <option value="Павликени">Павликени</option>
                                    <option value="Пазарджик">Пазарджик</option>
                                    <option value="Панагюрище">Панагюрище</option>
                                    <option value="Перник">Перник</option>
                                    <option value="Перущица">Перущица</option>
                                    <option value="Петрич">Петрич</option>
                                    <option value="Пещера">Пещера</option>
                                    <option value="Пирдоп">Пирдоп</option>
                                    <option value="Плевен">Плевен</option>
                                    <option value="Пловдив">Пловдив</option>
                                    <option value="Полски Тръмбеш">Полски Тръмбеш</option>
                                    <option value="Поморие">Поморие</option>
                                    <option value="Попово">Попово</option>
                                    <option value="Правец">Правец</option>
                                    <option value="Приморско">Приморско</option>
                                    <option value="Провадия">Провадия</option>
                                    <option value="Първомай">Първомай</option>
                                    <option value="Равда">Равда</option>
                                    <option value="Раднево">Раднево</option>
                                    <option value="Радомир">Радомир</option>
                                    <option value="Разград">Разград</option>
                                    <option value="Разлог">Разлог</option>
                                    <option value="Ракитово">Ракитово</option>
                                    <option value="Раковски">Раковски</option>
                                    <option value="Рила">Рила</option>
                                    <option value="Рудозем">Рудозем</option>
                                    <option value="Рус">Русе</option>
                                    <option value="Самоков">Самоков</option>
                                    <option value="Сандански">Сандански</option>
                                    <option value="Сапарева Баня">Сапарева Баня</option>
                                    <option value="Сатовча">Сатовча</option>
                                    <option value="Свети Влас">Свети Влас</option>
                                    <option value="Свиленград">Свиленград</option>
                                    <option value="Свищов">Свищов</option>
                                    <option value="Своге">Своге</option>
                                    <option value="Севлиево">Севлиево</option>
                                    <option value="Септември">Септември</option>
                                    <option value="Силистра">Силистра</option>
                                    <option value="Симеоновград">Симеоновград</option>
                                    <option value="Симитли">Симитли</option>
                                    <option value="Сливен">Сливен</option>
                                    <option value="Сливница">Сливница</option>
                                    <option value="Сливо Поле">Сливо Поле</option>
                                    <option value="Слънчев Бряг">Слънчев Бряг</option>
                                    <option value="Смолян">Смолян</option>
                                    <option value="Созопол">Созопол</option>
                                    <option value="Сопот">Сопот</option>
                                    <option value="София">София</option>
                                    <option value="Средец">Средец</option>
                                    <option value="Стамболийски">Стамболийски</option>
                                    <option value="Стара Загора">Стара Загора</option>
                                    <option value="Стралджа">Стралджа</option>
                                    <option value="Стрелча">Стрелча</option>
                                    <option value="Суворово">Суворово</option>
                                    <option value="Съединение">Съединение</option>
                                    <option value="Сърница">Сърница</option>
                                    <option value="Твърдица">Твърдица</option>
                                    <option value="Тервел">Тервел</option>
                                    <option value="Тетевен">Тетевен</option>
                                    <option value="Тополовград">Тополовград</option>
                                    <option value="Троян">Троян</option>
                                    <option value="Труд">Труд</option>
                                    <option value="Трявна">Трявна</option>
                                    <option value="Тутракан">Тутракан</option>
                                    <option value="Търговище">Търговище</option>
                                    <option value="Угърчин">Угърчин</option>
                                    <option value="Харманли">Харманли</option>
                                    <option value="Хасково">Хасково</option>
                                    <option value="Хисаря">Хисаря</option>
                                    <option value="Царево">Царево</option>
                                    <option value="Чепеларе">Чепеларе</option>
                                    <option value="Червен Бряг">Червен Бряг</option>
                                    <option value="Червена Вода">Червена Вода</option>
                                    <option value="Чирпан">Чирпан</option>
                                    <option value="Шумен">Шумен</option>
                                    <option value="Щръклево">Щръклево</option>
                                    <option value="Ябланово">Ябланово</option>
                                    <option value="Якоруда">Якоруда</option>
                                    <option value="Ямбол">Ямбол</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Адрес</label>
                                <input class="form-control" type="text" placeholder="" id="billing_address_1">
                            </div>
                            <div class="col-md-6 form-group">
                                <label></label>
                                <input class="form-control" type="text" placeholder="">
                            </div>


                            <div class="col-md-6 form-group">
                                <label></label>
                                <input class="form-control" type="text" placeholder="">
                            </div>

                            <div class="col-md-6 form-group">
                                <label></label>
                                <input class="form-control" type="text" placeholder="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label></label>
                                <input class="form-control" type="text" placeholder="">
                            </div>

                            <div class="col-md-12 form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="newaccount">
                                    <label class="custom-control-label" for="newaccount">Create an account</label>
                                </div>
                            </div>

                            <div class="col-md-12 form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="shipto">
                                    <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse mb-4" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="John">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select">
                                <option selected>United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123">
                        </div>
                    </div>
                </div>


            </div>
                <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Продукти</h5>

                        @foreach($cart->items as $item)
                            <?php $description = json_decode($item['item']->description, true); ?>
                            <div class="d-flex justify-content-between">
                                <p><a href="/store/{{ $item['item']->id }}" target="_blank">{{ $description['title_product'] }}</a></p>
                                <p>{{ $item['qty'] }} <strong> x </strong> {{ number_format((float)$description['price'], 2) }} {{ $description['currency'] }}</p>
                            </div>
                        @endforeach

                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            @if(isset($freeShipping))
                                <h6 class="font-weight-medium">Безплатна доставка</h6>
                            @else
                                <h6 class="font-weight-medium">Куриерската услуга не е включена в цената и е за сметка на купувача.</h6>
                                <!--<h6 class="font-weight-medium"> </h6>-->
                            @endif
                        </div>
                        <!--
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                        -->
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Общо:</h5>
                            <h5 class="font-weight-bold">{{ number_format((float)$cart->totalPrice, 2) }} лв.</h5>
                        </div>
                    </div>
                </div>

                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Потвърди</button>
                    </div>
                </div>
            </div>

        </div>
</form>
    </div>
    <!-- Checkout End -->
@endif


@endsection