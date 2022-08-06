@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')
        <h3>Type Pring Template</h3>
        <a class="btn btn-primary" href="/admin/type_print_templates/create">New</a>
        <br><br>
        @if(count($typePrintTemplates) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Identifier</th>
                    <th></th>
                    <th></th>
                </tr>

                @foreach($typePrintTemplates as $typePrintTemplate)
                    <tr>
                        <td>{{$typePrintTemplate->id}}</td>
                        @foreach($categories as $category)
                            @if($typePrintTemplate->category_id == $category->id)
                                <td>{{ $category->name }} </td>
                            @endif
                        @endforeach
                        <td><a href="/admin/type_print_template/{{ $typePrintTemplate->id }}">{{ $typePrintTemplate->name }}</a></td>
                        <td>{{ $typePrintTemplate->identifier }}</td>
                        <td><a class="btn btn-default" href="/admin/type_print_template/{{ $typePrintTemplate->id }}/edit">Промяна</a></td>
                        <td>
                            <form method="POST" action="/admin/sub_categories/{{ $typePrintTemplate->id }}" accept-charset="UTF-8" class="pull-right">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <input class="btn btn-danger" type="submit" value="Изтрий">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p> There is not Type print templates</p>
        @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection