<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Category;
use App\Admin\SubCategory;

use App\Admin\BaseProductTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DbRecordHelper as DbHelper;



class BaseProductTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $baseProductTemplates = BaseProductTemplate::all();

        return view('admin.base_product_template.index')->
        with('baseProductTemplates', $baseProductTemplates)->
        with('title', 'Base Template');
    }

    public function create()
    {
        return view('admin.base_product_template.create')->with('title', 'New product template');
    }

    public function store(Request $request)
    {
        $template_name =  DbHelper::cirilicToLatin($request->name);
        $images = $request->images;
        $content = [];
        $record_id = DbHelper::getLastProductId('base_product_templates') + 1;

        for($i = 0; $i < count($images); $i++){
            $content['images'][$i] = DbHelper::storeAndResizeImages(
                $images[$i],
                'base_templates/'.$record_id,
                $template_name.''.$i,
                $request->input('resize_percent')
            );
        }

        $content['name'] = $template_name;

        $baseProduct = new BaseProductTemplate;
        $baseProduct->category_id = $request->input('category_id');
        $baseProduct->content = json_encode($content, JSON_UNESCAPED_UNICODE );
        $baseProduct->active = $request->input('active');
        $baseProduct->save();

        return redirect('admin/base_product_template')
            ->with('title', 'Нова категория')
            ->with('message', 'Категорията е създадена');
    }

    public function show(BaseProductTemplate $baseProductTemplate)
    {

    }

    public function edit($id)
    {
        $baseProductTemplate = BaseProductTemplate::find($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('admin.base_product_template.edit')->
        with('categories', $categories)->
        with('subCategories', $subCategories)->
        with('baseProductTemplate', $baseProductTemplate)->
        with('title', 'Update Base Template');
    }

    public function update(Request $request, BaseProductTemplate $baseProductTemplate)
    {

    }

    public function destroy($id)
    {
        $baseProductTemplate = BaseProductTemplate::find($id);
        $baseProductTemplate->delete();
        DbHelper::deleteDir('public/images/base_templates/'.$id);
        session()->flash('notif', 'Продукта е изтрит');

        return redirect('/admin/base_product_template');
    }
}
