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
        <style>
            .file-upload {
                background-color: #ffffff;
                width: 600px;
                margin: 0 auto;
                padding: 20px;
            }

            .file-upload-btn {
                width: 100%;
                margin: 0;
                color: #fff;
                background: rgba(172, 178, 177, 0.59);
                border: none;
                padding: 10px;
                border-radius: 1px;
                border-bottom: 1px solid #bdd5dc;
                transition: all .2s ease;
                outline: none;
                text-transform: uppercase;
                font-weight: 700;
            }

            .file-upload-btn:hover {
                background: #acb2b1;
                color: #ffffff;
                transition: all .2s ease;
                cursor: pointer;
            }

            .file-upload-btn:active {
                border: 0;
                transition: all .2s ease;
            }

            .file-upload-content {
                display: none;
                text-align: center;
            }

            .file-upload-input {
                position: absolute;
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
                outline: none;
                opacity: 0;
                cursor: pointer;
            }

            .image-upload-wrap {
                margin-top: 20px;
                border: 1px dashed #bdd5dc;
                position: relative;
            }

            .image-dropping,
            .image-upload-wrap:hover {
                background-color: #acb2b1;
                border: 1px dashed #ffffff;
            }

            .image-title-wrap {
                padding: 0 15px 15px 15px;
                color: #222;
            }

            .drag-text {
                text-align: center;
            }

            .drag-text h3 {
                font-weight: 100;
                text-transform: uppercase;
                color: #bdd5dc;
                padding: 60px 0;
            }

            .file-upload-image {
                max-height: 200px;
                max-width: 200px;
                margin: auto;
                padding: 20px;
            }

            .remove-image {

                margin: 0;
                color: #fff;
                background: #cd4535;
                border: none;
                padding: 10px;
                border-radius: 1px;
                border-bottom: 1px solid #b02818;
                transition: all .2s ease;
                outline: none;
                text-transform: uppercase;
            }

            .remove-image:hover {
                background: #c13b2a;
                color: #ffffff;
                transition: all .2s ease;
                cursor: pointer;
            }

            .remove-image:active {
                border: 0;
                transition: all .2s ease;
            }
        </style>
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
