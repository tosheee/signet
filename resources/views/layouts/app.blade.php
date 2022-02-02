<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124589373-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-124589373-1');
        </script>

        @if(isset($product))
            @if(isset($metaDescription))
                <meta property="fb:app_id" content="966242223397117" />
                <meta property="og:url" content="{{ Request::fullUrl() }}" />
                <meta property="og:type" content="product" />
                <meta property="og:title" content="thebag.bg - {{isset($metaDescription) ? $metaDescription['title_product'] : '' }}" />
                <meta property="og:description" content="{{isset($metaDescription) ? $metaDescription['title_product'] : '' }}" />
                <meta property="og:image" content="{{ asset('storage/upload_pictures')}}/{{ $product->id }}/{{ isset($metaDescription['upload_main_picture']) ? $metaDescription['upload_main_picture'] : '' }}" />
                <script src="//connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v2.11"></script>
            @endif
        @endif

        <base href="{{Request::getHost()}}" />
        <meta name="description" content="Дамски и мъжки чанти, куфари, портмонета, сакове. Пазарувай онлайн!" />
        <meta name="keywords" content="чанти, 4анти, chanti, дамски, мъжки, портмонета, раници, куфари, сакове, цени,  damski, оферти отстъпки, намеления, евтини." />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="index">
        <title>
            @if(isset($product))
                @if(isset($metaDescription))
                    {{ isset($metaDescription) ? $metaDescription['title_product'] : ' thebag.bg - Магазин за чанти, раници и куфари.' }}
                @else
                    thebag.bg - Магазин за чанти, раници и куфари.
                @endif
            @else
                thebag.bg - Магазин за чанти, раници и куфари.
            @endif
        </title>

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Marck+Script" rel="stylesheet">

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <script>
            $(document).ready(function () {
                var part_url = window.location.pathname.split('/')[1];

                if (part_url == 'admin') {
                    $("header").css('display', 'none')
                };
            });
        </script>

        <script src="{{ asset('js/jquery.imgareaselect.js') }}"></script>
    </head>

    <body>
        <header>
            @include('partials.horizontal_nav_bar')
        </header>

        <div class="wrapper-main-content">
            @yield('content')
            <div class="clearfix"/>
        </div>


        @include('partials.footer')

        <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
