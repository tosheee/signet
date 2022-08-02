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
use App\Admin\Slider;

use App\Http\Requests;

class WelcomeController extends Controller
{
    public function welcome()
    {

        $productsSale =        Product::where('active', true)->where('sale',         true)->orderBy('created_at', 'desc')->take(10)->get();
        $productsRecommended = Product::where('active', true)->where('recommended',  true)->orderBy('created_at', 'desc')->take(10)->get();
        $productsBestSeller =  Product::where('active', true)->where('best_sellers', true)->orderBy('created_at', 'desc')->take(10)->get();
        $slider = Slider::all();

        return view('welcome')->
        with('productsSale', $productsSale)->
        with('productsRecommended', $productsRecommended)->
        with('show_slider', true)->
        with('slider', $slider)->
        with('show_sidebar', true)->
        with('show_featured', true)->
        with('show_categories', true)->
        with('show_offer', true)->
        with('show_subscribe', true)->
        with('show_products', true)->
        with('show_vendor', true)->

        with('productsBestSeller', $productsBestSeller);
    }
}
