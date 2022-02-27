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

        //$productsSale =        Product::where('active', true)->where('sale',         true)->orderBy('created_at', 'desc')->take(10)->get();
        //$productsRecommended = Product::where('active', true)->where('recommended',  true)->orderBy('created_at', 'desc')->take(10)->get();
        //$productsBestSeller =  Product::where('active', true)->where('best_sellers', true)->orderBy('created_at', 'desc')->take(10)->get();



        $printTemplates = PrintTemplate::all();
        return view('designer.index')->with('printTemplates', $printTemplates);//->with('productsRecommended', $productsRecommended)->with('productsBestSeller', $productsBestSeller);
    }
}