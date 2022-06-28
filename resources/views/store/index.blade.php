@extends('layouts.app_shop')

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Търсене по име">
                                <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                </div>
                            </div>
                        </form>
                        <div class="dropdown ml-4">
                            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                Sort by
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                <a class="dropdown-item" href="#">Latest</a>
                                <a class="dropdown-item" href="#">Popularity</a>
                                <a class="dropdown-item" href="#">Best Rating</a>
                            </div>
                        </div>
                    </div>
                </div>


                @foreach($products as $idx => $product)
                    <?php $descriptions = json_decode($product->description, true); ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">

                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <!-- <img class="img-fluid w-100" src="img/product-1.jpg" alt="">-->

                                <a href="/store/{{ $product->id }}">
                                    @if (isset($descriptions['canvas_content_svg']))

                                        {!! json_decode($descriptions['canvas_content_svg'], false) !!}

                                    @endif
                                </a>

                            </div>

                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <a href="/store/{{ $product->id }}">
                                <h6 class="text-truncate mb-3">
                                    {{ $descriptions['title_product'] }}
                                </h6>
                            </a>

                            <div class="d-flex justify-content-center">
                                <h6>
                                    {{ isset($descriptions['price']) ? $descriptions['price'] : '' }}
                                    {{ isset($descriptions['currency']) ? $descriptions['currency'] : '' }}

                                </h6>

                                <h6 class="text-muted ml-2">
                                    <del>
                                        @if(isset($descriptions['old_price']))
                                            {{ $descriptions['old_price'] }}
                                            {{ isset($descriptions['currency']) ? $descriptions['currency'] : '' }}
                                        @endif
                                    </del>
                                </h6>
                            </div>

                        </div>


                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="/store/{{ $product->id }}" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-eye text-primary mr-1"></i>
                                Виж подробности
                            </a>

                            <a href="" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-shopping-cart text-primary mr-1"></i>
                                Добави

                                <?php if(Session::has('cart'))
                                {
                                    $oldCart = Session::get('cart');
                                    if(isset($oldCart->items[$product->id]['qty']))
                                    {
                                        $product_qty = $oldCart->items[$product->id]['qty'];
                                    }
                                }
                                ?>
                                @if(!empty($oldCart->items[$product->id]) )
                                    <sup id="sup-product-qty"> {{ isset($product_qty) ? $product_qty : '' }}</sup>
                                    <input id="quantity-product" type="hidden" value="{{ isset($product_qty) ? $product_qty + 1 : '1' }}"  >
                                @else
                                    <sup id="sup-product-qty"></sup>
                                    <input id="quantity-product" type="hidden" value="1"  >
                                @endif

                                <input id="id-product" type="hidden" value="{{ $product->id }}"/>
                            </a>

                        </div>
                    </div>
                </div>
                @endforeach


                <div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
    <!-- Shop End -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/521/fabric.min.js" integrity="sha512-nPzvcIhv7AtvjpNcnbr86eT6zGtiudLiLyVssCWLmvQHgR95VvkLX8mMpqNKWs1TG3Hnf+tvHpnGmpPS3yJIgw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>



    function renderSvg(id) {
        var canvas;
        var svg;
        console.log(id)
        console.log(jsonCanvas  )

        svg = JSON.parse(jsonCanvas);

        canvas = new fabric.Canvas(id);
        canvas.setDimensions({width:500, height:450});

        fabric.loadSVGFromString(svg, function(objects, options) {
            var obj = fabric.util.groupSVGElements(objects, options);
            canvas.add(obj).centerObject(obj).renderAll();
            obj.setCoords();
        });
    }

</script>

<script>
    $(window).resize(function () {
        var viewportWidth = $(window).width();

        if (viewportWidth < 800) {
            $("#vertical-nav-bar").css('display', 'none')
        }else{
            $("#vertical-nav-bar").css('display', 'inline-block')
        }
    });
</script>
@endsection