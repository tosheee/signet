@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

    <h3>Слайдер</h3>
    <a class="btn btn-primary" href="/admin/slider/create">Нова снимка</a>
    <br><br>
    @if(count($sliders) > 0)
        <table class="table table-striped">
            <tr>
                <th>Id</th>
                <th>Picture</th>
                <th>Title</th>
                <th>Description</th>
                <th>Active</th>
                <th></th>
            </tr>
            @foreach($sliders as $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td>
                        <div class="middle">
                            <img style="margin: 0 auto; width: 120px;height: 100px;" src="/storage/common_pictures/{{ $slider->slider_img }}" alt="pic" />
                        </div>
                    </td>

                    <td>{{ $slider->title }}</td>
                    <td>{{ $slider->description }}</td>
                    <td>{{ $slider->active }}</td>
                    <td>
                        <form method="POST" action="/admin/slider/{{ $slider->id }}" accept-charset="UTF-8" class="pull-right">
                            {{ csrf_field() }}
                            <a class="btn btn-default" href="/admin/slider/{{ $slider->id }}/edit">
                                <i style="color: green;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn" type="submit"><i style="color: red;" class="fa fa-trash"></i></button>
                            <!--<input class="btn btn-danger" type="submit" value="Изтрий" style="width: 85px;">-->
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Няма снимки в слидера</p>
    @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection