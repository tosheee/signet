@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

    <h3>Слайдер</h3>
    <a class="btn btn-primary" href="/admin/slider/create">Нова снимка</a>
    <br><br>
    @if(count($sliders) > 0)
        <table class="table table-striped">
            <tr>
                <th>Снимка</th>
                <th>Заглавие</th>
                <th>Описание</th>
                <th></th>
            </tr>
            @foreach($sliders as $slider)
                <tr>
                    <td>
                        <div class="middle">
                            <img style="margin: 0 auto; width: 120px;height: 100px;" src="/storage/common_pictures/{{ $slider->slider_img }}" alt="pic" />
                        </div>
                    </td>

                    <td>{{ $slider->title }}</td>
                    <td>{{ $slider->description }}</td>

                    <td width="50px">
                        <a class="btn btn-default" href="/admin/slider/{{ $slider->id }}/edit">Промяна</a>
                        <br/>
                        <br/>
                        <form method="POST" action="/admin/slider/{{ $slider->id }}" accept-charset="UTF-8" class="pull-right">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <input class="btn btn-danger" type="submit" value="Изтрий" style="width: 85px;">
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