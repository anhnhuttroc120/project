<?php

namespace App\Http\Controllers;
use App\Order;
use App\Order_detail;
use App\Product;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list()
    {
    	$orders = Order::paginate(4);
    	$data['done']=Order::where('status', 1)->count();
    	$data['waiting']=Order::where('status', 0)->count();
    	$data['cancel']=Order::where('status', 2)->count();

    	return view('admin.order.list', compact('orders', 'data'));
    }
    public function detail($id)
    {	
    	$order = Order::findOrFail($id);

    	return view('admin.order.detail', compact('order'));
    }
    public function changeStatus($id, Request $request)
    {
	    $order = Order::findOrFail($id);
	    $status = $order->status;
	    if($status == 0) $statusOld = ' Đang xử lý';
	    if($status == 1) $statusOld = ' Đã xử lý';
	    if($status == 2) $statusOld = ' Hủy ';
	    if(isset($request->status)){
	    if($request->status == 0) $statusNew = ' Đang xử lý';
	    if($request->status == 1) $statusNew = ' Đã xử lý';
	    if($request->status == 2) $statusNew = ' Hủy ';	

	     $order->update(['status'=>$request->status]);
	     return back()->with('success','Bạn đã thay đổi trạng thái đơn hàng có mã số ' .$order->id.'  từ trạng thái '. $statusOld . ' sang trạng thái  '. $statusNew );
	    }
	    
    			
    }
}
