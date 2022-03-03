<div id="sidebar">
    <?php $paramOfUrl = explode('=', Request::fullUrl()) ?>
    @if(isset($categories))
        @foreach($categories as $category)
            <h3>{{ $category->name }}</h3>

            @if(isset($category->filters))
                <?php $jsonFilters = json_decode($category->filters, true)?>

                @foreach($jsonFilters as $key => $filters)
                    <h4>{{$key}}</h4>
                    @foreach($filters as $filter)
                        @foreach($filter as $iKey => $fill)
                            <h5>{{ $fill }}</h5>
                        @endforeach

                    @endforeach
                @endforeach

            @endif

        @endforeach
    @endif


        @foreach($categoriesButtonsName as $categoryButton)
        <h3>
            <a class="v-nav-a" href="/store/search?category={{ $categoryButton->id }}" title="Вижте продуктите в {{ $categoryButton->name }}"> {{ $categoryButton->name }}</a>
        </h3>
        <div class="checklist categories">
            <ul class="">

                @foreach($subCategoriesButtonsName as $subCategoryButtonsName)
                    @if ($subCategoryButtonsName->category_id == $categoryButton->id)

                        @if(isset($paramOfUrl[1]) && urldecode($paramOfUrl[1]) == $subCategoryButtonsName->identifier)
                            <li class="" >
                                <span></span>
                                <a style="" class="" href="/store/search?sub_category={{ $subCategoryButtonsName->identifier }}"
                                   title="{{ $subCategoryButtonsName->name }}">
                                    {{ $subCategoryButtonsName->name }}</a>
                            </li>
                        @else
                            <li class=""><a class="" href="/store/search?sub_category={{ $subCategoryButtonsName->identifier }}" title="{{ $subCategoryButtonsName->name }}">{{ $subCategoryButtonsName->name }}</a></li>
                        @endif

                    @endif
                @endforeach
            </ul>
        </div>
    @endforeach


    <h3>Цветове</h3>
    <div class="checklist colors">
        <ul>

            <li><a href="/store/search?product_color=green"><span style="background: #44c28d"></span>Зелен</a></li>
            <li><a href="/store/search?product_color=blue"><span style="background: #6e8cd5"></span>Син</a></li>
            <li><a href="/store/search?product_color=yellow"><span style="background: #f1c40f"></span>Жълт</a></li>
            <li><a href="/store/search?product_color=red"><span style="background: #e74c3c;"></span>Червен</a></li>
            <li><a href="/store/search?product_color=white"><span style="background: #fff;border: 1px solid #e8e9eb;width:13px;height:13px;"></span>Бял</a></li>
            <li><a href="/store/search?product_color=pink"><span style="background: #ffa4bb"></span>Розов</a></li>
        </ul>

        <ul>
            <li><a href="/store/search?product_color=orange"><span style="background: #f79858"></span>Оранж</a></li>
            <li><a href="/store/search?product_color=purple"><span style="background: #b27ef8"></span>Лилав</a></li>
            <li><a href="/store/search?product_color=grey"><span style="background: #999"></span>Сиж</a></li>
            <li><a href="/store/search?product_color=brown"><span style="background: #6a1c08"></span>Кафяв</a></li>
            <li><a href="/store/search?product_color=black"><span style="background: #222"></span>Черен</a></li>
        </ul>
    </div>
</div>