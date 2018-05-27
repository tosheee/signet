<?php

namespace App\Http\Controllers\Admin;

use App\Admin\SubCategory;
use App\Admin\Category;
use App\Admin\Product;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Image;
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

        return view('admin.products.index')->with('categories', $categories)->with('subCategories', $subCategories)->with('products', $products)->with('title', 'Всички продукти');
    }

    public function show($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('admin.products.show')->with('categories', $categories)->with('subCategories', $subCategories)->with('product', $product)->with('title', 'Преглед на продукта');
    }

    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.products.create')->with('categories', $categories)->with('subCategories', $subCategories)->with('title', 'Създаване на продукт');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id'     => 'required',
            'sub_category_id' => 'required',
        ]);

        $productId = ImagesHelper::getLastProductId() + 1;
        $descriptionRequest =  $request->input('description');

        if($request->hasFile('upload_main_picture'))
        {
            $descriptionRequest['upload_main_picture'] = ImagesHelper::resizeImages($request->file('upload_main_picture'), $productId, $request->input('watermark_checked'), 1000, 1000);
        }
        else
        {
            $descriptionRequest['upload_main_picture'] = 'noimage.jpg';
        }

        if($request->hasFile('upload_gallery_pictures') && $request->hasFile('upload_main_picture'))
        {
            $files_gallery_pic = $request->file('upload_gallery_pictures');

            for($i = 0; $i < count($files_gallery_pic); $i++)
            {
                $descriptionRequest['gallery'][$i]['upload_picture'] = ImagesHelper::resizeImages($files_gallery_pic[$i], $productId, $request->input('watermark_checked'), 1000, 1000);
            }
        }

        $descriptionRequest['delivery_price'] = number_format(str_replace(",", ".", $descriptionRequest['delivery_price']), 2);
        $descriptionRequest['price'] = number_format(str_replace(",", ".", $descriptionRequest['price']), 2);
        $descriptionRequest['old_price'] = number_format(str_replace(",", ".", $descriptionRequest['old_price']), 2);

        $descriptionRequest['article_id'] = mt_rand();

        $description = json_encode( $descriptionRequest, JSON_UNESCAPED_UNICODE );
        $subCategoryName = SubCategory::find($request->input('sub_category_id'))->name;

        $product = new Product;
        $product->category_id     = $request->input('category_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->identifier      = preg_replace('/\s+/', '_', mb_strtolower($subCategoryName));
        $product->active          = $request->input('active');
        $product->sale            = $request->input('sale');
        $product->recommended     = $request->input('recommended');
        $product->best_sellers    = $request->input('best_sellers');
        $product->description     = $description;
        $product->save();

        session()->flash('notif', 'Продукта е създаден');

        return redirect('admin/products/create');
    }

    public function store_old(Request $request)
    {
        $this->validate($request, [
            'category_id'     => 'required',
            'sub_category_id' => 'required',
        ]);

        if(!isset(DB::table('products')->latest('id')->first()->id))
        {
            $product = new Product;
            $product->category_id     = 1;
            $product->sub_category_id = 1;
            $product->identifier      = '';
            $product->sale            = 0;
            $product->active          = 0;
            $product->recommended     = 0;
            $product->best_sellers    = 0;
            $product->description     = '';
            $product->save();
            $oldId = DB::table('products')->latest('id')->first()->id;

            $product = Product::find($oldId);
            $product->delete();
        }
        else
        {
            $oldId = DB::table('products')->latest('id')->first()->id;
        }

        $productId = $oldId + 1;
        $descriptionRequest =  $request->input('description');

        if($request->hasFile('upload_main_picture'))
        {
            $file_main_pic = $request->file('upload_main_picture');
            $extension = $file_main_pic->getClientOriginalExtension();
            $fileNameToStore = 'basic_'.time().'.'.$extension;
            Storage::makeDirectory('public/upload_pictures/'.$productId);
            $image = Image::make($file_main_pic->getRealPath());

            $path = storage_path('app/public/upload_pictures/'.$productId.'/'. $fileNameToStore);
            
            $water_mark = storage_path('app/public/common_pictures/watermark.png');
            
            if(file_exists($water_mark) && $request->input('watermark_checked') == 1)
            {
            	$image->resize(1500, 1000)->insert($water_mark, 'bottom-right', 10, 10)->save($path);
            }
            else
            {
            	$image->resize(1500, 1000)->save($path);
            }
            
            $descriptionRequest['upload_main_picture'] = $fileNameToStore;
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        if($request->hasFile('upload_gallery_pictures') && $request->hasFile('upload_main_picture'))
        {
            $files_gallery_pic =$request->file('upload_gallery_pictures');

            for($i = 0; $i < count($files_gallery_pic); $i++)
            {
                $extension = $files_gallery_pic[$i]->getClientOriginalExtension();
                $fileNameToStore = 'gallery_'.$i.'_'.time().'.'.$extension;
                Storage::makeDirectory('public/upload_pictures/'.$productId);
                $image = Image::make($files_gallery_pic[$i]->getRealPath());
		        $path = storage_path('app/public/upload_pictures/'.$productId.'/'. $fileNameToStore);
                $water_mark = storage_path('app/public/common_pictures/watermark.png');
            
                if(file_exists($water_mark) && $request->input('watermark_checked') == 1)
                {
            	  $image->resize(1500, 1000)->insert($water_mark, 'bottom-right', 10, 10)->save($path);
                }
                else
                {
            	  $image->resize(1500, 1000)->save($path);
                }
                
             $descriptionRequest['gallery'][$i]['upload_picture'] = $fileNameToStore;
            }
        }

        $descriptionRequest['price'] = number_format($descriptionRequest['price'], 2);
        $descriptionRequest['old_price'] = isset($descriptionRequest['old_price']) ? number_format($descriptionRequest['old_price'], 2) : null;

        $description = json_encode( $descriptionRequest, JSON_UNESCAPED_UNICODE );
        $subCategoryName = SubCategory::find($request->input('sub_category_id'))->name;

        $product = new Product;
        $product->category_id     = $request->input('category_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->identifier      = preg_replace('/\s+/', '_', mb_strtolower($subCategoryName));
        $product->active          = $request->input('active');
        $product->sale            = $request->input('sale');
        $product->recommended     = $request->input('recommended');
        $product->best_sellers    = $request->input('best_sellers');
        $product->description     = $description;
        $product->save();

        session()->flash('notif', 'Продукта е създаден');

        return redirect('admin/products/create');
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
        $product = Product::find($id);
        $descriptionRequest =  $request->input('description');
        $this->validate($request, [
            'category_id'     => 'required',
            'sub_category_id' => 'required',
        ]);

        $old_descriptions = json_decode($product->description, true);

        if($request->hasFile('upload_main_picture'))
        {
            $file_main_pic = $request->file('upload_main_picture');
            $extension = $file_main_pic->getClientOriginalExtension();
            $fileNameToStore = 'basic_'.time().'.'.$extension;
            Storage::makeDirectory('public/upload_pictures/'.$id);
            
            if (isset($old_descriptions['upload_main_picture']))
            {
                Storage::delete('public/upload_pictures/'.$id.'/'.$old_descriptions['upload_main_picture']);
            }

            $image = Image::make($file_main_pic->getRealPath());
            $path = storage_path('app/public/upload_pictures/'.$id.'/'. $fileNameToStore);
	    $water_mark = storage_path('app/public/common_pictures/watermark.png');
            
            if(file_exists($water_mark) && $request->input('watermark_checked') == 1)
            {
            	$image->resize(1500, 1000)->insert($water_mark, 'bottom-right', 10, 10)->save($path);
            }
            else
            {
            	$image->resize(1500, 1000)->save($path);
            }
            
            
            
            $descriptionRequest['upload_main_picture'] = $fileNameToStore;
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        // gallery
        if($request->hasFile('upload_gallery_pictures'))
        {
            $files_gallery_pic =$request->file('upload_gallery_pictures');

            if(isset($old_descriptions['gallery']))
            {
                $old_pic_num = count($old_descriptions['gallery']);
            }
            else
            {
                $old_pic_num = 0;
            }

            $new_pic_num = count($files_gallery_pic);

            for($i = 0; $i < $new_pic_num; $i++)
            {
                $extension = $files_gallery_pic[$i]->getClientOriginalExtension();
                $fileNameToStore = 'gallery_'.$i.'_'.time().'.'.$extension;
                $image = Image::make($files_gallery_pic[$i]->getRealPath());
                $path = storage_path('app/public/upload_pictures/'.$id.'/'. $fileNameToStore);
		        $water_mark = storage_path('app/public/common_pictures/watermark.png');
            
	        if(file_exists($water_mark) && $request->input('watermark_checked') == 1)
	        {
	           $image->resize(1000, 1000)->insert($water_mark, 'bottom-right', 10, 10)->save($path);
	        }
	        else
	        {
	           $image->resize(1000, 1000)->save($path);
	        }
                
                $descriptionRequest['gallery'][$i + $old_pic_num]['upload_picture'] = $fileNameToStore;
            }
        }

        $descriptionRequest['price'] = number_format($descriptionRequest['price'], 2);
        $descriptionRequest['old_price'] = isset($descriptionRequest['old_price']) ? number_format($descriptionRequest['old_price'], 2) : null;

        $description = json_encode( $descriptionRequest, JSON_UNESCAPED_UNICODE );
        $subCategoryName = SubCategory::find($request->input('sub_category_id'))->name;

        $product->category_id     = $request->input('category_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->identifier      = preg_replace('/\s+/', '_', mb_strtolower($subCategoryName));
        $product->active          = $request->input('active');
        $product->sale            = $request->input('sale');
        $product->recommended     = $request->input('recommended');
        $product->best_sellers    = $request->input('best_sellers');
        $product->description     = $description;
        $product->save();

        $actual_data = Product::find($id);
        $new_descriptions = json_decode($actual_data->description, true);

        if (isset($new_descriptions['gallery']))
        {
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

    /*
     *
    public function search_category(Request $request)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $search_category = $request->input('category');
        $products = Product::where('identifier', $search_category)->get();
        $subCat = SubCategory::where('identifier', $search_category)->first()->name;

        return view('admin.products.index', ['categories' => $categories, 'subCategories' => $subCategories, 'products' => $products])->with('title', 'Подкатегория >>> '.$subCat);
    }
    */
}
