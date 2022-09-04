@extends('layouts.app')

@section('content')

        <!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 30px">

        <div class="btn-group" role="group" aria-label="Basic example">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
{{ $categoryName ?? '' }}
            </button>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#stamps">
                Щампи
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $categoryName ?? '' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="avatarlist" >
                            @if(isset($baseProductTemplates))
                                @foreach($baseProductTemplates as $image)
                                    <?php $content = json_decode($image->content, true)?>
                                    @foreach($content['images'] as $img )
                                            <div class="col-md-3 col-sm-4 col-6 py-2">
                                        <img class="add-base-img tt" width="50" height="50" src="{{$img}}" alt="pic" style="margin: 0 auto; width: 80px;height: 100px;"/>
                                    </div>
                                    @endforeach

                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>


        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="stamps" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stamps">Щампи</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="avatarlist">
                            @if(isset($printTemplates))
                                @foreach($printTemplates as $printImg)
                                    <?php $printImgContent = json_decode($printImg->content, true)?>
                                    @foreach($printImgContent['images'] as $imgPrint )
                                        <div class="col-md-3 col-sm-4 col-6 py-2">
                                            <img class="img-polaroid tt" width="80" height="80" src="{{$imgPrint}}" alt="pic" style="margin: 0 auto; width: 80px;height: 100px;"/>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Page Header End -->

<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!--Sidebar Start -->
        <div class="col-lg-3 col-md-12">


        </div>

        <!--Sidebar Start -->
        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12" style="">
            <div class="row pb-3">

                <div class="pull-right" align="" id="imageeditor" style="">
                    <div class="btn-group">
                        <button class="btn" id="bring-to-front" title="Bring to Front"><i class="icon-fast-backward rotate" style="height:19px;"></i></button>
                        <button class="btn" id="send-to-back" title="Send to Back"><i class="icon-fast-forward rotate" style="height:19px;"></i></button>
                        <button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>
                        <button id="remove-selected" class="btn" title="Delete selected item"><i class="icon-trash" style="height:19px;"></i></button>
                    </div>
                </div>
                <br><br>

                <div id="desing-wrappers" style="text-align: -webkit-center;">
                    <div class="desing-wrapper">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
        <!-- Shop Product End -->
        </div>
    </div>
</div>





<!-- Shop End -->
@include('designer.designer_scripts')
@endsection