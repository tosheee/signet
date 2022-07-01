<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>EShopper - Bootstrap Shop Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free HTML Templates" name="keywords">
        <meta content="Free HTML Templates" name="description">

        <base href="{{Request::getHost()}}" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="index">

        <!-- Favicon -->
        <link href="" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('js/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('css/shop_css/style.css')}}" rel="stylesheet">
        <link href="{{ asset('css/users_forms.css')}}" rel="stylesheet">
    </head>

    <body>


        @include('partials.nav_bar_top')
        @include('partials.nav_bar_bottom')

        @yield('content')

        @include('partials.footer')

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/lib/easing/easing.min.js')}}"></script>
        <script src="{{ asset('js/lib/owlcarousel/owl.carousel.min.js')}}"></script>

        <!-- Contact Javascript File -->
        <script src="{{ asset('mail/jqBootstrapValidation.min.js')}}"></script>
        <script src="{{ asset('mail/contact.js')}}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('js/main.js')}}"></script>

        <script>
            $( ".add-product-button" ).click(function() {
                var idProductShowPage = $('#id-product-show-page').val();
                var add_product_button = $(this);
                var idProduct = $(this).find('#id-product').val();
                var quantityProductWrapper = $(this).find('#quantity-product');
                var quantityProduct = quantityProductWrapper.val();

                var oldCard = "{{ Session::get('cart')->totalQty }}";
                console.log(oldCard);

                if(typeof idProductShowPage != "undefined"){
                    idProduct = idProductShowPage;
                    quantityProduct = $('.show-page#quantity-product').html();
                }

                var shopingCardTop = $('#shoping-card-top');
                shopingCardTop.html(parseInt(shopingCardTop.text())+1);


                $.ajax({
                    method: "POST",
                    url: "/add-to-cart?product_id=" + idProduct + "&product_quantity=" + quantityProduct,
                    data: { "_token": $('meta[name="_token"]').attr('content') },
                    success: function( new_cart ) {
                        //updateCart(new_cart);


                        add_product_button.find('#sup-product-qty').html(quantityProduct);
                        add_product_button.find('#quantity-product').val(parseInt(quantityProduct) + 1);

                        $('#shoping-card-top').html()
                        // $('.price.totalPrice strong').html(parseFloat(new_cart[0]).toFixed(2));
                        // add_product_button.parent().parent().parent().find('b#common-product-price-sc').html(items_obj[idProduct]['total_item_price'] + ' лв.');
                        // add_product_button.parent().parent().parent().find('b#common-product-qty-sc').html(quantityProduct);

                        //$('.totalspent-orders h2').html(parseFloat(new_cart[0]).toFixed(2) + ' лв.')
                        //$('.printqty-orders h2').html(new_cart[1] + ' бр.')
                    }
                });
            });
        </script>

    </body>

</html>