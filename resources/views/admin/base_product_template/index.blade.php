@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <a class="btn btn-primary" href="/admin/base_product_template/create">Нова Щампа</a>
        <br>
        <br>

    <table class="table table-striped">
        <tr>
            <th>Template</th>
            <th>Name</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @if(isset($baseProductTemplates))
                @foreach($baseProductTemplates as $template)

                <?php $content = json_decode($template->content, true)?>

                <tr>
                    <td>
                        <div class="middle">
                            @foreach($content['images'] as $image )
                                <img src="{{ asset('img/img_templates/base_product_templates/') }}/{{$image}}" alt="pic" style="margin: 0 auto; width: 80px;height: 100px;"/>
                            @endforeach
                        </div>
                    </td>

                    <td>
                        <a href="/admin/base_product_template/{{ $template->id }}">{{ $content['name'] }}</a>
                    </td>

                    <td style="width:30%">
                        @include('admin.admin_partials.categories_loop')

                        @foreach($typePrintTemplates as $typePrintTemplate)
                            @if( $template->category_id == $typePrintTemplate->id)
                                <p>
                                    <b>Type:</b> {{ $typePrintTemplate->name }}
                                </p>
                            @endif
                        @endforeach
                    </td>

                    <td>
                        <a class="btn btn-default" href="/admin/base_product_template/{{ $template->id }}/edit">Промяна</a>
                    </td>

                    <td>
                        <form method="POST" action="/admin/base_product_template/{{ $template->id }}" accept-charset="UTF-8" class="pull-right">
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