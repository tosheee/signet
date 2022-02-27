<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Category;
use App\Admin\TypePrintTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypePrintTemplatesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::all();
        $typePrintTemplates = TypePrintTemplate::all();

        return view('admin.type_print_templates.index')->
        with('categories', $categories)->
        with('typePrintTemplates', $typePrintTemplates)->
        with('title', 'Type Print Templates');
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.type_print_templates.create')->
        with('categories', $categories)->
        with('title', 'Create type print template');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name'        => 'required',
        ]);

        $type_print_temlate = new TypePrintTemplate;
        $type_print_temlate->category_id = $request->input('category_id');
        $type_print_temlate->identifier  = preg_replace('/\s+/', '_', trim(mb_strtolower($request->input('name'))));
        $type_print_temlate->name        = $request->input('name');
        $type_print_temlate->save();

        return redirect('admin/type_print_templates')->with('success', 'Създадена');
    }

    public function show($id)
    {
        $categories = Category::all();
        $subCategory = SubCategory::find($id);

        return view('admin.type_print_templates.show')->with('categories', $categories)->with('subCategory', $subCategory)->with('title', 'Преглед на подкатегория');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $subCategory = SubCategory::find($id);

        return view('admin.type_print_templates.edit')->with('categories', $categories)->with('subCategory', $subCategory)->with('title', 'Обновяване на подкатегория');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
        ]);

        $subCategory = SubCategory::find($id);

        $subCategory->category_id = $request->input('category_id');
        $subCategory->name        = $request->input('name');
        $subCategory->identifier  = preg_replace('/\s+/', '_', trim(mb_strtolower($request->input('name'))));
        $subCategory->save();

        return redirect('/admin/type_print_templates')->with('success', 'Подкатегорията е обновена');
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();

        return redirect('/admin/type_print_templates')->with('success', 'изтрита');
    }
}
