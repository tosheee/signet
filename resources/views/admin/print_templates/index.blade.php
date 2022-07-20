@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <a class="btn btn-primary" href="/admin/print_templates/create">Нова Щампа</a>
        <br>
        <br>

    <table class="table table-striped">
        <tr>
            <th>Template</th>
            <th>Name</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @if(isset($print_templates))
                @foreach($print_templates as $template)
                <tr>
                    <td>
                        <b>{{ $template->id }}</b>
                    </td>

                    <td>
                        <div class="middle">
                            <img src="/storage/images/print_templates/{{$template->id}}/{{$template->name}}" alt="pic" style="margin: 0 auto; width: 80px;height: 100px;"/>
                        </div>
                    </td>

                    <td>
                        <a href="/admin/print_templates/{{ $template->id }}">{{ $template->name }}</a>
                    </td>

                    <td style="width:30%">
                        @foreach($adminCategories as $category)
                            @if( $template->category_id == $category->id)
                                <p>
                                    <b>Категория:</b> {{ $category->name }}
                                </p>
                            @endif
                        @endforeach

                        @foreach($subCategories as $subCategory)
                            @if( $template->sub_category_id == $subCategory->id)
                                <p>
                                    <b>Подкатегория:</b> {{ $subCategory->name }}
                                </p>
                            @endif
                        @endforeach

                            @foreach($typePrintTemplates as $typePrintTemplate)
                                @if( $template->category_id == $typePrintTemplate->id)
                                    <p>
                                        <b>Type:</b> {{ $typePrintTemplate->name }}
                                    </p>
                                @endif
                            @endforeach
                    </td>

                    <td>
                        <a class="btn btn-default" href="/admin/print_templates/{{ $template->id }}/edit">Промяна</a>
                    </td>

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