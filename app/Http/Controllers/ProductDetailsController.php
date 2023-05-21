<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Protype;
use Illuminate\Support\Facades\DB;
use SocialLinks\Page;
class ProductDetailsController extends Controller
{
    public function product_detail($id)
    {
        //get all protype
        $protype = Protype::all();

        //View product detail
        $detail = Product::find($id);

//Type of product
        $type = Product::select('protypes.name', 'protypes.id')->join('protypes', 'protypes.id', '=', 'products.type_id')
            ->where('products.id', $id)
            ->get()->toArray();

        // Share Social Network
        $url = "http://oganishop.site/shop-details/" . $detail->image1;
        $image = "http://oganishop.site/img/product".$detail->image1;
        $socialShare = \Share::page($url, $detail->name)
            ->facebook()
            ->twitter()
            ->telegram()
            ->pinterest()
            ->getRawLinks();

//Related product
        $relatedProduct = Product::select('*', 'products.name AS product_name', 'products.id AS product_id')
            ->leftJoin('protypes', 'protypes.id', '=', 'products.type_id')
            ->whereNotIn('products.id', [$id])
            ->where('products.type_id', $detail->type_id)
            ->take(9)
            ->get();
        // Kiem tra mua hang
        if (isset(auth()->user()->id)) {
            $checkPurchase = DB::table('orders')->join('orders_list', 'id', '=', 'order_id')
                ->where('orders.user_id', auth()->user()->id)
                ->where('orders_list.product_id', $id)->get();
            return view(
                'user.shop-details',
                [
                    'getProtypes' => $protype,
                    'productDetail' => $detail,
                    'getType' => $type,
                    'shareSocial' => $socialShare,
                    'getRelatedProduct' => $relatedProduct,
                    // 'ratingAvg' => $ratingAvg,
                    // 'countRating' => $countRating,
                    // 'getRating' => $getRating,
                    'checkPurchase' => $checkPurchase,
                ]
            );
        } else {
            $checkPurchase = 0;
            return view(
                'user.shop-details',
                [
                    'getProtypes' => $protype,
                    'productDetail' => $detail,
                    'getType' => $type,
                    'shareSocial' => $socialShare,
                    'getRelatedProduct' => $relatedProduct,
                    // 'ratingAvg' => $ratingAvg,
                    // 'countRating' => $countRating,
                    // 'getRating' => $getRating,
                    'checkPurchase' => $checkPurchase,
                ]
            );
        }
    }

}
