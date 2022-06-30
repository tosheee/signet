@extends('layouts.old_app')

@section('content')
        <div class="col-md-1" id="vertical-nav-bar"></div>
    @if (isset($cart))
        <div id="modalOfficeLocate" class="modal-search-office">
           <div class="modal-content-search-office">
             <span class="close">&times;</span>
            <span>Моля, попълнете полето за населеното място и натиснете бутона "Търсене", след това изберете най - удобния офис на Еконт за Вас.</span>
            <iframe frameborder="0" id="officeLocator" scrolling="no" frameborder="0" style="border: medium none; width: 90%; height: 90%;" src="https://www.bgmaps.com/templates/econt?office_type=to_office_courier&shop_url={{ Request::fullUrl() }}&address= --- Изберете ---" class="cboxIframe"></iframe>
        </div>
        </div>

        <div  class="container">
        <div class="row">
            <div class="col-sm-11">
                <div id="user-orders" class="container" style="margin: 10px;">
                    <div class="row order_sorter">
                        <ul id="toggle-orders">
                            <li class="first"></li>
                            <li class="fo selected"> <a href="/store">Обратно в магазина</a></li>
                            <li class="oh selected"><a href="/shopping-cart">Количка</a></li>
                        </ul>
                    </div>
                </div>
                
                <form id="form-shipping" class="" name="form-shipping" action="/checkout" method="post">
                     {{ csrf_field() }}
                    <div class="elegant-aero">
        
                        <h2>Данни за клиент
                            <span>Полетата със звезда<sup style="color: red;">*</sup> са задължителни</span>
                        </h2>
        
                        <label>
                            <span>E-поща:  <sup style="color: red;">*</sup> </span>
                            <input id="name" type="text"  required="required"  oninvalid="this.setCustomValidity('Моля, въведете имейл!')" oninput="setCustomValidity('')" name="email" placeholder="е-поща" value="{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}"/>
                        </label>
        
                        <label>
                            <span>Име: <sup style="color: red;">*</sup></span>
                            <input id="name" type="text" name="name" placeholder="Име" required="required" oninvalid="this.setCustomValidity('Моля, въведете име!')" oninput="setCustomValidity('')" value="{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}"/>
                            <input name="user_id" type="hidden" value="{{ isset(Auth::user()->id) ? Auth::user()->id : '' }}">
                        </label>
        
                        <label>
                            <span>Фамилия: <sup style="color: red;">*</sup></span>
                            <input id="last_name" type="text" name="last_name" required="required" oninvalid="this.setCustomValidity('Моля, въведете фамилия!')" oninput="setCustomValidity('')" placeholder="Фамилия" />
                        </label>
        
        
                        <label>
                            <span>Телефон: <sup style="color: red;">*</sup></span>
                            <input id="phone" type="text" name="phone" placeholder="Телефон" required="required" oninvalid="this.setCustomValidity('Моля, въведете телефон!')" oninput="setCustomValidity('')" value="{{ isset(Auth::user()->phone) ? Auth::user()->phone : '' }}"/>
                        </label>
        
                        <label>
                            <span>Фирма: </span>
                            <input id="company" type="text" name="company" placeholder="Фирма" />
                        </label>
        
                        <label>
                            <span>ЕИК или ДДС No: </span>
                            <input id="bulstat" type="text" name="bulstat" placeholder="ЕИК или ДДС No" />
                        </label>
                    </div>
                     
                     </br>
                     
                     <div id="panel-delivery-method" class="elegant-aero">
                        <h2>Доставка <span>Моля, изберете предпочитан метод на доставка за тази поръчка</span></h2>
                        <label>
                            <input type="radio" name="delivery_method" id="radio-office" value="Тo_an_office" checked /> Еконт Експрес - до офис
                        </label>
        
                        <label>
                            <input type="radio" name="delivery_method" id="radio-door" value="Тo_the_door" /> Еконт Експрес - до врата
                        </label>
                    </div>
        
                    </br>
                    
                    <div id="change-form-checkout" class="elegant-aero">
                        <h2 id="heading-form">Офис на Еконт <span id="description-form">Моля, използвайте бутона "ОФИС ЛОКАТОР" за да намерите най - удобния офис на Еконт за Вас.</span></h2>
                        <label>
                            <span>Наложен платеж: </span>
                            <input type="radio" name="payment_method" value="Наложен платеж" checked>Да 
                            <input type="radio" name="payment_method" value="Банков път" > Не
                        </label>
                           <br>
                        
                        <label id="order-location">
                            <span id="span-populated-pace">Населено място: <sup style="color: red;">*</sup></span>  
                            <select id="select-search-city" name="address[populated_place]" class="search-city" style="width: 70.6%; padding: 20px;">
                        			<option value=""></option>
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
                		</label>
                        
                        <script type="text/javascript">
                            $("#select-search-city").select2({
                              placeholder: "Изберете населено място"
                            });
                        </script>
                          <br class="new-line-br">
                          <br class="new-line-br">
                          <br class="new-line-br">
                          <br class="new-line-br">
                        <label>
                            <span id="span-office">Офис: <sup style="color: red;">*</sup></span>
                            <input id="street_office" type="text" required="required" oninvalid="this.setCustomValidity('Моля, въведете офис или улица!')" oninput="setCustomValidity('')" name="address[street_office]" placeholder="Офис" />
                        </label>
                        
                        <label>
                            <span id="span-number">Код на офиса: <sup style="color: red;">*</sup></span>
                            <input id="number_street_office" type="text" oninvalid="this.setCustomValidity('Моля, попълнете празното поле!')" oninput="setCustomValidity('')" name="address[number_street_office]" placeholder="Код на офиса" />
                        </label>
                        <label><a class="btn btn-primary btnOffisLocalization"><b>ОФИС ЛОКАТОР</b></a></label>
                    </div>
                    
                    <script>
             
                        $('#panel-delivery-method').on('click','input[type="radio"]', function() {
                            var id = this.id;
                            if(id == 'radio-door' ){
                             
                                $('#heading-form').html('Еконт до врата  <span>Моля, попълнете полетата</span>');
                                $('#span-office').html('Улица: <sup style="color: red;">*</sup>');
                                
                                $('.select2.select2-container').show();
                                
                                $('#populated_place').hide();
                                
                                if($('.new-line-br').is(":visible")){
                                    $('.new-line-br').hide();
                                }else{
                                    $('.new-line-br').show();
                                }
                                    
                                  
                                
                                $('#populated_place').attr("placeholder", "Населено място").val("").focus().blur();
                                $('#populated_place').prop('readonly', false);
                                
                                $('#street_office').attr("placeholder", "Улица").val("").focus().blur();
                                $('#street_office').prop('readonly', false);
                                
                                $('#span-number').html('Номер: <sup style="color: red;">*</sup>');
                                
                                $('#number_street_office').attr("placeholder", "Номер").val("").focus().blur();
                                $('#number_street_office').prop('readonly', false);
                                        
                            }else{
                             
                                $('#heading-form').html('Офис на Еконт <span>Моля, използвайте бутона "ОФИС ЛОКАТОР" за да намерите най - удобния офис на Еконт за Вас.</span>');
                                
                                $('#populated_place').prop('readonly', true);
                                
                                $('#span-office').html('Офис: <sup style="color: red;">*</sup>');
                                $('#street_office').attr("placeholder", "Офис").val("").focus().blur();
                                //$('#street_office').prop('readonly', true);
                                
                                $('#span-number').html('Код на офиса: <sup style="color: red;">*</sup>');
                                $('#number_street_office').attr("placeholder", "Код на офиса").val("").focus().blur();
                                //$('#number_street_office').prop('readonly', true);
                            }
                        });
                    
                        if (window.addEventListener) {
                            window.addEventListener("message", listenMessage, false);
                            
                        }
                        else 
                        {
                            window.attachEvent("onmessage", listenMessage);
                            console.log(listenMessage);
                        }
                            
                            
                        var modalOfficeIframe = document.getElementById('modalOfficeLocate');
                        var modalIframe = $('#modalOfficeLocate');
                            
                        function listenMessage(event) {
                            var result = event.data.split("||");
                            $('#heading-form').html('Офис на Еконт <span>Моля, попълнете полетата</span>');
                            $('.select2.select2-container').hide();
                            
                            if($('#populated_place').length){
                                $('#populated_place').remove();
                            }
                            $('#order-location').append('<input id="populated_place" type="text" required="required" name="address[populated_place]"  value="" placeholder="Населено място" readonly/> ');
                            
                            
                            if($('.new-line-br').length){
                                $('.new-line-br').hide();
                            }
                            
                            $('#span-office').html('Офис: <sup style="color: red;">*</sup>');
                            $('#span-number').html('Код на офиса: <sup style="color: red;">*</sup>');
                            
                            $('#radio-office').prop('checked', true);
                            
                            $('#populated_place').val(result[1]);
                            
                            $('#street_office').val(result);
                            $('#street_office').prop('readonly', true);
                            
                            $('#number_street_office').val(result[0]);
                            $('#number_street_office').prop('readonly', true);
                         
                            modalOfficeIframe.style.display = "none";
                        }
                        
                         
                         
                         $('#change-form-checkout').on('click','.btnOffisLocalization', function() {
                            modalIframe.css("display", "block");
                         });
                         
                         $('body').on('click','.close', function() {
                             modalIframe.css("display", "none");
                         });
                         
                         window.onclick = function(event) {
                            if (event.target == modalOfficeIframe) {
                                modalOfficeIframe.style.display = "none";
                            }
                        }
                    </script>
               
                    <br>
                    <div class="elegant-aero">
                        <h2>Поръчка <span></span></h2>
                        <table width="100%">
                      
                            @foreach($cart->items as $item)
                                <?php $description = json_decode($item['item']->description, true); ?>
                                <tr style="text-align: center; border-bottom: solid 1px; border-bottom-style: dashed; border-bottom-color: #c8d5de;">
                                    <td>
                                        
                                @if (isset($description['main_picture_url']))
	                                <a class="thumbnail pull-left" href="/store/{{ $item['item']->id}}" target="_blank"> 
	                                <img  style="margin: 0 auto; width: 50px;height: 50px;" src="{{ $description['main_picture_url'] }}" alt="pic" />
	                                </a>
	                            @elseif(isset($description['upload_main_picture']))
	                                <a class="thumbnail pull-left" href="/store/{{ $item['item']->id }}" target="_blank" >  
	                                <img  style="margin: 0 auto; width: 50px;height: 50px;" src="{{ asset('product_images/')}}/{{ $item['item']->id }}/{{ $description['upload_main_picture'] }}" alt="pic" />
	                                </a>
	                            @else
	                                <a class="thumbnail pull-left" href="/store/{{ $item['item']->id }}" target="_blank" >  
	                                <img style="margin: 0 auto; width: 50px;height: 50px;" src="/storage/common_pictures/noimage.jpg" alt="pic" />
	                                </a>
	                            @endif    
                                    </td>
                                    
                                    <td><h5><a href="/store/{{ $item['item']->id }}" target="_blank">{{ $description['title_product'] }}</a></h5></td>
                                    <td><span> {{ $item['qty'] }} <strong> x </strong> {{ number_format((float)$description['price'], 2) }} {{ $description['currency'] }}</span></h3></td>
                                </tr>
                            @endforeach
                        </table>
                        <h4 style="text-align: right;" class="price totalPrice">Общо:   {{ number_format((float)$cart->totalPrice, 2) }} лв.</h4>
                    </div>
        
                     <br>
        
                    <div class="elegant-aero">
                        
                        <h2>Потвърждаване<span>Моля, изберете предпочитан метод на доставка за тази поръчка</span></h2>
                        <label>
                            <span>Добавете пояснения или указания към поръчката си:</span>
                            <textarea id="message" name="note" placeholder="Бележка към поръчката"></textarea>
                        </label>

                        <br/>

                        @if(!isset(Auth::user()->email))
                            <div class="form-group">
                                <label for="confirm_condition" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <input id="confirm_condition" type="checkbox" class="" name="password_confirmation" required="required" oninvalid="this.setCustomValidity('За да продължите, моля кликнете върху отметката')" oninput="setCustomValidity('')">
                                    Ние имаме нужда от Вашето съгласие, за да обработваме личните Ви данни в съответствие с новия Регламент! Моля прочетете нашата
                                    <a href="/personal_data">Политика за защита на лични данни!</a>
                                </div>
                            </div>

                            <br/><br/><br/><br/>
                            <div class="form-group">
                                <label for="use_condition" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <input id="use_condition" type="checkbox" class="" name="password_confirmation" required="required" oninvalid="this.setCustomValidity('За да продължите, моля кликнете върху отметката')" oninput="setCustomValidity('')">
                                    <a href="/terms_of_use">Приемам условията за ползване</a>
                                </div>
                            </div>

                            <br/><br/><br/>
                        @endif

                        <label>
                            <button type="submit" class="btn btn-success" style="width: 100%">Потвърди</button>
                        </label>
                    </div>
                
                </form>

                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
            </div>
        </div>
    </div>
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