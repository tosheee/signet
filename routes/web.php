<?php
    View::composer('*', function($view) { $view->with('siteViewInformation', App\Admin\InfoCompany::orderBy('created_at', 'desc')->first()); });
    View::composer('*', function($view) { $view->with('categoriesButtonsName', App\Admin\Category::all()); });
    View::composer('*', function($view) { $view->with('subCategoriesButtonsName', App\Admin\SubCategory::all()); });
    View::composer('*', function($view) { $view->with('typePrintTemplates', App\Admin\TypePrintTemplate::all()); });

    View::composer('*', function($view) {$view->with('subCategories', App\Admin\SubCategory::all());});
    View::composer('*', function($view) {$view->with('allSliderData', App\Admin\Slider::all());});
    View::composer('*', function($view) {$view->with('pagesButtonsRender', App\Admin\Page::where('active_page', true)->get());});

    View::composer('*', function($view) {$view->with('adminCategories', App\Admin\Category::all());});
    View::composer('*', function($view) {$view->with('sideBarCategories', App\Admin\Category::all());});

    Auth::routes();

    // emails
    Route::get('/', 'WelcomeController@welcome');

    // design
    Route::get('/designer/{category}', ['uses' => 'DesignerController@searchCategory', 'as'   => 'designer.searchCategory']);
    Route::get('/designer', ['uses' => 'DesignerController@index', 'as'   => 'designer.index']);


    // store
    Route::get('/store',                       ['uses' => 'StoreController@index',          'as'   => 'store.index']);
    Route::get('/store/view_user_orders/{id}', ['uses' => 'StoreController@viewUserOrders', 'as'   => 'store.index']);
    Route::get('/store/search/{category}',     ['uses' => 'SearchController@searchCategory',        'as'   => 'store.searchCategory']);
    Route::get('/store/search',                ['uses' => 'SearchController@search',        'as'   => 'store.search']);

    Route::get('/store/{id}',                  ['uses' => 'StoreController@show',           'as'   => 'store.show']);
    Route::post('/store/like_product/{id}',    'StoreController@getLikeProduct');

    Route::get('/page',               ['uses' => 'StoreController@getShowPages',    'as'  => 'store.showPage']);
    Route::post('/add-to-cart',       'StoreController@getAddToCart');
    Route::post('/send-user-message', 'StoreController@postUserMessage');
    Route::post('/remove/{id}',       ['uses' => 'StoreController@getRemoveItem',   'as'  => 'store.remove']);
    Route::get('/checkout',           ['uses' => 'StoreController@getCheckout',     'as'  => 'store.checkout']);
    Route::get('/terms_of_use',       ['uses' => 'StoreController@getTermsOfUse',   'as'  => 'store.terms_of_use']);
    Route::get('/personal_data',      ['uses' => 'StoreController@getPersonalData', 'as'  => 'store.personal_data']);
    Route::get('/shopping-cart',      ['uses' => 'StoreController@getCart',         'as'  => 'store.shoppingCart']);
    Route::post('/checkout',          'StoreController@postCheckout');


    // Admin
    Route::group(['prefix' => 'admin'], function() {
        Route::get    ('/dashboard',            ['uses' => 'AdminController@index']);
        Route::get    ('/not_completed_orders', ['uses' => 'AdminController@not_completed_orders']);
        Route::get    ('/dashboard/{id}',       ['uses' => 'AdminController@viewOffer']);
        Route::get    ('/completed_order/{id}', ['uses' => 'AdminController@completedOrder']);
        Route::delete ('/dashboard/{id}',       ['uses' => 'AdminController@destroy']);
    });

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
        Route::get('/products/search', ['uses' => 'ProductsController@search_category', 'as' => 'search_category' ]);
        Route::get ('',                ['uses' => 'LoginController@showLoginForm',      'as' => 'admin.login']);
        Route::post('',                ['uses' => 'LoginController@login']);
        Route::get ('/answer/{id}',    ['uses' => 'UserMessagesController@markAnswer']);


        Route::resource('/categories',           'CategoriesController');
        Route::resource('/sub_categories',       'SubCategoriesController');
        Route::resource('/print_templates',      'PrintTemplatesController');
        Route::resource('/type_print_templates', 'TypePrintTemplatesController');
        Route::resource('/products',             'ProductsController');
        Route::resource('/users',                'UserController');
        Route::resource('info_company',          'InfoCompanyController');
        Route::resource('admins',                'AdminController');
        Route::resource('/pages',            'PagesController');
        Route::resource('/slider',           'SliderController');
        Route::resource('/user_messages',    'UserMessagesController');
        Route::resource('/support_messages', 'SupportMessagesController');
        Route::resource('/base_product_template', 'BaseProductTemplateController');
    });

    Route::get('admin/products/get_base_product_templates/{id?}', function($id = null) {
        $baseProductTemplates = App\Admin\BaseProductTemplate::where('category_id', $id)->get();
        $typePrintTemplates = App\Admin\TypePrintTemplate::where('category_id', $id)->get();

        $templates = '<div id="avatarlist" style="max-height: 500px; overflow: scroll; text-align: -webkit-center;">
                        <input type="hidden" id="input-category-id" value="'.$id.'">';

        if(isset($baseProductTemplates))
        {
            foreach($baseProductTemplates as $baseProductTemplate)
            {
                $content = json_decode($baseProductTemplate->content, true);
                foreach($content['images'] as $baseProductImage )
                {
                    $templates .= '<img class="img-base-polaroid tt" width="100" height="100" src="'.
                        $baseProductImage.'" alt="pic" style="margin: 0 auto; width: 80px;height: 100px;"/>';
                }
            }
        }

        $selectTypePrint = '<div class="form-group{{ $errors->has(\'category_id\') ? \' has-error\' : \'\' }}">
                                <label>
                                    <span>Type:<sup style="color: red;">*</sup></span>
                                    <select class="form-control" name="pp_id" id="select-print-templates" required="required"  oninvalid="this.setCustomValidity(\'Please enter!\')" oninput="setCustomValidity(\'\')">
                                        <option value="">Choose type</option>';

        foreach($typePrintTemplates as $type)
        {
            $selectTypePrint .= '<option value="'.$type->id.'" data-content="">'.$type->name.'</option>';
        }

        $selectTypePrint .= '</select></label></div>';
        return $templates.'</div>'.$selectTypePrint;

    });

    Route::get('admin/products/get_print_templates/{id?}', function($id = null) {
        $printTemplates = App\Admin\PrintTemplate::where('category_id', $id)->get();
        $printTemplatesHtml = '<div id="avatarlist" style="max-height: 500px; overflow: scroll; text-align: -webkit-center;">
                                <input type="hidden" id="input-category-id" value="'.$id.'">';

        if(isset($printTemplates))
        {
            foreach($printTemplates as $printTemplate)
            {
                $printContent = json_decode($printTemplate->content, true);
                foreach($printContent['images'] as $printImage )
                {
                    $printTemplatesHtml .= '<img class="img-polaroid tt" width="100" height="100" src="'.
                        $printImage.'" alt="pic" style="margin: 0 auto; width: 80px;height: 100px;"/>';
                }
            }
        }

        return $printTemplatesHtml.'</div>';
    });







/////////////////////////////////////////////////////////////////////////////////////////////




//tests
//    Route::get('/welcome_test', function(){
    //    return view('emails.welcome_test');
  //  });


//$subCategoryAttributes = App\Admin\SubCategory::where('category_id', $id)->get();
//$subCategoryOptions = array();

//dd($subCategoryAttributes);

//foreach($subCategoryAttributes as $key => $subCatAttribute)
//{
//  $subCategoryOptions[$key] = [$subCatAttribute->id, $subCatAttribute->name, $subCatAttribute->identifier];
//}

//return $subCategoryOptions;