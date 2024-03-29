<?php

use App\Admin\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class DbRecordHelper
{
    public static function getLastProductId($tableName)
    {
        if(!isset(DB::table($tableName)->latest('id')->first()->id))
        {
            $table_columns = DB::select('SHOW COLUMNS FROM '.$tableName);
            $insert_query = [];

            foreach($table_columns as $raw_column)
            {
                $column = json_decode(json_encode($raw_column), true);
                if ($column['Field'] == 'id' || $column['Null'] == "YES")
                {
                    continue;
                }

                if ($column['Type'] == 'int unsigned' || $column['Type'] == 'int' || $column['Type'] == 'tinyint(1)')
                {
                    $insert_query[$column['Field']] = 1;
                }
                elseif($column['Type'] == 'varchar(255)' || $column['Type'] == 'text')
                {
                    $insert_query[$column['Field']] = '';
                }
            }

            DB::table($tableName)->insert($insert_query);
            $oldId = DB::table($tableName)->latest('id')->first()->id;
            DB::table($tableName)->where('id', '=', $oldId)->delete();
        }
        else
        {
            $oldId = DB::table($tableName)->latest('id')->first()->id;
        }

        return $oldId;
    }

    public static function recordImages($images, $path_store, $record_id, $percents_images, $keep_and_origin = [])
    {
        $image_names = [];

        for($i = 0; $i < count($images); $i++)
        {
            if(!empty($keep_and_origin))
            {
                foreach($keep_and_origin as $new_name)
                {
                    $image_names[$i] = self::storeAndResizeImages(
                        $images[$i],
                        $path_store.'/'.$record_id,
                        $new_name,
                        $percents_images[$i]
                    );
                }
            }
            else
            {
                $image_names[$i] = self::storeAndResizeImages(
                    $images[$i],
                    $path_store.'/'.$record_id,
                    $i.'_base',
                    $percents_images[$i]
                );
            }
        }

        return $image_names;
    }

    public static function storeAndResizeImages($filePic, $pathToStore, $new_name = 'basic', $resize_percent)
    {
        $extension = $filePic->getClientOriginalExtension();
        $fileNameToStore = $new_name.'-'.time().'.'.$extension;
        $pathToStore = DbRecordHelper::makePath($pathToStore);

        list($width, $height) = getimagesize($filePic->getRealPath());

        if (str_contains($new_name, 'origin') || empty($resize_percent))
        {
            $resize_percent = 100;
        }

        $newWidth  = intval(($resize_percent / 100) * $width);
        $newHeight = intval(($resize_percent / 100) * $height);

        $full_path = $pathToStore.'/'.$fileNameToStore;

        Image::make(
            $filePic->getRealPath())->
            resize($newWidth, $newHeight)->
            save($pathToStore.'/'.$fileNameToStore
        );

        // dd($full_path);
        // need link: http://127.0.0.1:8000/storage/images/base_templates/35/0_base_1659246437.png
        // full_path: home/toshe/Desktop/php_projects/signet/storage/app/public/images/print_templates/40small_1659504269.png
        // return $fileNameToStore; >> // file name
        // dd(end($splitPath));

        $splitPath = explode('public', $full_path);
        return '/storage'.end($splitPath);
    }

    public static function makePath($pathToStore){
        $public_images = 'public/images/';

        if(!is_dir($pathToStore))
        {
            Storage::makeDirectory($public_images.''.$pathToStore, 0775, true); //created in storage/app
        }
        return  storage_path('app/'.$public_images.''.$pathToStore);
    }

    public static function deleteDirFromRecord($record)
    {
        if (isset($record->content))
        {
            $content = json_decode($record->content, true);
            if (isset($content['images']))
            {
                $splitImg = explode('/', $content['images'][0]);
                array_pop($splitImg);
                $rawPath = implode('/', $splitImg);
                $path = str_replace("storage", "public", $rawPath);
                // path example: "/public/images/print_templates/47"
                self::deleteDir($path);
            }
        }
    }

    public static function deleteDir($path)
    {
        Storage::deleteDirectory($path);
    }

    public static function deleteFile($path)
    {
        Storage::delete($path);
    }

    public static function cirilicToLatin($text)
    {
        $text = mb_strtolower($text,'UTF-8');
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
        '-', 'Lj', 'Nj', 'Dž', 'dž', 'š', 'đ', 'č', 'ć', 'ž', 'lj',
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