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
            $(".add-product-button" ).click(function() {
                var idProductShowPage = $('#id-product-show-page').val();
                var add_product_button = $(this);
                var idProduct = $(this).find('#id-product').val();
                var quantityProductWrapper = $(this).find('#quantity-product');
                var quantityProduct = quantityProductWrapper.val();

                var oldCard = "{{ Session::get('cart')->totalQty ?? ''}}";
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




        <script>
            $(document).ready(function($){
                window.addEventListener('message', listenMessage, false);
                function listenMessage(event) {
                    var result = event.data;
                    if(typeof result === 'string'){
                        var full_address = result.split("||")

                        $('#select2-billing_country-container').text('Bulgaria');
                        $('#select2-billing_country-container').prop('readonly', true);


                        $('#billing_city').text(full_address[1]);
                        $('#billing_city').val(full_address[1]);

                        if (full_address[3] != undefined) {
                            $('#select-search-city').attr("disabled", true);
                        }

                        if (full_address[3] != undefined){
                            $('#billing_address_1').val('Офис на Еконт:'+ full_address[3]);
                            $('#billing_address_1').prop('readonly', true);
                        }

                        $('#billing_postcode').val(full_address[0]);
                        $('#billing_postcode').prop('readonly', true);

                        $('.close').click();
                    }
                }


                $('#remove-addres').click(function(){
                    //$('#select-search-city').find(":selected").text();
                    $('#select-search-city').attr("disabled", false);
                    $("select#select-search-city option").filter(":selected").prop("selected", false);


                    $('#billing_address_1').val('');
                    $('#billing_address_1').prop('readonly', false);
                    //$('#billing_city').text('');
                    $('#billing_city').val('');

                });




                $('.remove').on('click','.remove-item-button', function() {
                    var remove_item_button = $(this);
                    var idProduct = $(this).find('#id-product').val();

                    $.ajax({
                        method: "post",
                        url: "/remove/" + idProduct,
                        data: { "_token": $('meta[name="_token"]').attr('content') },
                        success: function( new_cart ) {

                            if(new_cart[0] == 0)
                            {
                                window.location.href = '/';
                            }
                            else
                            {
                                updateCart(new_cart)
                            }
                            var row_tr = remove_item_button.parent().parent();
                            row_tr.remove();
                        }
                    });
                });

                function updateCart(new_cart){
                    $('#nav-total-price').html(new_cart[0]);
                    // $('ol.items').children().remove();
                    // $('sup.text-primary').html(new_cart[1]);
                    var items_obj = $.each( new_cart[2], function( _, value ){ value });

                    $.each(items_obj, function(product_id, value){
                       console.log(value)
                    });

                    //$('ol.items').append('<h5 class="cart-bottom-total-price">Общо: '+ parseFloat(new_cart[0]).toFixed(2) +' лв.</h5>').css({'text-align': 'center', 'color': '#000000'});

                    //if($('div.cart-footer').length < 1){
                       // $('ul.dropdown-menu.cart.w-250').append(
                         //       '<li>'
                           //     + '<div class="cart-footer">'
                             //   + '<a href="/shopping-cart" class="pull-left"><i class="fa fa-cart-plus mr-5"></i> Количка</a>'
                               // + '<a href="/checkout" class="pull-right"><i class="fa fa-money" aria-hidden="true"></i> Плащане</a>'
                                //+ '</div>'
                                //+ '</li>'
                        //);
                    //}

                    $('#basket-total-price').html(parseFloat(new_cart[0]).toFixed(2) + ' лв.')
                    $('#basket-total-qty').html(new_cart[1] + ' бр.')
                }


                $('.btn.btn-sm.btn-primary').click(function(){
                    var qtyBox = $(this).parent().parent();
                    var itemQty = qtyBox.find('input.product-qty').val();
                    var itemRow = qtyBox.parent().parent();
                    var itemPrice = itemRow.find('.row-price').data('content');
                    var itemTotalPrice = itemRow.find('.item-total-price');
                    itemTotalPrice.text(itemPrice*itemQty + ' лв.');

                    var totalItems = $('#basket-total-qty');


                    $('#basket-total-qty').data('content')


                    if($(this).hasClass('btn-minus')){
                        totalItems.html(totalItems.data('content') - 1 + ' бр.');
                    }

                    if($(this).hasClass('btn-plus'))
                    {
                        totalItems.html(totalItems.data('content') + 1 + ' бр.');
                    }

                    // $('#basket-total-price').html(parseFloat(new_cart[0]).toFixed(2) + ' лв.')
                    //$('#basket-total-qty').html(new_cart[1] + ' бр.')

                    //$('.cart-items')



                });





            });
        </script>

    </body>

</html>