@foreach(App\Admin\Category::all() as $category)
    @if( $template->category_id == $category->id)
        <p>
            <b>Категория:</b> {{ $category->name }}
        </p>
    @endif
@endforeach

@foreach(App\Admin\SubCategory::all() as $subCategory)
    @if( $template->sub_category_id == $subCategory->id)
        <p>
            <b>Подкатегория:</b> {{ $subCategory->name }}
        </p>
    @endif
@endforeach
