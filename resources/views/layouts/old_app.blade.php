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
            <meta property="og:title" content=" - {{isset($metaDescription) ? $metaDescription['title_product'] : '' }}" />
            <meta property="og:description" content="{{isset($metaDescription) ? $metaDescription['title_product'] : '' }}" />
            <meta property="og:image" content="{{ asset('storage/upload_pictures')}}/{{ $product->id }}/{{ isset($metaDescription['upload_main_picture']) ? $metaDescription['upload_main_picture'] : '' }}" />
            <script src="//connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v2.11"></script>
        @endif
    @endif

    <base href="{{Request::getHost()}}" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index">
    <title>
        @if(isset($product))
            @if(isset($metaDescription))
                {{ isset($metaDescription) ? $metaDescription['title_product'] : 'text' }}
            @else
                text
            @endif
        @else
            text
        @endif
    </title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/shop_css/style.css" rel="stylesheet">
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
    @include('partials.old_horizontal_nav_bar')
</header>

<div class="wrapper-main-content">
    @yield('content')
    <div class="clearfix"/>
</div>


@include('partials.old_footer')

<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
</body>
</html>
