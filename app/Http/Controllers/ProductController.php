<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Protype;
use App\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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
        //return
        return view(
            'User.index',
            [
                'getProtypes' => $protype,
                'getProducts' => $products,
                'getNewProduct' => $get10Products,
                'getLatestProduct' => $latestProduts,
                'getLowPriceProduct' => $lowPriceProducts,
                'getHighPriceProduct' => $highPriceProducts,
            ]
        );
    }
    function getSearch(Request $request)
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
}