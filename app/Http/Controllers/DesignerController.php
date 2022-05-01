<?php

namespace App\Http\Controllers;

use Session;

use App\Cart;
use App\Like;
use App\Order;

use App\Admin\Page;
use App\Admin\Product;
use App\Admin\Category;
use App\Admin\SubCategory;
use App\Admin\PrintTemplate;

use App\Http\Requests;

class DesignerController extends Controller
{
    public function index()
    {

        $printTemplates = PrintTemplate::all();
        return view('designer.index')->
        with('printTemplates', $printTemplates);
    }

    public function searchCategory(Request $request)
    {
        $query = $request->query;
        $currentCategory = Category::select('*')->where('identifier', '=', $request->category);
        $categories = Category::all();

        if (count($query) > 0){
            $products = Product::select('*')->
            where('category_id', '=', $currentCategory->first()->id)->
            where('active', '=', 1)->get();

        }
        else
        {
            $products = Product::select('*')->
            where('category_id', '=', $currentCategory->first()->id)->
            where('active', '=', 1)->get();
        }

        return view('store.index')->
        with('categories', $categories)->
        with('products', $products)->
        with('category_id', $currentCategory->first()->id);
    }
}