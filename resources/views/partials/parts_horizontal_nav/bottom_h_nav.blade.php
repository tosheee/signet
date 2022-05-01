<nav class="navbar navbar-main navbar-default" id="navbar-main-navbar-default" role="navigation" style="opacity: 1;">
    <div class="container">
        <!-- Brand and toggle -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links,  -->
        <div class="collapse navbar-collapse navbar-1" style="margin-top: 0px;">
            <ul class="nav navbar-nav">
                <li><a href="/designer">Направи си дизайн</a></li>
                @foreach($categories as $category)
                    <li >
                        <a href="/store/search/{{$category->identifier}}" title="{{ $category->name }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach

                @foreach($pagesButtonsRender as $pageButton)
                    <li><a href="/page?show={{ $pageButton->url_page }}" class="dropdown-toggle"  data-hover="dropdown" data-close-others="false" title="{{ $pageButton->name_page }}">{{ $pageButton->name_page }}</a></li>
                @endforeach
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"></a></li>
                <li></li>
                <li class="dropdown"></li>
                <li class="dropdown" id="menu-scroll-cart"></li>
            </ul>



        </div><!-- /.navbar-collapse -->
    </div>
</nav>