<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\EmailNewsletter;
use App\Models\Newsletter;
use App\Models\Product;
use App\Models\Protype;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        //get all protype
        $protype = Protype::all();

        //Get product to filter
        $products = Product::select('*', 'products.name AS product_name', 'products.id AS product_id')
            ->leftJoin('protypes', 'protypes.id', '=', 'products.type_id')
            ->where('featured', '=', '1')
            ->orderBy('products.name', 'desc')
            ->take(20)
            ->get();



        //Get 10 new products
        $get10Products = Product::orderBy('created_at', 'desc')->take(10)->get();

        $latestProduts = Product::orderBy('created_at', 'asc')->take(6)->get();

        //Get low price produts
        $lowPriceProducts = Product::select('*', DB::raw('price - price*sales/100 AS price_discount'))->orderBy('price_discount', 'asc')->take(6)->get();

        //Get high price produts
        $highPriceProducts = Product::select('*', DB::raw('price - price*sales/100 AS price_discount'))->orderBy('price_discount', 'desc')->take(6)->get();
        //Get sale off
        $saleOff = Product::select('*', 'products.name AS product_name', 'products.id AS product_id')
            ->leftJoin('protypes', 'protypes.id', '=', 'products.type_id')
            ->where('sales', '>', '0')
            ->orderBy('sales', 'desc')
            ->take(9)
            ->get();
        //return
        return view(
            'user.index',
            [
                'getProtypes' => $protype,
                'getProducts' => $products,
                'getNewProduct' => $get10Products,
                'getLatestProduct' => $latestProduts,
                'getLowPriceProduct' => $lowPriceProducts,
                'getHighPriceProduct' => $highPriceProducts,
                'saleOff' => $saleOff,
            ]
        );
    }
    public function getSearch(Request $request)
    {
        $url = $request->path();
        $type = explode('/', $url);

        // Get all protype
        $protypes = Protype::all();

        //Get latest products
        $latestProduts = Product::orderBy('created_at', 'asc')->take(6)->get();

        // Get product by prince
        $orderprice = isset($_GET['field']) ? $_GET['field'] : "price";
        $ordersort = isset($_GET['sort']) ? $_GET['sort'] : "desc";

        //Get price
        $min = isset($_GET['Min']) ? $_GET['Min'] : "0";
        $max = isset($_GET['Max']) ? $_GET['Max'] : "500";

        //Get 6 products
        if (isset($type[1])) {
            $product = Product::orderBy('id', 'desc')->where('type_id', $type[1])->paginate(6);
        } else {
            $product = Product::orderBy('id', 'desc')->paginate(6);
        }

        if ($orderprice == "price") {
            $productsearch = Product::select('*', 'products.name AS product_name', 'products.id AS product_id', DB::raw('price - price*sales/100 AS price_discount'))
                ->join('protypes', 'protypes.id', '=', 'products.type_id')
                ->orderBy('price_discount', $ordersort)
                ->where('products.name', 'like', '%' . $request->key . '%')
                ->whereBetween('price', [$min, $max])
                ->paginate(9);
        } else {
            $productsearch = Product::select('*', 'products.name AS product_name', 'products.id AS product_id', DB::raw('price - price*sales/100 AS price_discount'))
                ->join('protypes', 'protypes.id', '=', 'products.type_id')
                ->orderBy($orderprice, $ordersort)
                ->where('products.name', 'like', '%' . $request->key . '%')
                ->whereBetween('price', [$min, $max])
                ->paginate(9);
        }

        //Count product
        $count = Product::orderBy($orderprice, $ordersort)
            ->where('products.name', 'like', '%' . $request->key . '%')
            ->whereBetween('price', [$min, $max])
            ->get();

        //price Min,Max product
        $minProduct = Product::min('price');
        $maxProduct = Product::max('price');

        //Get sale off
        $saleOff = Product::select('*', 'products.name AS product_name', 'products.id AS product_id')
            ->leftJoin('protypes', 'protypes.id', '=', 'products.type_id')
            ->where('sales', '>', '0')
            ->orderBy('sales', 'desc')
            ->take(9)
            ->get();
        $key = $request->key;

        return view(
            'user.search',
            [
                'countAllProduct' => $count,
                'getProtypes' => $protypes,
                'getProducts' => $product,
                'getLatestProduct' => $latestProduts,
                'productsearch' => $productsearch,
                'request' => $request,
                'saleOff' => $saleOff,
                'minproduct' => $minProduct,
                'maxproduct' => $maxProduct,
                'key' => $key,
                'field' => $orderprice,
                'sort' => $ordersort,
            ]
        );
    }
    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        return view('user.cart');
    }
    public function getCart()
    {
        $protypes = Protype::all();
        if (!Session::has('cart')) {
            return view('user.shoping-cart', [
                'getProtypes' => $protypes,
            ]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('user.shoping-cart', [
            'getProtypes' => $protypes,
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
        ]);
    }
    public function addToCartDetailGrid(Request $request, $detailGrid, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);

        return view('user.cart');
    }

    public function addToCartMul(Request $request, $mul, $id, $quantity)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addToCartMulti($product, $product->id, $quantity);
        $request->session()->put('cart', $cart);

        return view('user.cart');
    }

    public function product_detail($id)
    {
        //View product detail
        $detail = Product::findorFail($id);
        $type = Product::select('protypes.name')->join('protypes', 'protypes.id', '=', 'products.type_id')
            ->where('products.id', $id)
            ->get()->toArray();
        $products = Product::select('*', 'products.name AS product_name', 'products.id AS product_id')
            ->leftJoin('protypes', 'protypes.id', '=', 'products.type_id')
            ->where('featured', '=', '1')
            ->orderBy('products.name', 'desc')
            ->take(20)
            ->get();
        return view(
            'user.shop-details',
            [
                'productDetail' => $detail,
                'getType' => $type,
                'getProducts' => $products,
            ]
        );
    }
    function drid(Request $request)
    {

        //Get product
        $url = $request->path();
        $type = explode('/', $url);

        // Get all protype
        $protypes = Protype::all();

        // Get product by prince
        $orderprice = isset($_GET['field']) ? $_GET['field'] : "price";
        $ordersort = isset($_GET['sort']) ? $_GET['sort'] : "desc";

        //Get latest products
        $latestProduts = Product::orderBy('created_at', 'asc')->take(6)->get();

        //Get price
        $min = isset($_GET['Min']) ? $_GET['Min'] : "0";
        $max = isset($_GET['Max']) ? $_GET['Max'] : "500";

        //Get 9 new products
        if (isset($type[1])) {
            if ($orderprice == "price") {
                $product = Product::select('*', 'products.name AS product_name', 'products.id AS product_id', DB::raw('price - price*sales/100 AS price_discount'))
                    ->leftJoin('protypes', 'protypes.id', '=', 'products.type_id')
                    ->orderBy('price_discount', $ordersort)
                    ->where('type_id', $type[1])
                    ->whereBetween('price', [$min, $max])
                    ->paginate(9);
            } else {
                $product = Product::select('*', 'products.name AS product_name', 'products.id AS product_id', DB::raw('price - price*sales/100 AS price_discount'))
                    ->leftJoin('protypes', 'protypes.id', '=', 'products.type_id')
                    ->orderBy($orderprice, $ordersort)
                    ->where('type_id', $type[1])
                    ->whereBetween('price', [$min, $max])
                    ->paginate(9);
            }

            $count = Product::orderBy($orderprice, $ordersort)
                ->where('type_id', $type[1])
                ->whereBetween('price', [$min, $max])
                ->get();

            //price Min,Max product
            $minProduct = Product::where('type_id', $type[1])
                ->min('price');
            $maxProduct = Product::where('type_id', $type[1])
                ->max('price');
        } else {
            if ($orderprice == "price") {
                $product = Product::select('*', 'products.name AS product_name', 'products.id AS product_id', DB::raw('price - price*sales/100 AS price_discount'))
                    ->leftJoin('protypes', 'protypes.id', '=', 'products.type_id')
                    ->orderBy('price_discount', $ordersort)
                    ->whereBetween('price', [$min, $max])
                    ->paginate(9);
            } else {
                $product = Product::select('*', 'products.name AS product_name', 'products.id AS product_id', DB::raw('price - price*sales/100 AS price_discount'))
                    ->leftJoin('protypes', 'protypes.id', '=', 'products.type_id')
                    ->orderBy($orderprice, $ordersort)
                    ->whereBetween('price', [$min, $max])
                    ->paginate(9);
            }

            $count = Product::orderBy($orderprice, $ordersort)
                ->whereBetween('price', [$min, $max])
                ->get();

            //price Min,Max product
            $minProduct = Product::min('price');
            $maxProduct = Product::max('price');
        }

        //Get sale off
        $saleOff = Product::select('*', 'products.name AS product_name', 'products.id AS product_id')
            ->leftJoin('protypes', 'protypes.id', '=', 'products.type_id')
            ->where('sales', '>', '0')
            ->orderBy('sales', 'desc')
            ->take(9)
            ->get();

        return view(
            'user.shop-grid',
            [
                'countAllProduct' => $count,
                'getProtypes' => $protypes,
                'getProducts' => $product,
                'getLatestProduct' => $latestProduts,
                'saleOff' => $saleOff,
                'type' => $type,
                'minproduct' => $minProduct,
                'maxproduct' => $maxProduct,
                'min' => $min,
                'max' => $max,
                'field' => $orderprice,
                'sort' => $ordersort,
            ]
        );
    }
    public function deleteItemCart(Request $request, $id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->deleteItem($id);

        if (Count($newCart->items) > 0) {
            $request->session()->put('cart', $newCart);
        } else {
            $request->session()->forget('cart');
        }
        return view('user.deleteCart');
    }


    //newsletter
    public function storeEmail(Request $request){
        Newsletter::create(['email'=> $request->email]);
        $mail_controller = new EmailController;
        $subscriber_message = EmailNewsletter::where('action','NEWSLETTER_SUBSCRIPTION_CUSTOMER')->first();
        $admin_message = EmailNewsletter::where('action','NEWSLETTER_SUBSCRIPTION_ADMIN')->first();
        if($subscriber_message){
            $mail_controller->sendEmail($subscriber_message->title, $subscriber_message->subject, $subscriber_message->body,$request->email);
        }
        if($admin_message){
            $admins = Newsletter::where('email',$request->email)->get();
            foreach($admins as $admin){
                $mail_controller->sendEmail($admin_message->title, $admin_message->subject, $admin_message->body,$admin->email,'','Admin');

            }
        }
        return back();
    }


    public function saveAllItemCart(Request $request)
    {
        foreach ($request->data as $item) {
            if ($item['value'] == 0) {
                // If the quantity is 0, delete the item from the cart
                $this->deleteItemCart($request, $item['key']);
            } else {
                // Otherwise, update the quantity of the item in the cart
                $oldCart = Session('cart') ?  Session('cart') : null;
                $newCart = new Cart($oldCart);
                $newCart->updateAllCart($item['key'], $item['value']);
                $request->Session()->put('cart', $newCart);
            }
        }
    }
    public function checkOut()
    {
        $protypes = Protype::all();
        return view('user.checkout', [
            'getProtypes' => $protypes,
        ]);
    }
    public function saveCheckOut(Request $request)
    {
        $currentTime = date('Y-m-d H:i:s');
        $auth = auth()->user()->name;
        $data = array();
        $data['user_id'] = auth()->user()->id;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['order_date'] = $currentTime;
        $data['username'] = $request->username;
        if ($data['total_money'] = Session::get('cart')->totalPrice > 99) {
            $data['total_money'] = Session::get('cart')->totalPrice;
        } else {
            $data['total_money'] = Session::get('cart')->totalPrice + 10;
        }
        $id = DB::table('orders')->insertGetId($data);
        Session::put('id', $id);

        foreach ((array) Session::get('cart')->items as $product) {
            $data = array();
            $data['order_id'] = $id;
            $data['product_id'] = $product['item']->id;
            $data['quantity'] = $product['qty'];

            $data['price'] = $product['price'];
            DB::table('orders_list')->insertGetId($data);
        }
        $request->session()->forget('cart');

        return redirect('/transaction-history')->with('alert-success', 'Thank you for your purchase');;
    }
    public function transactionHistory()
    {
        $protypes = Protype::all();
        $items = DB::table('orders')->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('user.transaction-history', [
            'getProtypes' => $protypes,
            'items' => $items
        ]);
    }
    public function transactionDetail($order_id)
    {

        $protypes = Protype::all();

        $orderProducts = DB::table('orders_list')->join('products', 'product_id', '=', 'id')->where('order_id', $order_id)->get();


        // dd($orderProducts);
        return view('user.transaction-detail', [
            'getProtypes' => $protypes,
            'orderProducts' => $orderProducts
        ]);
    }
}
