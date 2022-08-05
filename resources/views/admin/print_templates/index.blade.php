@extends('layouts.app_admin')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <a class="btn btn-primary" href="/admin/print_templates/create">New stamps</a>
        <br>
        <br>

    <table class="table table-striped">
        <tr>
            <th>Id</th>
            <th>Pic</th>
            <th>Name</th>
            <th>Props</th>
            <th></th>
            <th></th>
        </tr>
        @if(isset($print_templates))
                @foreach($print_templates as $template)
                <?php $content = json_decode($template->content, true); ?>
                <tr>
                    <td>
                        <b>{{ $template->id }}</b>
                    </td>

                    <td>
                        <div class="middle">
                            @if(isset($content['images']))
                                @foreach($content['images'] as $image)
                                    <img src="{{$image}}" alt="pic" style="margin: 0 auto; width: 80px;height: 100px;"/>
                                @endforeach
                            @endif
                        </div>
                    </td>

                    <td>
                        <a href="/admin/print_templates/{{ $template->id }}">{{ $content['name'] ?? '' }}</a>
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
                        <form method="POST" action="/admin/print_templates/{{ $template->id }}" accept-charset="UTF-8" class="pull-right">
                            {{ csrf_field() }}
                            <a class="btn btn-default" href="/admin/print_templates/{{ $template->id }}/edit">
                                <i style="color: green;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <input name="_method" type="hidden" value="DELETE">
                            <!--<input class="btn btn-danger" type="submit" value="Изтриване">-->
                            <button class="btn" type="submit"><i style="color: red;" class="fa fa-trash"></i></button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </table>

            {{  $print_templates->links() }}
    @else
            <p>Няма създадени категегории</p>
        @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection