@extends('layouts.old_app')

@section('content')

        <div class="col-md-2" id="vertical-nav-bar">
            @include('partials.old_vertical_navigation')
        </div>

    <div class="col-md-9">
        <div class="row">
            <div style="margin-left: 15%;">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection