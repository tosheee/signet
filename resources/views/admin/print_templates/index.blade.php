@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <a class="btn btn-primary" href="/admin/print_templates/create">Нова Щампа</a>
        <br>
        <br>
        @if(isset($print_templates))
            <table class="table table-striped">
                <tr>
                    <th>Име на Щампата</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($print_templates as $template)
                    <tr>
                        <td><a href="/admin/print_templates/{{ $template->id }}">{{ $template->name }}</a></td>
                        <td><a class="btn btn-default" href="/admin/print_templates/{{ $template->id }}/edit">Промяна</a></td>
                        <td>
                            <form method="POST" action="/admin/print_templates/{{ $template->id }}" accept-charset="UTF-8" class="pull-right">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <input class="btn btn-danger" type="submit" value="Изтриване">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>Няма създадени категегории</p>
        @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection