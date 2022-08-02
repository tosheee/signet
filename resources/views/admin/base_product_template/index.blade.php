@extends('layouts.app_admin')
@section('content')
    @include('admin.admin_partials.admin_menu')

        <a class="btn btn-primary" href="/admin/base_product_template/create">New Template</a>
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
        @if(isset($baseProductTemplates))
                @foreach($baseProductTemplates as $template)

                <?php $content = json_decode($template->content, true)?>

                <tr>
                    <td>
                        <b>{{ $template->id }}</b>
                    </td>

                    <td>
                        <div class="middle">
                            @if (isset($content['images']))
                                @foreach($content['images'] as $image )
                                    <img src="/storage/images/base_templates/{{$template->id}}/{{$image}}" alt="pic" style="margin: 0 auto; width: 80px;height: 100px;"/>
                                    <p>{{$image}}</p>
                                @endforeach
                            @endif
                        </div>
                    </td>

                    <td>
                        <a href="/admin/base_product_template/{{ $template->id }}">{{ $content['name'] }}</a>
                    </td>

                    <td style="width:30%">
                        @include('admin.admin_partials.categories_loop')

                        @foreach($typePrintTemplates as $typePrintTemplate)
                            @if( $template->category_id == $typePrintTemplate->id)
                                <p><b>Type:</b> {{ $typePrintTemplate->name }}</p>
                            @endif
                        @endforeach
                    </td>

                    <td>
                        <a class="btn btn-default" href="/admin/base_product_template/{{ $template->id }}/edit">Update</a>
                    </td>

                    <td>
                        <form method="POST" action="/admin/base_product_template/{{ $template->id }}" accept-charset="UTF-8" class="pull-right">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                    </td>

                </tr>
                @endforeach
            </table>

            <div style="text-align: center;">
                @if( method_exists($baseProductTemplates,'links') )
                    {{  $baseProductTemplates->links() }}
                @endif
            </div>
        @else
            <h1>The table is empty</h1>
        @endif

    @include('admin.admin_partials.admin_menu_bottom')
@endsection