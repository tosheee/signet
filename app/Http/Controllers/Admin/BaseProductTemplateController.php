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
        with('baseProductTemplates', BaseProductTemplate::latest()->paginate(10))->
        with('title', 'Base Template');
    }

    public function create()
    {
        return view('admin.base_product_template.create')->
        with('categories', Category::all())->
        with('subCategories', SubCategory::all())->
        with('maxImages', 5)->
        with('title', 'Update Base Template');
    }

    public function store(Request $request)
    {
        $record_id = DbHelper::getLastProductId('base_product_templates') + 1;
        $template_name =  DbHelper::cirilicToLatin($request->name);
        $percents_images = explode("|", $request->percent_images);
        $content = [];

        if($request->hasFile('images') )
        {
            $content['images'] = DbHelper::recordImages(
                $request->images,
                'base_templates',
                $record_id,
                $percents_images
                //['small', 'original']
            );
        }

        $content['name'] = $template_name;
        $content['percents_images'] = $percents_images;

        $baseProduct = new BaseProductTemplate;
        $baseProduct->category_id = $request->input('category_id');
        $baseProduct->active = $request->input('active');
        $baseProduct->content = json_encode($content, JSON_UNESCAPED_UNICODE );

        $baseProduct->save();

        return redirect('/admin/base_product_template')
            ->with('title', 'Base templates')
            ->with('message', 'Created');
    }

    public function edit($id)
    {
        return view('admin.base_product_template.edit')->
        with('categories', Category::all())->
        with('subCategories', SubCategory::all())->
        with('baseProductTemplate', BaseProductTemplate::find($id))->
        with('record_id', $id)->
        with('maxImages', 5)->
        with('title', 'Update Base Template');
    }

    public function update(Request $request, $id)
    {
        $baseProduct = BaseProductTemplate::find($id);
        $old_content = json_decode($baseProduct->content, true);

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
                'base_templates',
                $id,
                $percents_images
            //['small', 'original']
            );
        }

        $content['percents_images'] = $percents_images;

        $baseProduct->category_id = $request->input('category_id');
        $baseProduct->active = $request->input('active');
        $baseProduct->content = json_encode($content, JSON_UNESCAPED_UNICODE );
        $baseProduct->save();

        return redirect('admin/base_product_template/')->
        with('title', 'Base templates')->
        with('message', 'Updated');
    }

    public function destroy($id)
    {
        $baseProductTemplate = BaseProductTemplate::find($id);
        DbHelper::deleteDirFromRecord($baseProductTemplate);

        $baseProductTemplate->delete();
        session()->flash('notif', 'The template was deleted');

        return redirect('/admin/base_product_template')->
        with('message', 'Deleted');;
    }
}
