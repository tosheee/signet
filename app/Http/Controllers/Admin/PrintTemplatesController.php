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
        $print_templates = PrintTemplate::all();
        $typePrintTemplates = TypePrintTemplate::all();

        return view('admin.print_templates.index')->
        with('print_templates', $print_templates)->
        with('typePrintTemplates', $typePrintTemplates)->
        with('title', 'Щампи');
    }

    public function create()
    {

        return view('admin.print_templates.create')->
        with('categories', Category::all())->
        with('title', 'Нова Щампа');
    }

    public function store(Request $request)
    {


        dd($request);

        // на база на броя на снимките може да се направи мулти запис
        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:100000'
        ]);

        $record_id = DbHelper::getLastProductId('print_templates') + 1;

        foreach(['small', 'original'] as $new_name){
            $imageName = DbHelper::storeAndResizeImages(
                $request->image,
                'print_templates/'.$record_id,
                $new_name,
                $request->input('resize_percent')
            );
        }

        $printTemplate = new PrintTemplate;
        $printTemplate->category_id = $request->input('category_id');
        $printTemplate->sub_category_id = $request->input('sub_category_id');

        $printTemplate->type_print_template_id = $request->input('type_print_template_id');
        $printTemplate->name = $imageName;
        $printTemplate->image_path = '';

        $printTemplate->configuration = '';
        $printTemplate->active = $request->input('active');
        $printTemplate->save();

        return redirect('admin/print_templates')->with('title', 'Нова категория')->with('message', '');
    }

    public function resizeImages($picture, $pathToStore, $template_name, $i, $resize_percent)
    {
        $extension = $picture->getClientOriginalExtension();
        $template_name = strtolower($template_name);

        $fileNameToStore =$i.'_'.$template_name.'.'.$extension;



        if(!is_dir($pathToStore))
        {
            Storage::makeDirectory($pathToStore, 0775, true);
        }

        list($width, $height) = getimagesize($picture->getRealPath());

        $newWidth  = intval(($resize_percent / 100) * $width);
        $newHeight = intval(($resize_percent / 100) * $height);

        Image::make($picture->getRealPath())->resize($newWidth, $newHeight)->save($pathToStore.'/'.$fileNameToStore);

        return $fileNameToStore;
    }

    public function show($id)
    {
        $printTemplate = PrintTemplate::find($id);

        return view('admin.print_templates.show')
            ->with('category', $printTemplate)
            ->with('title', 'Преглед на категория' );
    }

    public function edit($id)
    {
        $printTemplate= PrintTemplate::find($id);

        return view('admin.print_templates.edit')
            ->with('category', $printTemplate)
            ->with('title', 'Промяна на категория');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $printTemplate = PrintTemplate::find($id);
        $printTemplate->name = $request->input('name');
        $printTemplate->save();

        return redirect('/admin/categories')->with('message', 'Категорията е променена');
    }

    public function destroy($id)
    {
        $printTemplate = PrintTemplate::find($id);
        $printTemplate->delete();

        return redirect('/admin/printTemplate')->with('message', 'Категорията е изтрита');
    }
}
