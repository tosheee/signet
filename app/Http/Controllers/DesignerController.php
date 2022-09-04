<?php

namespace App\Http\Controllers;

use Session;

use App\Cart;
use App\Like;
use App\Order;
use App\Color;

use App\Admin\Page;
use App\Admin\Product;
use App\Admin\Category;
use App\Admin\SubCategory;
use App\Admin\TypePrintTemplate;
use App\Admin\PrintTemplate;
use App\Admin\BaseProductTemplate;
use App\ProductDesing;
use DB;

use Illuminate\Http\Request;

class DesignerController extends Controller
{
    public function index()
    {

        $printTemplates = PrintTemplate::all();
        $productsDesing = ProductDesing::all();
        $colors = Color::all();

        $customSideBar = Category::all();
        $pathLink = 'designer/search';


        return view('designer.index')->
        with('printTemplates', $printTemplates)->
        with('productsDesing', $productsDesing)->
        with('customSideBar', $customSideBar)->
        with('pathLink', $pathLink)->
        with('show_sidebar', true)->
        with('show_search', true)->
        with('pathLing', 'designer')->
        with('colors', $colors);
    }

    public function searchCategory(Request $request)
    {
        $category = Category::where('identifier', $request->cat)->get()->first();
        $baseProductTemplates = BaseProductTemplate::where('category_id', $category->id)->get();

        $typePrintTemplates = TypePrintTemplate::where('category_id', $category->id)->get();
        $printTemplates = PrintTemplate::where('category_id', $category->id)->get();
        // $productsDesing = ProductDesing::all();
        // $colors = Color::all();
        $customSideBar = Category::all();
        $pathLink = 'designer/search';

        //dd($category->id);

        return view('designer.index')->
        with('customSideBar', $customSideBar)->
        with('pathLink', $pathLink)->
        with('show_search', false)->
        with('show_sidebar', false)->
        with('categories', $customSideBar)->
        with('categoryName', $category->name)->
        with('printTemplates', $printTemplates)->
        with('baseProductTemplates', $baseProductTemplates)->
        with('typePrintTemplates', $typePrintTemplates);

    }
}