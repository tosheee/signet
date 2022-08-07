<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DbRecordHelper as DbHelper;


class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::latest()->paginate(5);

        return view('admin.categories.index')->
        with('categories', $categories)->
        with('title', 'Всички категории');
    }


    public function create()
    {
        return view('admin.categories.create')->
        with('recommended_dim', '150 x 146')->
        with('title', 'Нова категория');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $record_id = DbHelper::getLastProductId('print_templates') + 1;
        $template_name =  DbHelper::cirilicToLatin($request->name);
        $percents_images = explode("|", $request->percent_images);
        $content = [];

        if($request->hasFile('images') )
        {
            $content['images'] = DbHelper::recordImages(
                $request->images,
                'category_images',
                $record_id,
                $percents_images,
                [$template_name]
            );
        }

        $content['name'] = $request->name;
        $content['percents_images'] = $percents_images;

        $category = new Category;
        $category->name = $request->input('name');
        $category->identifier = $request->input('identifier');
        $category->filters = $request->input('filters');
        $category->content = json_encode($content, JSON_UNESCAPED_UNICODE );
        $category->save();

        return redirect('admin/categories')->
                        with('title', 'Нова категория')->
                        with('message', 'Категорията е създадена');
    }

    public function show($id)
    {
        $category = Category::find($id);

        return view('admin.categories.show')->
        with('category', $category)->
        with('title', 'Преглед на категория' );
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit')->
        with('category', $category)->
        with('title', 'Промяна на категория');
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = Category::find($id);

        $old_content = json_decode($category->content, true);
        $content['images'] = $old_content['images'];
        $content['name']  = $request->input('name');
        $input_old_images = $request->input('old_images');
        $percents_images = explode("|", $request->percent_images);

        if (!isset($input_old_images)){ $input_old_images = []; }
        if (!isset($content['images'])){ $content['images'] = []; }


        if ($input_old_images != $content['images'])
        {
            $diff_images = array_diff($content['images'], $input_old_images);

            foreach ( $diff_images as $diff_img)
            {
                DbHelper::deleteFile('public/images/base_templates/'.$id.'/'.$diff_img);
            }
            $content['images'] = [];
        }
        if($request->hasFile('images') )
        {
            $content['images'] = DbHelper::recordImages(
                $request->images,
                'category_images',
                $id,
                $percents_images
            );
        }

        $content['percents_images'] = $percents_images;

        $category->name = $request->input('name');
        $category->identifier = $request->input('identifier');
        $category->filters = $request->input('filters');
        $category->content = json_encode($content, JSON_UNESCAPED_UNICODE );
        $category->save();

        return redirect('/admin/categories')->with('message', 'Категорията е променена');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        DbHelper::deleteDirFromRecord($category);

        $category->delete();
        session()->flash('notif', 'The template was deleted');

        return redirect('/admin/categories')->
        with('message', 'Категорията е изтрита');
    }
}
