<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index() {
        $product = Product::all();

        // $emails = DB::Table('email_newsletters')->get();
            
        $orders = DB::Table('orders')->get();

        $newsOrder = DB::Table('orders')->whereDate('order_date', Carbon::today())->get();

        $chart = DB::select(DB::raw("SELECT `protypes`.`name`, count(*) as quantity from `protypes` JOIN `products` on `products`.`type_id` = `protypes`.`id` GROUP BY `protypes`.`name`"));
        $data = "";
        foreach($chart as $value) {
            $data.="['".$value->name."', ".$value->quantity."],";
        }
        return view('admin.index',[
            'product' => $product,
            // 'emails' => $emails,
            'orders' => $orders,
            'newsOrder' => $newsOrder,
            'dataChart' => $data,
        ]);
    }

    function newOder() {
        $newsOrder = DB::Table('orders')->whereDate('order_date', Carbon::today())->orderBy('order_date', 'desc')->get();

        return view('admin.admin-new-order',[
            'newsOrder' => $newsOrder,
        ]);
    }
}
