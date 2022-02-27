<?php
    View::composer('*', function($view) { $view->with('siteViewInformation', App\Admin\InfoCompany::orderBy('created_at', 'desc')->first()); });
    View::composer('*', function($view) { $view->with('categoriesButtonsName', App\Admin\Category::all()); });
    View::composer('*', function($view) { $view->with('subCategoriesButtonsName', App\Admin\SubCategory::all()); });
    View::composer('*', function($view) {$view->with('categories', App\Admin\Category::all());});
    View::composer('*', function($view) {$view->with('subCategories', App\Admin\SubCategory::all());});
    View::composer('*', function($view) {$view->with('allSliderData', App\Admin\Slider::all());});
    View::composer('*', function($view) {$view->with('pagesButtonsRender', App\Admin\Page::where('active_page', true)->get());});

    Auth::routes();

    // emails
    Route::get('/', 'WelcomeController@welcome');

    // design
    Route::get('/designer', ['uses' => 'DesignerController@index', 'as'   => 'designer.index']);

    // store
    Route::get('/store',                       ['uses' => 'StoreController@index',          'as'   => 'store.index']);
    Route::get('/store/view_user_orders/{id}', ['uses' => 'StoreController@viewUserOrders', 'as'   => 'store.index']);
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


        Route::resource('/categories',       'CategoriesController');
        Route::resource('/sub_categories',   'SubCategoriesController');
        Route::resource('/print_templates',  'PrintTemplatesController');
        Route::resource('/products',         'ProductsController');
        Route::resource('/users',            'UserController');
        Route::resource('info_company',      'InfoCompanyController');
        Route::resource('admins',            'AdminController');
        Route::resource('/pages',            'PagesController');
        Route::resource('/slider',           'SliderController');
        Route::resource('/user_messages',    'UserMessagesController');
        Route::resource('/support_messages', 'SupportMessagesController');
    });

    Route::post('admin/products/create/{id?}', function($id = null) {
        $subCategoryAttributes = App\Admin\SubCategory::where('category_id', $id)->get();
        $subCategoryOptions = array();
        foreach($subCategoryAttributes as $key => $subCatAttribute)
        {
            $subCategoryOptions[$key] = [$subCatAttribute->id, $subCatAttribute->name, $subCatAttribute->identifier];
        }

        return $subCategoryOptions;
    });

    //tests
    Route::get('/welcome_test', function(){
        return view('emails.welcome_test');
    });
