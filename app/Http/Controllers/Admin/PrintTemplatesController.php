<?php

namespace App\Http\Controllers\Admin;

use App\Admin\PrintTemplate;
use App\Admin\TypePrintTemplate;
use App\Admin\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('admin.print_templates.create')->with('title', 'Нова Щампа');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:100000'
        ]);

        $name = $request->input('name');

        SubCategory::find($request->input('sub_category_id'));


        //File::ensureDirectoryExists(public_path('img/templates').);

        $printTemplate = new PrintTemplate;

        $printTemplate->category_id = $request->input('category_id');
        $printTemplate->sub_category_id = $request->input('sub_category_id');
        $printTemplate->type_print_template_id = $request->input('type_print_template_id');
        $printTemplate->name = $name;

        $imageName = time().'_'.strtolower($name).'.'.$request->image->extension();

        $request->image->move(public_path('img/templates'), $imageName);

        $printTemplate->image_path = $imageName;
        $printTemplate->active = $request->input('active');
        $printTemplate->save();

        return redirect('admin/print_templates')->with('title', 'Нова категория')->with('message', 'Категорията е създадена');
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
