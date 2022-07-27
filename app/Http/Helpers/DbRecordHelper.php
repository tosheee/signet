<?php

use App\Admin\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class DbRecordHelper
{
    public static function getLastProductId($tableName)
    {
        return DB::table($tableName)->latest('id')->first()->id;
    }

    public static function storeAndResizeImages($filePic, $pathToStore, $new_name = 'basic', $resize_percent)
    {
        $extension = $filePic->getClientOriginalExtension();

        $fileNameToStore = $new_name.'_'.time().'.'.$extension;

        $pathToStore = DbRecordHelper::makePath($pathToStore);

        list($width, $height) = getimagesize($filePic->getRealPath());

        if ($new_name == 'original')
        {
            $resize_percent = 100;
        }

        $newWidth  = intval(($resize_percent / 100) * $width);

        $newHeight = intval(($resize_percent / 100) * $height);


        Image::make(
            $filePic->getRealPath())->
            resize($newWidth, $newHeight)->
            save($pathToStore.'/'.$fileNameToStore
        );


        return $fileNameToStore;
    }

    public static function makePath($pathToStore){
        $public_images = '/public/images/';

        if(!is_dir($pathToStore))
        {
            Storage::makeDirectory($public_images.''.$pathToStore, 0775, true); //created in storage/app
        }

        return  storage_path('app/'.$public_images.''.$pathToStore);
    }

    public static function deleteDir($path){
        Storage::deleteDirectory($path);
    }

    public static function deleteFile($path){
        Storage::delete($path);
    }

    public static function cirilicToLatin($text){

        $cyr = [
            ' ', 'Љ', 'Њ', 'Џ', 'џ', 'ш', 'ђ', 'ч', 'ћ', 'ж', 'љ', 'њ',
            'Ш', 'Ђ', 'Ч', 'Ћ', 'Ж', 'Ц', 'ц', 'а', 'б', 'в', 'г', 'д', 'е',
            'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с',
            'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю',
            'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К',
            'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч',
            'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
        ];

        $lat = [
            '_', 'Lj', 'Nj', 'Dž', 'dž', 'š', 'đ', 'č', 'ć', 'ž', 'lj',
            'nj', 'Š', 'Đ', 'Č', 'Ć', 'Ž', 'C', 'c', 'a', 'b', 'v', 'g', 'd',
            'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's',
            't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sht', 'a', 'i', 'y', 'e', 'yu', 'ya',
            'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N',
            'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'I',
            'Y', 'e', 'Yu', 'Ya'
        ];

        return str_replace($cyr, $lat, $text);
    }
}