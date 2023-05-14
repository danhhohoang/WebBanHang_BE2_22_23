<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Protype;
use App\Cart;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index(){
        
        //get all protype
         $protype = Protype::all();
    
        //Get product to filter
        $products = Product::select('*', 'products.name AS product_name', 'products.id AS product_id')
            ->leftJoin('protypes', 'protypes.id', '=', 'products.type_id')
            ->where('featured', '=', '1')
            ->orderBy('products.name', 'desc')
            ->take(20)
            ->get();

        //return
        return view(
            'user.index',
            [
                'getProtypes' => $protype,
                'getProducts' => $products,
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
}
