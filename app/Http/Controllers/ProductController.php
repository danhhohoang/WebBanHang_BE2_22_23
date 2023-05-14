<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Protype;

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
}
