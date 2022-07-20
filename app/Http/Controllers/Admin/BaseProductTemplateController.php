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
        return view('admin.base_product_template.index')->
        with('baseProductTemplates', BaseProductTemplate::all())->
        with('title', 'Base Template');
    }

    public function create()
    {
        return view('admin.base_product_template.create')->with('title', 'New product template');
    }

    public function store(Request $request)
    {
        $record_id = DbHelper::getLastProductId('base_product_templates') + 1;
        $template_name =  DbHelper::cirilicToLatin($request->name);
        $percents_images = explode("|", $request->percent_images);
        $content = [];

        if($request->hasFile('images') )
        {
            $images = $request->images;
            for($i = 0; $i < count($images); $i++)
            {
                $content['images'][$i] = DbHelper::storeAndResizeImages(
                    $images[$i],
                    'base_templates/'.$record_id,
                    $i.'_base',
                    $percents_images[$i]
                );
            }
        }

        $content['name'] = $template_name;
        $content['percents_images'] = $percents_images;

        $baseProduct = new BaseProductTemplate;
        $baseProduct->category_id = $request->input('category_id');
        $baseProduct->active = $request->input('active');
        $baseProduct->content = json_encode($content, JSON_UNESCAPED_UNICODE );

        $baseProduct->save();

        return redirect('/admin/base_product_templates')
            ->with('title', 'Нова категория')
            ->with('message', 'Категорията е създадена');
    }

    public function show(BaseProductTemplate $baseProductTemplate)
    {

    }

    public function edit($id)
    {
        return view('admin.base_product_template.edit')->
        with('categories', Category::all())->
        with('subCategories', SubCategory::all())->
        with('baseProductTemplate', BaseProductTemplate::find($id))->
        with('record_id', $id)->
        with('title', 'Update Base Template');
    }

    public function update(Request $request, $id)
    {
        $baseProduct = BaseProductTemplate::find($id);
        $old_content = json_decode($baseProduct->content, true);

        $content['name'] = $request->input('name');

        $content['images'] = $old_content['images'];

        $old_images = $request->input('old_images');


        //dd($old_images);
        dd($content['images']);
        if (isset($old_images) && isset($content['images']))
        {
            $diff_images = array_diff($old_images, $content['images']);
            if(!empty($diff_images))
            {
                dd($diff_images);
            }
        }


        if($request->hasFile('images') )
        {
            $percents_images = explode("|", $request->percent_images);
            $images = $request->images;

            for($i = 0; $i < count($images); $i++)
            {
                $old_img = $content['images'][$i];
                $idx = explode('_', $old_img[0]);
                if($idx == $i)
                {
                    Storage::delete('public/images/base_templates/'.$id.'/'.$old_img);
                    $content['images'][$i] = DbHelper::storeAndResizeImages(
                        $images[$i],
                        'base_templates/'.$id,
                        $i.'_base',
                        $percents_images[$i]
                    );
                }
            }
        }

        $baseProduct->category_id = $request->input('category_id');
        $baseProduct->active = $request->input('active');
        $baseProduct->content = json_encode($content, JSON_UNESCAPED_UNICODE );

        $baseProduct->save();

        return redirect('admin/base_product_template/')
            ->with('title', 'Нова категория')
            ->with('message', 'Категорията е създадена');
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
