<?php

namespace App\Http\Controllers\Admin;
use File;


use App\Admin\Category;
use App\Admin\SubCategory;
use App\Admin\Product;
use App\Admin\PrintTemplate;
use App\Admin\BaseProductTemplate;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
#use Intervention\Image\ImageManagerStatic as Image;
use ImagesHelper;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $products = Product::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.products.index')->
        with('categories', $categories)->
        with('subCategories', $subCategories)->
        with('products', $products)->
        with('title', 'Всички продукти');
    }

    public function show($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('admin.products.show')->
        with('categories', $categories)->
        with('subCategories', $subCategories)->
        with('product', $product)->with('title', 'Преглед на продукта');
    }

    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $printTemplates = PrintTemplate::all();
        $baseProductTemplates = BaseProductTemplate::all();

        return view('admin.products.create')->
        with('categories', $categories)->
        with('subCategories', $subCategories)->
        with('printTemplates', $printTemplates)->
        with('baseProductTemplates', $baseProductTemplates)->
        with('title', 'Създаване на продукт');
    }

    public function store(Request $request)
    {
        //dd($request);

        $this->validate($request, [
            'category_id'     => 'required',
        ]);

        $catIdentifier = Category::find($request->input('category_id'))->identifier;

        $productId = ImagesHelper::getLastProductId('products');


        $descriptionRequest =  $request->input('description');
        $picturesOfUrl = $request->input('description');

        $resize_percent = $request->input('resize_percent');

        if(isset($descriptionRequest['delivery_price'])) {
            $descriptionRequest['delivery_price'] = $this->price_format($descriptionRequest['delivery_price']);
        }

        if(isset($descriptionRequest['price'])) {

            $descriptionRequest['price'] = $this->price_format($descriptionRequest['price']);
        }

        if(isset($descriptionRequest['old_price'])){
            $descriptionRequest['old_price'] = $this->price_format($descriptionRequest['old_price']);
        }

        $descriptionRequest['article_id'] = mt_rand();

        if($request->hasFile('upload_gallery_pictures'))
        {
            $files_gallery_pic = $request->file('upload_gallery_pictures');

            for($i = 0; $i < count($files_gallery_pic); $i++)
            {
                if ($i == 0)
                {
                    $descriptionRequest['upload_main_picture'] =
                        $this->resizeAndSaveImage($files_gallery_pic[$i], $productId, $i, 'basic', $resize_percent);
                }
                else
                {
                  $descriptionRequest['gallery'][$i]['upload_picture'] =
                      $this->resizeAndSaveImage($files_gallery_pic[$i], $productId, $i, 'gallery', $resize_percent);
                }
            }

            if(!is_dir(public_path('/product_images/'.$productId))){
                session()->flash('notif', 'Проблем със създаването на директорията на снимката');

                return redirect('admin/products/create');
            }
        }

        if(isset($picturesOfUrl['gallery']) && !$request->hasFile('upload_gallery_pictures')){
            array_shift($descriptionRequest['gallery']);
            $descriptionRequest['main_picture_url'] = array_values($picturesOfUrl['gallery'][0])[0];
        }

        $descriptionRequest['canvas_content_json'] = $request->input('canvas_content_json');
        $descriptionRequest['canvas_content_svg'] = $request->input('canvas_content_svg');

        $description = json_encode($descriptionRequest, JSON_UNESCAPED_UNICODE );

        $product = new Product;
        $product->category_id     = $request->input('category_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->identifier      = preg_replace('/\s+/', '_', mb_strtolower($catIdentifier));
        $product->active          = $request->input('active');
        $product->sale            = $request->input('sale');
        $product->recommended     = $request->input('recommended');
        $product->best_sellers    = $request->input('best_sellers');
        // $product->product_color   = $request->input('product_color');
        $product->description = $description;

        $product->save();

        session()->flash('notif', 'Продукта е създаден');

        return redirect('admin/products/create');
    }

    public function resizeAndSaveImage($picture, $productId, $idx, $type_pic, $resize_percent)
    {
        $extension = $picture->getClientOriginalExtension();
        $fileNameToStore = $type_pic.'_'.$idx.'.'.$extension;

        $productImagesPath = public_path().'/product_images/'.$productId.'/';

        if(!File::exists($productImagesPath)) { File::makeDirectory($productImagesPath, 0777, true, true);}

        $image = Image::make($picture->getRealPath());

        list($width, $height) = getimagesize($picture->getRealPath());

        $newWidth  = intval(($resize_percent / 100) * $width);
        $newHeight = intval(($resize_percent / 100) * $height);

        $image->resize($newWidth, $newHeight)->save($productImagesPath.'/'.$fileNameToStore);


        return $fileNameToStore;
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('admin.products.edit')->with('categories', $categories)->with('subCategories', $subCategories)->with('product', $product)->with('title', 'Обновяване информацията за продукта');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id'     => 'required',
            'sub_category_id' => 'required',
        ]);

        $product = Product::find($id);
        $descriptionRequest =  $request->input('description');
        $old_descriptions = json_decode($product->description, true);

        if($request->hasFile('upload_basic_picture') ){
            $files_main_pic = $request->file('upload_basic_picture');
            if (isset($old_descriptions['upload_main_picture']))
            {
                Storage::delete('public/upload_pictures/'.$id.'/'.$old_descriptions['upload_main_picture']);
            }
            $descriptionRequest['upload_main_picture'] = $this->resizeImages($files_main_pic, $id, $request->input('resize_percent'), 'basic' );
        }


        if($request->hasFile('upload_gallery_pictures') )
        {
            $files_gallery_pic = $request->file('upload_gallery_pictures');

            if(isset($old_descriptions['gallery']))
            {
                $old_pic_num = count($old_descriptions['gallery']);
            }
            else
            {
                $old_pic_num = 0;
            }

            $new_pic_num = count($files_gallery_pic);

            for($i = 0; $i <  $new_pic_num; $i++)
            {
                $descriptionRequest['gallery'][$i + $old_pic_num]['upload_picture'] = $this->resizeImages($files_gallery_pic[$i], $id, $request->input('resize_percent'), 'gallery');
            }
        }


        if(isset($descriptionRequest['delivery_price'])) {
            $descriptionRequest['delivery_price'] = $this->price_format($descriptionRequest['delivery_price']);
        }

        if(isset($descriptionRequest['price'])) {
            $descriptionRequest['price'] = $this->price_format($descriptionRequest['price']);
        }

        if(isset($descriptionRequest['old_price'])){
            $descriptionRequest['old_price'] = $this->price_format($descriptionRequest['old_price']);
        }

        $description = json_encode( $descriptionRequest, JSON_UNESCAPED_UNICODE );
        $subCategoryName = SubCategory::find($request->input('sub_category_id'))->name;

        $product->category_id     = $request->input('category_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->identifier      = preg_replace('/\s+/', '_', mb_strtolower($subCategoryName));
        $product->active          = $request->input('active');
        $product->sale            = $request->input('sale');
        $product->recommended     = $request->input('recommended');
        $product->best_sellers    = $request->input('best_sellers');
        //$product->product_color   = $request->input('product_color');
        $product->description     = $description;
        $product->save();

        $actual_data = Product::find($id);
        $new_descriptions = json_decode($actual_data->description, true);

        if (isset($new_descriptions['gallery']))
        {
           $this->deleteOldPictures($new_descriptions, $id);
        }

        session()->flash('notif', 'Продукта е обновен');

        return redirect('/admin/products')->with('title', 'Обновяване на продукта');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        Storage::deleteDirectory('public/upload_pictures/'.$id);
        session()->flash('notif', 'Продукта е изтрит');
        return redirect('/admin/products');
    }

    public function price_format($price)
    {
        return number_format(str_replace(",", ".", floatval($price)), 2);
    }

    public function resizeImages($picture, $productId, $resize_percent, $type_pic)
    {
        $extension = $picture->getClientOriginalExtension();
        $fileNameToStore = $type_pic.'_'.time().'.'.$extension;
        $pathToStore = storage_path('app/public/upload_pictures/'.$productId);

        if(!is_dir($pathToStore)){
            Storage::makeDirectory('public/upload_pictures/'.$productId, 0775, true);
        }

        list($width, $height) = getimagesize($picture->getRealPath());

        $newWidth  = intval(($resize_percent / 100) * $width);
        $newHeight = intval(($resize_percent / 100) * $height);

        //Image::make($picture->getRealPath())->resize($newWidth, $newHeight)->save($pathToStore.'/'.$fileNameToStore);

        return $fileNameToStore;
    }

    public function deleteOldPictures($new_descriptions, $id){
        $pic_files = Storage::allFiles('public/upload_pictures/'.$id.'/');
        $pic_name = array();

        for($i = 0; $i< count($pic_files); $i++)
        {
            $file_name = pathinfo($pic_files[$i], PATHINFO_FILENAME);
            if(mb_substr($file_name, 0, 5) != 'basic')
            {
                $file_exn = pathinfo($pic_files[$i],  PATHINFO_EXTENSION);
                $file_name = pathinfo($pic_files[$i], PATHINFO_FILENAME);
                $pic_name[$i] = $file_name.'.'.$file_exn;
            }
        }

        $new_pictures = array_column($new_descriptions['gallery'], 'upload_picture');
        $diff_pic = array_diff($pic_name, $new_pictures);

        foreach($diff_pic as $old_picture)
        {
            Storage::delete('public/upload_pictures/'.$id.'/'.$old_picture);
        }
    }

    public function search_category(Request $request)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $search_category = $request->input('category');
        $products = Product::where('identifier', $search_category)->get();
        $subCat = SubCategory::where('identifier', $search_category)->first()->name;

        return view('admin.products.index', ['categories' => $categories, 'subCategories' => $subCategories, 'products' => $products])->with('title', 'Подкатегория >>> '.$subCat);
    }
}