<?php

namespace App\Http\Controllers;

use Session;

use App\Cart;
use App\Like;
use App\Order;

use App\Admin\Page;
use App\Admin\Product;
use App\Admin\Category;
use App\Admin\UserMessage;
use App\Admin\SubCategory;
use App\Admin\SupportMessage;

use App\Mail\OrderProcess;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StoreController extends Controller
{
    // show all products
    public function index(Request $request)
    {
        $cat = $request->input('cat');
        $subCategories = SubCategory::all();
        $categoryId = -1;
        $show_sidebar = false;
        $categoryName = '';


        if (isset($cat))
        {
            $categories = Category::where('identifier', $cat)->get();
            $categoryId = $categories[0]->id;
            $categoryName = $categories[0]->name;
            $products = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->paginate(9);
        }
        else
        {
            $categories = Category::all();
            $show_sidebar = true;
            $products = Product::where('active', true)->where('recommended', 1)->orderBy('created_at', 'desc')->paginate(9);
        }

        $product_count = count($products);

        return view('store.index')->
                                    with('categories', $categories)->
                                    with('subCategories', $subCategories)->
                                    with('products', $products)->
                                    with('categoryId', $categoryId)->
                                    with('show_sidebar', $show_sidebar)->
                                    with('categoryName', $categoryName)->
                                    with('product_count', $product_count);
    }
    
    // show product
    public function show($id)
    {   if( ctype_digit ($id))
        {
            $product = Product::find($id);
            $categories = Category::all();
            $subCategories = SubCategory::all();

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
        }
        else
        {
            return view('errors.404');
        }
        
        if(isset($product))
        {
            $productsSale =        Product::where('active', true)->where('sale',         true)->orderBy('created_at', 'desc')->take(10)->get();
            $productsRecommended = Product::where('active', true)->where('recommended',  true)->orderBy('created_at', 'desc')->take(10)->get();
            $productsBestSeller =  Product::where('active', true)->where('best_sellers', true)->orderBy('created_at', 'desc')->take(10)->get();
            $metaDescription = json_decode($product->description, true);
            return view('store.show')
                ->with('categories', $categories)
                ->with('subCategories', $subCategories)
                ->with('product', $product)
                ->with('cart', $cart)
                ->with('metaDescription', $metaDescription)
                ->with('productsSale', $productsSale)
                ->with('productsRecommended', $productsRecommended)
                ->with('productsBestSeller', $productsBestSeller);
        }
        else
        {
            return view('errors.404');
        }
    }

    public function getLikeProduct($id)
    {
        $oldLikes = Like::where('product_id', $id)->get();
        $userInfo = \Auth::user();
        $status = true;

        if (isset($userInfo))
        {
            $userInfo = $userInfo->id;
        }
        else
        {
            $userInfo = \Request::ip();
        }

        foreach($oldLikes as $oldLike)
        {
            if($oldLike->user_ip == $userInfo)
            {
                $status = false;
                break;
            }
        }

        if($status == true)
        {
            $like = new Like;
            $like->product_id = $id;
            $like->user_ip = $userInfo;
            $like->likes  = true;
            $like->save();
        }

        $allLikes = count(Like::all());
        
        return $allLikes;
    }

    // shopping_cart
    public function getCart()
    {
        if(!Session::has('cart'))
        {
            return view('store.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('store.shopping-cart')
            ->with('products', $cart->items)
            ->with('totalPrice', $cart->totalPrice)
            ->with('totalQuantity', $cart->totalQty);
    }
    
    // checkout
    public function getCheckout()
    {
        if(!Session::has('cart')){
            return view('store.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('store.checkout')->with('cart', $cart);
    }
    
    // record checkout
    public function postCheckout(Request $request)
    {
        $this->validate($request, [
            'name'            => 'required',
            'last_name'       => 'required',
            'email'           => 'required',
            'phone'           => 'required',
            'address'         => 'required',
            'delivery_method' => 'required',
            'payment_method'  => 'required',
        ]);

        if(!Session::has('cart'))
        {
            return redirect()->route('store.shoppingCart');
        }

        $oldCart = Session::get('cart');
        $delivery_address = json_encode( $request->input('address'), JSON_UNESCAPED_UNICODE );
        $cart = base64_encode(serialize(new Cart($oldCart)));

        $order = new Order();
        $order->user_id         = $request->input('user_id');
        $order->name            = $request->input('name');
        $order->last_name       = $request->input('last_name');
        $order->email           = $request->input('email');
        $order->phone           = $request->input('phone');
        $order->address         = $delivery_address;
        $order->delivery_method = $request->input('delivery_method');
        $order->payment_method  = $request->input('payment_method');
        $order->company         = $request->input('company');
        $order->bulstat         = $request->input('bulstat');
        $order->note            = $request->input('note');
        $order->cart            = $cart;

        if(isset(Auth::user()->name))
        {
            Auth::user()->orders()->save($order);
        }
        else
        {
            $order->save();
        }

        Session::forget('cart');

        $user_order = [
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'cart'  => $oldCart
        ];

        \Mail::to($user_order['email'])->send(new OrderProcess($user_order));

        $categories = Category::all();
        $subCategories = SubCategory::all();
        $products = Product::where('active', true)->paginate(18);

        return view('store.index')
            ->with('categories', $categories)
            ->with('subCategories', $subCategories)
            ->with('products', $products);
    }

    // show-pages
    public function getShowPages(Request $request)
    {
        $active_page = Page::where('active_page', true)->get();
        $page = $active_page->where('url_page', $request->input('show'))->first();
         
        if(isset($page))
        {
        	return view('store.show-pages')->with('page', $page);
        } 
        else
        {
        	return $this->index();
        }
    }
    
    // show users orders
    public function viewUserOrders($id)
    {
        if (Auth::check() && Auth::user()->id == $id)
        {
            
            $userOrders = Order::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(18);

            return view('store.view-user-orders')->with('user_orders', $userOrders);
        }
        else
        {
          return view('errors.404');
        }
    }

    // add & remove products
    public function getAddToCart(Request $request)
    {
        $product = Product::find($request->input('product_id'));
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id, $request->input('product_quantity'));
        $request->session()->put('cart', $cart);
        $cart_product = [$cart->totalPrice, $cart->totalQty, $cart->items];
        
        return $cart_product;
    }

    public function getRemoveItem($id)
    {

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0)
        {
            Session::put('cart', $cart);
        }
        else
        {
            Session::forget('cart');
        }

        $cart_product = [$cart->totalPrice, $cart->totalQty, $cart->items];

        return $cart_product;
    }

    public function postUserMessage(Request $request)
   {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required',
            'message' => 'required',
        ]);

        $userMessage = new UserMessage;
        $userMessage->name    = $request->input('name');
        $userMessage->email   = $request->input('email');
        $userMessage->message = $request->input('message');
        $userMessage->save();

        return redirect()->back()->with('success', ['your message,here']);   
   }

    public function getPersonalData(){
        $personal_data = SupportMessage::where('name_support_messages', 'gdpr')->get()->first();

        if(isset($personal_data)){
            return view('store.personal_data')->with('personal_data',  $personal_data);
        }

        return redirect()->back();
    }

    public function getTermsOfUse(){
        $terms_of_use = SupportMessage::where('name_support_messages', 'terms_of_use')->get()->first();

        if(isset($terms_of_use)){
            return view('store.terms_of_use')->with('terms_of_use',  $terms_of_use);
        }

        return redirect()->back();
    }
}
