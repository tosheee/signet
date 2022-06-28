@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')
        <h3>Съобщения от потребител</h3>
        <p><a href="https://www.floromaniq.com:2096/cpsess4925761050/webmail/paper_lantern/index.html?mailclient=roundcube" target="_blank">Mail FloroManiq </a></p>
        <p><a href="https://www.abv.bg/" target="_blank">Към abv.bg</a></p>
        
        <br><br>
        @if(count($subCategories) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Потребител</th>
                    <th>Съобщение</th>
                    <th></th>
                </tr>
                @foreach($userMessages as $userMessage)
                    <tr>
                        <td>
                            Име:   {{ $userMessage->name }} <br>
                            Имейл: {{ $userMessage->email }} <br>
                            Дата:  {{ $userMessage->created_at }}
                         </td>
                        
                        <td>{{ $userMessage->message }}</td>
                        
                        <td class="pull-right">
                             @if($userMessage->answer == 1)
                                <a class="btn btn-warning" href="/admin/answer/{{ $userMessage->id }}">Маркирай като не прочетено</a>
                            @else
                                <a class="btn btn-primary" href="/admin/answer/{{ $userMessage->id }}">Маркирай като прочетено </a>
                            @endif
                            
                            <br>
                            <br>
                            <form method="POST" action="/admin/user_messages/{{ $userMessage->id }}" accept-charset="UTF-8" class="pull-right">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <input class="btn btn-danger" type="submit" value="Изтрий">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
             
        @else
            <p>Няма съобщения</p>
        @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection