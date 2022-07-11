<?php

namespace App\Http\Controllers\Admin;

use App\Admin\BaseProductTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\PrintTemplate;
use App\Admin\TypePrintTemplate;
use Intervention\Image\ImageManagerStatic as Image;
use File;


class BaseProductTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $baseProductTemplates = BaseProductTemplate::all();

        return view('admin.base_product_template.index')->
        with('baseProductTemplates', $baseProductTemplates)->
        with('title', 'Base Template');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.base_product_template.create')->with('title', 'New product template');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template_name =  $this->cirilicToLatin($request->name);
        $images = $request->images;
        $content = [];

        $pathToStore = public_path('img/img_templates/base_product_templates');

        for($i = 0; $i < count($images); $i++)
        {
            $content['images'][$i] = $this->resizeImages($images[$i], $pathToStore, $template_name, $i, $request->input('resize_percent'));
        }
        $content['name'] = $template_name;
        $content['path_to_store'] = $pathToStore;

        $baseProduct = new BaseProductTemplate;
        $baseProduct->category_id = $request->input('category_id');
        $baseProduct->content = json_encode($content, JSON_UNESCAPED_UNICODE );
        $baseProduct->active = $request->input('active');
        $baseProduct->save();

        return redirect('admin/base_product_template')
            ->with('title', 'Нова категория')
            ->with('message', 'Категорията е създадена');
    }


    public function resizeImages($picture, $pathToStore, $template_name, $i, $resize_percent)
    {
        $extension = $picture->getClientOriginalExtension();
        $template_name = strtolower($template_name);

        $fileNameToStore =$i.'_'.$template_name.'.'.$extension;



        if(!is_dir($pathToStore))
        {
            Storage::makeDirectory($pathToStore, 0775, true);
        }

        list($width, $height) = getimagesize($picture->getRealPath());

        $newWidth  = intval(($resize_percent / 100) * $width);
        $newHeight = intval(($resize_percent / 100) * $height);

        Image::make($picture->getRealPath())->resize($newWidth, $newHeight)->save($pathToStore.'/'.$fileNameToStore);

        return $fileNameToStore;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\BaseProductTemplate  $baseProductTemplate
     * @return \Illuminate\Http\Response
     */

    public function cirilicToLatin($text){

        $cyr = [' ', 'Љ', 'Њ', 'Џ', 'џ', 'ш', 'ђ', 'ч', 'ћ', 'ж', 'љ', 'њ', 'Ш', 'Ђ', 'Ч', 'Ћ', 'Ж','Ц','ц', 'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п', 'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я', 'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П', 'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
        ];
        $lat = ['_', 'Lj', 'Nj', 'Dž', 'dž', 'š', 'đ', 'č', 'ć', 'ž', 'lj', 'nj', 'Š', 'Đ', 'Č', 'Ć', 'Ž','C','c', 'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p', 'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya', 'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P', 'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya'
        ];

        return str_replace($cyr, $lat, $text);
    }


    public function show(BaseProductTemplate $baseProductTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\BaseProductTemplate  $baseProductTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(BaseProductTemplate $baseProductTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\BaseProductTemplate  $baseProductTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BaseProductTemplate $baseProductTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\BaseProductTemplate  $baseProductTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(BaseProductTemplate $baseProductTemplate)
    {
        //
    }
}
