<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/casual-t-shirt-.png"/>
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if IE]>
    <script type="text/javascript" src="{{ asset('js/designer_js/excanvas.js')}}"></script><![endif]-->
    <script type="text/javascript" src="{{ asset('js/designer_js/fabric.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/designer_js/tshirtEditor.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/designer_js/jquery.miniColors.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/designer_js/html5.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/designer_js/loading.js')}}"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/eligrey/FileSaver.js/5733e40e5af936eb3f48554cf6a8a7075d71d18a/FileSaver.js"></script>

    <!-- Le styles -->
    <link href="{{ asset('css/designer_css/jquery.miniColors.css')}}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('css/designer_css/bootstrap.min.css')}}" rel="stylesheet">
    <link href=" {{ asset('css/designer_css/loader.css')}}" rel="stylesheet">
    <link href="{{ asset('css/designer_css/bootstrap-responsive.min.css')}}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script type="text/javascript">
    </script>
    <style type="text/css">
        .footer {
            padding: 70px 0;
            margin-top: 70px;
            border-top: 1px solid #E5E5E5;
            background-color: whiteSmoke;
        }

        body {
            padding-top: 60px;
        }

        .color-preview {
            border: 1px solid #CCC;
            margin: 2px;
            zoom: 1;
            vertical-align: top;
            display: inline-block;
            cursor: pointer;
            overflow: hidden;
            width: 20px;
            height: 20px;
        }

        .rotate {
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            /* filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1.5); */
            -ms-transform: rotate(90deg);
        }

        .Arial {
            font-family: "Arial";
        }

        .Helvetica {
            font-family: "Helvetica";
        }

        .MyriadPro {
            font-family: "Myriad Pro";
        }

        .Delicious {
            font-family: "Delicious";
        }

        .Verdana {
            font-family: "Verdana";
        }

        .Georgia {
            font-family: "Georgia";
        }

        .Courier {
            font-family: "Courier";
        }

        .ComicSansMS {
            font-family: "Comic Sans MS";
        }

        .Impact {
            font-family: "Impact";
        }

        .Monaco {
            font-family: "Monaco";
        }

        .Optima {
            font-family: "Optima";
        }

        .HoeflerText {
            font-family: "Hoefler Text";
        }

        .Plaster {
            font-family: "Plaster";
        }

        .Engagement {
            font-family: "Engagement";
        }

        .img-polaroid {
            padding: 0;
            margin: 0;
            border: 2px solid transparent;
            max-height: 92px;
            max-width: 92px;
            min-height: 92px;
            min-width: 92px;

        }

        .img-polaroid:hover {
            cursor: pointer;
            border-color: #00a5f7;
        }

        .tt {
            margin-right: 4px;
        }
    </style>
</head>

<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">

        @yield('content')


</body>
</html>
