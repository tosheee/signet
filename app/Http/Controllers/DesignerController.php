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
use App\Admin\PrintTemplate;
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


        $show_search = false;


        return view('designer.index')->
        with('printTemplates', $printTemplates)->
        with('productsDesing', $productsDesing)->
        with('show_search', $show_search)->
        with('pathLing', 'designer')->
        with('colors', $colors);
    }

    public function searchCategory(Request $request)
    {
        //$productsDesing = ProductDesing::select('*')->where('category_id', '=', (int)$request->q)->get()    ;

        $productsDesing = ProductDesing::where('category_id', (int)$request->q);
        dd($productsDesing);
        return view('designer.index')->
        with('productDesing', $productsDesing);
    }
}