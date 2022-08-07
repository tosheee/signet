@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <a class="btn btn-primary" href="/admin/categories/create">Нова категория</a>
        <br>
        <br>
        @if(count($categories) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Identifier</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($categories as $category)
                    <tr>
                        <td><b>{{ $category->id }}</b></td>
                        <td><a href="/admin/categories/{{ $category->id }}">{{ $category->name }}</a></td>
                        <td><a href="/admin/categories/{{ $category->id }}">{{ $category->identifier }}</a></td>

                        <td><b>Filters:</b> {{ $category->filters or 'There is not' }}</td>
                        <td>
                            <form method="POST" action="/admin/categories/{{ $category->id }}" accept-charset="UTF-8" class="pull-right">
                                {{ csrf_field() }}
                                <a class="btn btn-default" href="/admin/categories/{{ $category->id }}/edit">
                                    <i style="color: green;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn" type="submit"><i style="color: red;" class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            <div style="text-align: center;">
                @if( method_exists($categories,'links') )
                    {{  $categories->links() }}
                @endif
            </div>

        @else
            <p>Няма създадени категегории</p>
        @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection