@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')
    <h3>Съобщение от подръжката</h3>
    <a class="btn btn-primary" href="/admin/support_messages/create">Ново съобщение</a>
    <br><br>
    @if(count($supportMessages) > 0)
        <table class="table table-striped">
            <tr>
                <th>Идентификатор</th>
                <th>Съдържание</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($supportMessages as $supportMessage)
                <tr>
                    <td>{{ $supportMessage->name_support_messages }}</td>
                    <td>{!! $supportMessage->content_support_messages !!}</td>
                    <td><a class="btn btn-default" href="/admin/support_messages/{{ $supportMessage->id }}/edit">Промяна</a></td>
                    <td>
                        <form method="POST" action="/admin/support_messages/{{ $supportMessage->id }}" accept-charset="UTF-8" class="pull-right">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <input class="btn btn-danger" type="submit" value="Изтрий">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Няма подкатегории</p>
    @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection