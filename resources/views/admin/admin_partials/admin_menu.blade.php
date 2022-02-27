<nav class="navbar navbar-inverse top-bar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> <span class="menu-icon" id="menu-icon"><i class="fa fa-times" aria-hidden="true" id="chang-menu-icon"></i></span>
                <a class="navbar-brand" href="#"><img src="/storage/common_pictures/logo.png" width="100"> </a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
                <form class="navbar-form navbar-left">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i> </button>
                        </div>
                    </div>
                </form>
                <ul class="nav navbar-nav">
                    <li class=""><a href="#"><i class="fa fa-refresh"></i></a> </li>
                    <li class=""><a href="#"><i class="fa fa-volume-up"></i></a> </li>
                    <li class=""><a href="#"><i class="fa fa-envelope"></i> <span class="badge">5</span></a> </li>

                    <?php  $notCompletedOrders = count(App\Order::all()->where('completed_order', false)) ?>
                    <li class=""><a href="#"><i class="fa fa-bell"></i> <span class="badge">{{ isset($notCompletedOrders) ? $notCompletedOrders : '' }}</span></a> </li>


                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Вход</a></li>
                        <li><a href="{{ route('register') }}">Регистрация</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!--    top nav end===========-->

    <div class="wrapper" id="wrapper">
        <div class="left-container" id="left-container">
            <!-- begin SIDE NAV USER PANEL -->
            <div class="left-sidebar" id="show-nav">
                <ul id="side" class="side-nav">

                    <li class="panel">
                        <a id="panel1" href="javascript:;" data-toggle="collapse" data-target="#Dashboard"> <i class="fa fa-truck"></i> Поръчки
                            <span class="label label-danger">{{ isset($notCompletedOrders) ? $notCompletedOrders : '' }}</span>
                            <?php  $completedOrders = count(App\Order::all()->where('completed_order', true)) ?>
                            <span class="label label-primary">{{ isset($completedOrders) ? $completedOrders : '' }}</span>
                            <i class="fa fa-chevron-left pull-right" id="arow1"></i> </a>
                        <ul class="collapse nav" id="Dashboard">
                            <li> <a href="/admin/not_completed_orders"><i class="fa fa-angle-double-right"></i> Не изпълнени поръчки</a> </li>
                            <li> <a href="/admin/dashboard"><i class="fa fa-angle-double-right"></i> Всички Поръчки</a> </li>
                        </ul>
                    </li>
                    
                      <li class="panel">
                        <a id="panel2" href="javascript:;" data-toggle="collapse" data-target="#inbox"> <i class="fa fa-inbox"></i> Съобщения
                            
                             <?php $allUserMessage = count(App\Admin\UserMessage::all()); ?>
                             
                             <?php  $newUserMessage = count(App\Admin\UserMessage::all()->where('answer', false)) ?>
                            @if ($newUserMessage == 0)
                                <span class="label label-warning">Няма нови съобщения</span>
                            @else
                                <span class="label label-danger">Има {{ $newUserMessage }} съобщение/я</span>
                            @endif
                            <i class="fa fa fa-chevron-left pull-right" id="arow2"></i> </a>
                        <ul class="collapse nav" id="inbox">
                            <li> <a href="/admin/user_messages"><i class="fa fa-angle-double-right"></i> Всички съобщения 
                            <span class="label label-primary">{{ isset($allUserMessage) ? $allUserMessage : '' }}</span></a> </li>
                        </ul>
                    </li>

                    <li class="panel">
                        <a id="panel3" href="javascript:;" data-toggle="collapse" data-target="#edit"> <i class="fa fa-product-hunt"></i> Продукти
                            <?php  $productCount = count(App\Admin\Product::all()) ?>
                            <span class="label label-success">{{ isset($productCount) ? $productCount : '0'}}</span>
                            <i class="fa fa fa-chevron-left pull-right" id="arow3"></i>
                        </a>
                        <ul class="collapse nav" id="edit">
                            <li> <a href="/admin/products"><i class="fa fa-angle-double-right"></i> Всички продукти</a> </li>
                            <li> <a href="/admin/products/create"><i class="fa fa-angle-double-right"></i> Нов продукт</a> </li>
                        </ul>
                    </li>


                    <li class="panel">
                            <a id="panel4" href="javascript:;" data-toggle="collapse" data-target="#charts"> <i class="fa fa-product-hunt"></i> Филтрирани продукти
                                <i class="fa fa-chevron-left pull-right" id="arow4"></i> </a>
                            <ul class="collapse nav" id="charts">
                                @foreach($subCategoriesButtonsName as $subCategoriesButtonsName)
                                    <li> 
                                        <a href="/admin/products/search?category={{ $subCategoriesButtonsName->identifier }}">
                                            <i class="fa fa-angle-double-right"></i> 
                                             {{ $subCategoriesButtonsName->name }} 
                                             <sup class="badge">{{ count(App\Admin\Product::all()->where('identifier', $subCategoriesButtonsName->identifier)) }}</sup>
                                         </a> 
                                    </li>
                                @endforeach
                            </ul>
                    </li>

                    <li class="panel">
                        <a id="panel5" href="javascript:;" data-toggle="collapse" data-target="#clipboard"> <i class="fa fa-users"></i> Потребители
                            <i class="fa fa fa-chevron-left pull-right" id="arow5"></i> </a>
                        <ul class="collapse nav" id="clipboard">
                            <li> <a href="/admin/users"><i class="fa fa-angle-double-right"></i> Потребители</a> </li>
                            <li> <a href="/admin/admins"><i class="fa fa-angle-double-right"></i> Администратори</a> </li>
                        </ul>
                    </li>

                  

                    <li class="panel">
                        <a id="panel6" href="javascript:;" data-toggle="collapse" data-target="#cogs"> <i class="fa fa-cogs"></i> Страници
                            <i class="fa fa fa-chevron-left pull-right" id="arow6"></i> </a>
                        <ul class="collapse nav" id="cogs">
                            <li> <a href="/admin/pages"><i class="fa fa-angle-double-right"></i> Всички страници</a> </li>
                            <li> <a href="/admin/pages/create"><i class="fa fa-angle-double-right"></i> Нова страница</a> </li>
                        </ul>
                    </li>

                    <li class="panel">
                        <a id="panel7" href="javascript:;" data-toggle="collapse" data-target="#paper"> <i class="fa fa-cogs"></i> Категории
                            <?php  $categoryCount = count(App\Admin\Category::all()) ?>
                            <span class="label label-success">{{ isset($categoryCount) ? $categoryCount : '0' }}</span>
                            <i class="fa fa fa-chevron-left pull-right" id="arow7"></i> </a>
                        <ul class="collapse nav" id="paper">
                            <li> <a href="/admin/categories/"><i class="fa fa-angle-double-right"></i> Всички Категории</a> </li>
                            <li> <a href="/admin/categories/create"><i class="fa fa-angle-double-right"></i> Нова категория</a> </li>
                        </ul>
                    </li>

                    <li class="panel">
                        <a id="panel8" href="javascript:;" data-toggle="collapse" data-target="#trash"> <i class="fa fa-cogs"></i> Подкатегории
                        
                            <?php  $subCategoryCount = count(App\Admin\SubCategory::all()) ?>
                            <span class="label label-success">{{ isset($subCategoryCount) ? $subCategoryCount : '0' }}</span>
                            <i class="fa fa fa-chevron-left pull-right" id="arow8"></i>
                        </a>
                        <ul class="collapse nav" id="trash">
                            <li> <a href="/admin/sub_categories/"><i class="fa fa-angle-double-right"></i> Всички Подкатегории</a> </li>
                            <li> <a href="/admin/sub_categories/create"><i class="fa fa-angle-double-right"></i> Нова подкатегория</a> </li>
                        </ul>
                    </li>

                    <li class="panel">
                        <a id="panel9" href="javascript:;" data-toggle="collapse" data-target="#print_templates"> <i class="fa fa-cogs"></i> Щампи

                            <?php  $printTemplates = count(App\Admin\PrintTemplate::all()) ?>
                            <span class="label label-success">{{ isset($printTemplates) ? $printTemplates : '0' }}</span>
                            <i class="fa fa fa-chevron-left pull-right" id="arow9"></i>
                        </a>
                        <ul class="collapse nav" id="print_templates">
                            <li> <a href="/admin/print_templates/"><i class="fa fa-angle-double-right"></i> Всички Щампи</a> </li>
                            <li> <a href="/admin/print_templates/create"><i class="fa fa-angle-double-right"></i> Нова Щампа</a> </li>
                        </ul>
                    </li>

                    <li class="panel">
                        <a id="panel10" href="javascript:;" data-toggle="collapse" data-target="#btc">
                            <i class="fa fa-globe"></i> Информация за сайта
                            <i class="fa fa fa-chevron-left pull-right" id="arow10"></i>
                        </a>
                        <ul class="collapse nav" id="btc">
                            <li> <a href="/admin/info_company/"><i class="fa fa-angle-double-right"></i> Информация за сайта</a> </li>
                        </ul>
                    </li>
                    
                     <li class="panel">
                        <a id="panel11" href="javascript:;" data-toggle="collapse" data-target="#pie-Chart">
                            <i class="fa fa-bar-chart"></i> Слидер
                            <i class="fa fa fa-chevron-left pull-right" id="arow11"></i> </a>
                        <ul class="collapse nav" id="pie-Chart">
                            <li> <a href="/admin/slider/"><i class="fa fa-angle-double-right"></i>Всички снимки в слайдер </a> </li>
                            <li> <a href="/admin/slider/create"><i class="fa fa-angle-double-right"></i> Добавяне на снимка</a> </li>
                        </ul>
                    </li>

                    <li class="panel">
                        <a id="panel12" href="javascript:;" data-toggle="collapse" data-target="#support_message">
                            <i class="fa fa-bar-chart"></i> Support Messages
                            <i class="fa fa fa-chevron-left pull-right" id="arow12"></i> </a>
                        <ul class="collapse nav" id="support_message">
                            <li> <a href="/admin/support_messages/"><i class="fa fa-angle-double-right"></i> Съобщения от подръжката</a></li>
                            <li> <a href="/admin/support_messages/create"><i class="fa fa-angle-double-right"></i> Добавяне на съобщение</a> </li>
                        </ul>
                    </li>

                    <li class="panel" style="background-color: #084951;">
                        <a id="panel13" href="javascript:;" data-toggle="collapse" data-target="#space_bottom_menu">
                            <i id="arow13"></i>
                        </a>
                        <ul class="collapse nav" id="space_bottom_menu">
                            <li>     </li>
                            <li>     </li>
                        </ul>
                    </li>

                    <li class="panel" style="background-color: #084951;">
                        <a id="panel14" href="javascript:;" data-toggle="collapse" data-target="#space_bottom_menu_2">
                            <i id="arow14"></i>
                        </a>
                        <ul class="collapse nav" id="space_bottom_menu_2">
                            <li>     </li>
                            <li>     </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- END SIDE NAV USER PANEL -->
        </div>
        <div class="right-container" id="right-container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="#"> Home</a></li>
                            <li class="active">{{ $title }}</li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-inline pull-right mini-stat">
                            <li>
                                <?php $allLikes = count(App\Like::all()); ?>
                                <h5>ХАРЕСВАНИЯ <span class="stat-value color-blue"><i class="fa fa-plus-circle"></i> {{ isset($allLikes) ? $allLikes : '' }}</span></h5>

                            </li>
                            <li>
                               
                                <h5>СЪОБЩЕНИЯ <span class="stat-value color-green"><i class="fa fa-plus-circle"></i> {{ isset($allUserMessage) ? $allUserMessage : '' }}</span></h5>

                            </li>
                            <li>
                                <h5>ПОТРЕБИТЕЛИ <span class="stat-value color-orang"><i class="fa fa-plus-circle"></i> {{ is_null(App\User::all()) ? '0' : count(App\User::all())  }} </span></h5>

                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="main-header">
                            <h2>{{ $title }}</h2>

                            @if(session()->has('notif'))
                                <em style="color: #00d64b">{{ session()->get('notif') }}</em>
                            @else
                                <em>Информация</em>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row padding-top">
                 <script>
        		$('#menu-scroll').hide();
    		</script>
                    <div id="admin-wrapper">