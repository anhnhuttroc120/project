<?php

namespace App\Http\Controllers;
use App\Order;
use App\Order_detail;
use App\Product;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list(){
    	$order_detail=Order_detail::find(5);
    	$sp=$order_detail->product;
    	dd($sp);

    	// return view('admin.order.list',compact('orders'));
    }
     public function detail(){
    	return view('admin.order.detail');
    }
}
