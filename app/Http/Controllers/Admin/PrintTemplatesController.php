<?php

namespace App\Http\Controllers\Admin;


use App\Admin\PrintTemplate;
use App\Admin\TypePrintTemplate;
use App\Admin\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Category;
use DbRecordHelper as DbHelper;
use File;


class PrintTemplatesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $print_templates = PrintTemplate::latest()->paginate(5);
        $typePrintTemplates = TypePrintTemplate::all();

        return view('admin.print_templates.index')->
        with('print_templates', $print_templates)->
        with('typePrintTemplates', $typePrintTemplates)->
        with('title', 'Staps');
    }

    public function create()
    {
        return view('admin.print_templates.create')->
        with('categories', Category::all())->
        with('sub_categories', SubCategory::all())->
        with('recommended_dim', '150 x 146')->
        with('title', 'New stamp');
    }

    public function store(Request $request)
    {
        /*
        $this->validate($request, [
            'name' => 'required',
            'images' => 'mimes:jpeg,jpg,png,gif|required|max:100000'
        ]);
        */

        $record_id = DbHelper::getLastProductId('print_templates') + 1;
        $template_name =  DbHelper::cirilicToLatin($request->name);
        $percents_images = explode("|", $request->percent_images);
        $content = [];

        if($request->hasFile('images') )
        {
            $content['images'] = DbHelper::recordImages(
                $request->images,
                'print_templates',
                $record_id,
                $percents_images,
                [$template_name, 'origin-'.$template_name]
            );
        }

        $content['name'] = $request->name;
        $content['percents_images'] = $percents_images;

        $printTemplate = new PrintTemplate;
        $printTemplate->category_id = $request->input('category_id');
        $printTemplate->sub_category_id = $request->input('sub_category_id');
        $printTemplate->type_print_template_id = $request->input('type_print_template_id');
        $printTemplate->active = $request->input('active');
        $printTemplate->content = json_encode($content, JSON_UNESCAPED_UNICODE );

        $printTemplate->save();

        return redirect('admin/print_templates')->with('title', 'New stamp')->with('message', '');
    }

    public function show($id)
    {
        $printTemplate = PrintTemplate::find($id);

        return view('admin.print_templates.show')->
        with('category', $printTemplate)->
        with('recommended_dim', '150 x 146')->
        with('title', 'Преглед на категория' );
    }

    public function edit($id)
    {
        return view('admin.print_templates.edit')->
        with('categories', Category::all())->
        with('sub_categories', SubCategory::all())->
        with('printTemplate', PrintTemplate::find($id))->
        with('title', 'Change stamp');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $printTemplate = PrintTemplate::find($id);
        $old_content = json_decode($printTemplate->content, true);

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

        $printTemplate->category_id = $request->input('category_id');
        $printTemplate->sub_category_id = $request->input('sub_category_id');
        $printTemplate->type_print_template_id = $request->input('type_print_template_id');
        $printTemplate->active = $request->input('active');
        $printTemplate->content = json_encode($content, JSON_UNESCAPED_UNICODE );
        $printTemplate->save();

        return redirect('/admin/print_templates')->
        with('message', 'Категорията е променена');
    }

    public function destroy($id)
    {
        $printTemplate = PrintTemplate::find($id);
        DbHelper::deleteDirFromRecord($printTemplate);

        $printTemplate->delete();
        session()->flash('notif', 'The template was deleted');

        return redirect('/admin/print_templates')->with('message', 'Deleted');
    }
}
