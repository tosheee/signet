    $('ol.items, p#button-wrapper-sc').on('click','.remove-item-button', function() {
        var remove_item_button = $(this);
        var idProduct = $(this).find('#id-product').val();
        var row_product = remove_item_button.parent().parent().parent();

        $.ajax({
            method: "post",
            url: "/remove/" + idProduct,
            data: { "_token": $('meta[name="_token"]').attr('content') },
            success: function( new_cart ) {
                if(new_cart[0] == 0) {
                    $('ol.items').children().remove();
                    $('#nav-total-price').remove();
                    $('div.cart-footer').remove();
                    $('span.hidden-xs').find('.text-primary').html('');

                    if(window.location.pathname == '/shopping-cart')
                    {
                        window.location.href = '/';
                    }

                    $('ol.items').append('<li style="text-align: center; color: #ff1018;"><strong> Вашата количката е празна!<strong> </li>');

                    var buttons = $('.add-product-button.add_to_cart');
                    buttons.each(function(){
                        if($(this).find('#id-product').val() == idProduct){
                            $(this).find('#sup-product-qty').html('');
                            $(this).find('#quantity-product').val(1);
                        }
                    });
                }
                else {
                    updateCart(new_cart);
                    var buttons = $('.add-product-button.add_to_cart');
                    buttons.each(function(){
                        if($(this).find('#id-product').val() == idProduct){
                            $(this).find('#sup-product-qty').html('');
                            $(this).find('#quantity-product').val(1);
                        }
                    });
                    $('.price.totalPrice strong').html(parseFloat(new_cart[0]).toFixed(2));
                }
            }
        });
    });

    $( ".quantity-field" ).click(function() {
        var quantity_wrapper = $(this).parent();
        var idProduct = quantity_wrapper.find('#id-product').val();
        console.log(quantity_wrapper);
        var  quantityProduct = $(this).val();
        var priceProduct = quantity_wrapper.parent().find('.price-shopping-cart strong').html();

        quantity_wrapper.parent().find('.subtotal').html(parseFloat(priceProduct * quantityProduct).toFixed(2) + ' лв.');
        /*
        $.ajax({
            method: "POST",
            url: "/add-to-cart?product_id=" + idProduct + "&product_quantity=" + quantityProduct,
            data: { "_token": $('meta[name="_token"]').attr('content') },
            success: function( new_cart ) {
                updateCart(new_cart);
            }
        });
        */
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

    $( ".add-product-button" ).click(function() {
        console.log('alabala')
        var idProductShowPage = $('#id-product-show-page').val();
        var add_product_button = $(this);
        var idProduct = $(this).find('#id-product').val();
        var quantityProductWrapper = $(this).find('#quantity-product');
        var quantityProduct = quantityProductWrapper.val();

        if(typeof idProductShowPage != "undefined"){
            idProduct = idProductShowPage;
            quantityProduct = $('.show-page#quantity-product').html();
        }

        $.ajax({
            method: "POST",
            url: "/add-to-cart?product_id=" + idProduct + "&product_quantity=" + quantityProduct,
            data: { "_token": $('meta[name="_token"]').attr('content') },
            success: function( new_cart ) {
                updateCart(new_cart);
                add_product_button.find('#sup-product-qty').html(quantityProduct);
                add_product_button.find('#quantity-product').val(parseInt(quantityProduct) + 1);
                $('.price.totalPrice strong').html(parseFloat(new_cart[0]).toFixed(2));
               // add_product_button.parent().parent().parent().find('b#common-product-price-sc').html(items_obj[idProduct]['total_item_price'] + ' лв.');
                //add_product_button.parent().parent().parent().find('b#common-product-qty-sc').html(quantityProduct);

                $('.totalspent-orders h2').html(parseFloat(new_cart[0]).toFixed(2) + ' лв.')
                $('.printqty-orders h2').html(new_cart[1] + ' бр.')
            }
        });
    });

    function updateCart(new_cart){
        $('#nav-total-price').html(new_cart[0]);
        $('ol.items').children().remove();
        $('sup.text-primary').html(new_cart[1]);
        var items_obj = $.each( new_cart[2], function( _, value ){ value });

        $.each(items_obj, function(product_id, value){
            $('ol.items').append('<li><a href="#" class="product-image"><img src=" '+ value['item_pic'] +' "class="img-responsive"></a>'
            + '<div class="product-details">'
            + '<div class="close-icon">'
            + '<button type="button" class="remove-item-button btn-danger" style="background: transparent; border-color: #ffffff; border-style: solid;" >'
            + '<input id="id-product" type="hidden" value="'+ product_id +'"/>'
            + '<i class="fa fa-close" style="color: #ff0000"></i>'
            + '</button>'
            + ' </div>'
            + '<p class="product-name"> <a href="/store/'+ product_id +'" target="_blank">'+ value['item_title'] +'</a></p>'
            + '<strong id="product-qty">'+ value['qty'] +'</strong> x <span class="price text-primary">'+ value['item_price'] +' лв.</span>'
            + '</div></li>');
        });

        $('ol.items').append('<h5 class="cart-bottom-total-price">Общо: '+ parseFloat(new_cart[0]).toFixed(2) +' лв.</h5>').css({'text-align': 'center', 'color': '#000000'});

        if($('div.cart-footer').length < 1){
            $('ul.dropdown-menu.cart.w-250').append(
                '<li>'
                + '<div class="cart-footer">'
                + '<a href="/shopping-cart" class="pull-left"><i class="fa fa-cart-plus mr-5"></i> Количка</a>'
                + '<a href="/checkout" class="pull-right"><i class="fa fa-money" aria-hidden="true"></i> Плащане</a>'
                + '</div>'
                + '</li>'
            );
        }

        $('#basket-total').html(parseFloat(new_cart[0]).toFixed(2) + ' лв.')
        $('#basket-subtotal').html(new_cart[1] + ' бр.')
    }



    $(document).ready(function(){

        $(".largeGrid").click(function(){
            $(this).find('a').addClass('active');
            $('.smallGrid a').removeClass('active');

            $('#grid').find('.product_content').removeClass( "col-md-4" );
            //$( "p" ).removeClass( "myClass noClass" ).addClass( "yourClass" );

            $('.product').addClass('large').each(function(){
            });
            setTimeout(function(){
                $('.info-large').show();
            }, 200);
            setTimeout(function(){

                $('.view_gallery').trigger("click");
            }, 400);

            return false;
        });

        $(".smallGrid").click(function(){
            $(this).find('a').addClass('active');
            $('.largeGrid a').removeClass('active');
            $('#grid').find('.product_content').addClass( "col-md-4" );
            //$( "p" ).removeClass( "myClass noClass" ).addClass( "yourClass" );

            $('div.product').removeClass('large');
            $(".make3D").removeClass('animate');
            $('.info-large').fadeOut("fast");
            setTimeout(function(){
                $('div.flip-back').trigger("click");
            }, 400);
            return false;
        });

        $(".smallGrid").click(function(){
            $('.product').removeClass('large');
            return false;
        });

        $('.colors-large a').click(function(){return false;});


        $('.product').each(function(i, el){

            // Lift card and show stats on Mouseover
            $(el).find('.make3D').hover(function(){
                $(this).parent().css('z-index', "20");
                $(this).addClass('animate');
                $(this).find('div.carouselNext, div.carouselPrev').addClass('visible');
                $(this).find('.view_product').css('opacity', '1')
            }, function(){
                $(this).removeClass('animate');
                $(this).parent().css('z-index', "1");
                $(this).find('div.carouselNext, div.carouselPrev').removeClass('visible');
                $(this).find('.view_product').css('opacity', '0')
            });

            // Flip card to the back side
            $(el).find('.view_gallery').click(function(){

                $(el).find('div.carouselNext, div.carouselPrev').removeClass('visible');
                $(el).find('.make3D').addClass('flip-10');
                setTimeout(function(){
                    $(el).find('.make3D').removeClass('flip-10').addClass('flip90').find('div.shadow').show().fadeTo( 80 , 1, function(){
                        $(el).find('.product-front, .product-front div.shadow').hide();
                    });
                }, 50);

                setTimeout(function(){
                    $(el).find('.make3D').removeClass('flip90').addClass('flip190');
                    $(el).find('.product-back').show().find('div.shadow').show().fadeTo( 90 , 0);
                    setTimeout(function(){
                        $(el).find('.make3D').removeClass('flip190').addClass('flip180').find('div.shadow').hide();
                        setTimeout(function(){
                            $(el).find('.make3D').css('transition', '100ms ease-out');
                            $(el).find('.cx, .cy').addClass('s1');
                            setTimeout(function(){$(el).find('.cx, .cy').addClass('s2');}, 100);
                            setTimeout(function(){$(el).find('.cx, .cy').addClass('s3');}, 200);
                            $(el).find('div.carouselNext, div.carouselPrev').addClass('visible');
                        }, 100);
                    }, 100);
                }, 150);
            });

            // Flip card back to the front side
            $(el).find('.flip-back').click(function(){

                $(el).find('.make3D').removeClass('flip180').addClass('flip190');
                setTimeout(function(){
                    $(el).find('.make3D').removeClass('flip190').addClass('flip90');

                    $(el).find('.product-back div.shadow').css('opacity', 0).fadeTo( 100 , 1, function(){
                        $(el).find('.product-back, .product-back div.shadow').hide();
                        $(el).find('.product-front, .product-front div.shadow').show();
                    });
                }, 50);

                setTimeout(function(){
                    $(el).find('.make3D').removeClass('flip90').addClass('flip-10');
                    $(el).find('.product-front div.shadow').show().fadeTo( 100 , 0);
                    setTimeout(function(){
                        $(el).find('.product-front div.shadow').hide();
                        $(el).find('.make3D').removeClass('flip-10').css('transition', '100ms ease-out');
                        $(el).find('.cx, .cy').removeClass('s1 s2 s3');
                    }, 100);
                }, 150);

            });

            makeCarousel(el);
        });

        $('.add-cart-large').each(function(i, el){
            $(el).click(function(){
                var carousel = $(this).parent().parent().find(".carousel-container");
                var img = carousel.find('img').eq(carousel.attr("rel"))[0];
                var position = $(img).offset();
                console.log(position);

                var productName = $(this).parent().find('h4').get(0).innerHTML;

                $("body").append('<div class="floating-cart"></div>');
                var cart = $('div.floating-cart');
                $("<img width='20' height='20' src='"+img.src+"' class='floating-image-large' />").appendTo(cart);

                $(cart).css({'top' : position.top + 'px', "right" : position.right + 'px'}).fadeIn("slow").addClass('moveToCart');
                setTimeout(function(){$("body").addClass("MakeFloatingCart");}, 800);

                setTimeout(function(){
                    $('div.floating-cart').remove();
                    $("body").removeClass("MakeFloatingCart");


                    var cartItem = "<div class='cart-item'><div class='img-wrap'><img src='"+img.src+"' alt='' /></div><span>"+productName+"</span><strong>$39</strong><div class='cart-item-border'></div><div class='delete-item'></div></div>";

                    $("#cart .empty").hide();
                    $("#cart").append(cartItem);
                    $("#checkout").fadeIn(500);

                    $("#cart .cart-item").last()
                        .addClass("flash")
                        .find(".delete-item").click(function(){
                            $(this).parent().fadeOut(300, function(){
                                $(this).remove();
                                if($("#cart .cart-item").size() == 0){
                                    $("#cart .empty").fadeIn(500);
                                    $("#checkout").fadeOut(500);
                                }
                            })
                        });
                    setTimeout(function(){
                        $("#cart .cart-item").last().removeClass("flash");
                    }, 10 );

                }, 1000);


            });
        });

        /* ----  Image Gallery Carousel   ---- */
        function makeCarousel(el){


            var carousel = $(el).find('.carousel ul');
            var carouselSlideWidth = 315;
            var carouselWidth = 0;
            var isAnimating = false;
            var currSlide = 0;
            $(carousel).attr('rel', currSlide);

            // building the width of the casousel
            $(carousel).find('li').each(function(){
                carouselWidth += carouselSlideWidth;
            });
            $(carousel).css('width', carouselWidth);

            // Load Next Image
            $(el).find('div.carouselNext').on('click', function(){
                var currentLeft = Math.abs(parseInt($(carousel).css("left")));
                var newLeft = currentLeft + carouselSlideWidth;
                if(newLeft == carouselWidth || isAnimating === true){return;}
                $(carousel).css({'left': "-" + newLeft + "px",
                    "transition": "300ms ease-out"
                });
                isAnimating = true;
                currSlide++;
                $(carousel).attr('rel', currSlide);
                setTimeout(function(){isAnimating = false;}, 300);
            });

            // Load Previous Image
            $(el).find('div.carouselPrev').on('click', function(){
                var currentLeft = Math.abs(parseInt($(carousel).css("left")));
                var newLeft = currentLeft - carouselSlideWidth;
                if(newLeft < 0  || isAnimating === true){return;}
                $(carousel).css({'left': "-" + newLeft + "px",
                    "transition": "300ms ease-out"
                });
                isAnimating = true;
                currSlide--;
                $(carousel).attr('rel', currSlide);
                setTimeout(function(){isAnimating = false;}, 300);
            });
        }

        $('.sizes a span, .categories a span').each(function(i, el){
            $(el).append('<span class="x"></span><span class="y"></span>');

            $(el).parent().on('click', function(){
                if($(this).hasClass('checked')){
                    $(el).find('.y').removeClass('animate');
                    setTimeout(function(){
                        $(el).find('.x').removeClass('animate');
                    }, 50);
                    $(this).removeClass('checked');
                    return false;
                }

                $(el).find('.x').addClass('animate');
                setTimeout(function(){
                    $(el).find('.y').addClass('animate');
                }, 100);
                $(this).addClass('checked');
                return false;
            });
        });

        $('.add_to_cart').click(function(){
            var productCard = $(this).parent();
            var position = productCard.offset();
            var productImage = $(productCard).find('img').get(0).src;
            var productName = $(productCard).find('.product_name').get(0).innerHTML;

            var kolichka = $('#new-view-cart').offset();

            console.log(kolichka.top);

            $("body").append('<div class="floating-cart"></div>');
            var window_width = $( window ).width();
            var cart = $('div.floating-cart');
            productCard.clone().appendTo(cart);
            $(cart).css({'top' : position.top + 'px', "left" : position.left + 'px'}).fadeIn("slow").addClass('moveToCart').animate({left: kolichka.left + 'px', top: '-10px'});;
            setTimeout(function(){$("body").addClass("MakeFloatingCart").css('left', '2000px');}, 800);
            setTimeout(function(){
                $('div.floating-cart').remove();
                $("body").removeClass("MakeFloatingCart");


                var cartItem = "<div class='cart-item'><div class='img-wrap'><img src='"+productImage+"' alt='' /></div><span>"+productName+"</span><strong>$39</strong><div class='cart-item-border'></div><div class='delete-item'></div></div>";

                $("#cart .empty").hide();
                $("#cart").append(cartItem);
                $("#checkout").fadeIn(500);

                $("#cart .cart-item").last()
                    .addClass("flash")
                    .find(".delete-item").click(function(){
                        $(this).parent().fadeOut(300, function(){
                            $(this).remove();
                            if($("#cart .cart-item").size() == 0){
                                $("#cart .empty").fadeIn(500);
                                $("#checkout").fadeOut(500);
                            }
                        })
                    });
                setTimeout(function(){
                    $("#cart .cart-item").last().removeClass("flash");
                }, 10 );

            }, 1000);
        });
    });