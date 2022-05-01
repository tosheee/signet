<?php

namespace App\Http\Controllers;

use App\Admin\SubCategory;
use App\Admin\Category;
use App\Admin\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

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


    public function search(Request $request)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();

        $lowerPrice = $request->input('lower_price');
        $upperPrice = $request->input('upper_price');
        $inputCategory = $request->input('category');
        $inputSubCategory = $request->input('sub_category');
        $inputKeyword = $request->input('keyword');
        $productColor = $request->input('product_color');

        $get_products = Product::where('active', true)->get();
        $product_ids = array();


        if (isset($inputCategory))
        {
            $products = Product::where('category_id', $inputCategory)->get();
        }
        elseif(isset($productColor))
        {
            $products = $get_products->where('product_color', $productColor);
        }
        elseif (isset($lowerPrice) && isset($upperPrice))
        {
            $productsResult = $this->get_products_of_price($get_products, $lowerPrice, $upperPrice);

            foreach($productsResult as $f_product)
            {
                array_push($product_ids, $f_product->id);
            }

            $perPage = count($product_ids);

            $products = Product::whereIn('id', $product_ids)->paginate($perPage);

        }
        elseif (isset($inputKeyword) && $inputSubCategory == 'all')
        {
            $productsResult = $this->get_filter_product($get_products, $inputKeyword);

            foreach($productsResult as $f_product)
            {
                array_push($product_ids, $f_product->id);
            }

            $products = Product::whereIn('id', $product_ids)->get();

        }
        elseif(isset($inputKeyword) && isset($inputSubCategory))
        {
            $products_of_category = $get_products->where('identifier', $inputSubCategory);
            $productsResult = $this->get_filter_product($products_of_category, $inputKeyword);

            foreach($productsResult as $f_product)
            {
                array_push($product_ids, $f_product->id);
            }

            $products = Product::whereIn('id', $product_ids)->get();
        }
        else
        {
            $products = Product::where('identifier', $inputSubCategory)->get();
        }

        return view('store.index')->with('categories', $categories)->with('subCategories', $subCategories)->with('products', $products)->with('lowerPrice', $lowerPrice)->with('upperPrice', $upperPrice);
    }


    public function get_filter_product($get_products, $inputKeyword)
    {
        $find_products = array();
        $inputKeyword = mb_substr($inputKeyword, 0, -2);

        foreach($get_products as $key=>$product)
        {
            $description = json_decode($product->description, true);
            $product_title = mb_strtolower($description['title_product']);
            $searched_world = mb_strtolower($inputKeyword);

            if (stristr($product_title, $searched_world))
            {
                array_push($find_products,  $get_products[$key]);
            }
        }

        return $find_products;
    }
    
    
    public function get_products_of_price($get_products, $lowerPrice, $upperPrice)
    {
        $find_products = array();
        $lowLimit = floatval($lowerPrice);
        $highLimit = floatval($upperPrice);
        
        foreach($get_products as $key=>$product)
        {
            $description = json_decode($product->description, true);
            $perPrice = floatval($description['price']); 
            
            if ($perPrice >= $lowLimit && $perPrice <= $highLimit )
            {
                array_push($find_products,  $get_products[$key]);
            }
        }
        
        return $find_products;
    }
    
    
    

}