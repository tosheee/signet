<?php

use App\Admin\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImagesHelper{

    public static function getLastProductId($tableName)
    {

        if(!isset(DB::table($tableName)->latest('id')->first()->id))
        {
            $product = new Product;
            $product->category_id = 1;

            $product->save();

            $oldId = DB::table($tableName)->latest('id')->first()->id;

            $product = Product::find($oldId);
            $product->delete();
        }
        else
        {
            $oldId = DB::table($tableName)->latest('id')->first()->id;
        }

        return $oldId;
    }

    public static function resizeImages($file_main_pic, $productId, $water_checked, $width, $height)
    {
        $extension = $file_main_pic->getClientOriginalExtension();
        $fileNameToStore = 'basic_'.time().'.'.$extension;


        Storage::makeDirectory('public/upload_pictures/'.$productId);
        $image = Image::make($file_main_pic->getRealPath());

        $path = storage_path('app/public/upload_pictures/'.$productId.'/'. $fileNameToStore);
        $water_mark = storage_path('app/public/common_pictures/watermark.png');

        if(file_exists($water_mark) && $water_checked == 1)
        {
            $image->resize($width, $height)->insert($water_mark, 'bottom-right', 10, 10)->save($path);
        }
        else
        {
            $image->resize($width, $height)->save($path);
        }

        return $fileNameToStore;
    }
}