<?php

namespace App\Http\Controllers;
use App\Order;
use App\Order_detail;
use App\Product;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller

{	
    public function list(Request $request)

    {
	 	$query = Order::query();
	 	if ($request->has('keyword')) {
	 		$keyword = $request->keyword;
	 		$query->whereHas('user',function($query) use($keyword){
	 		$query->where('fullname','like',"%".$keyword . "%");
			})->orwhere('id','like',"%".$keyword."%");
	 		
	 	}
	 	if ($request->has('enddate')) {
	 		$startdate = ($request->startdate == '') ? '1970-01-01'  : $request->startdate;
	 		$enddate = ($request->enddate == '') ?  date('Y-m-d',time()) : $request->enddate;;
	 		$query->whereBetween('created_at',[$startdate, $enddate]);
	 	}
		if ($request->ajax()) {
			$orders = $query->paginate(4)->appends(['keyword'=>$request->keyword, 'startdate'=>$startdate, 'enddate'=>$enddate]);	
		 	$view = view('ajax.order', compact('orders'))->render();
			return response()->json(['view'=>$view], 200);
		}
		
		$orders = $query->paginate(4)->appends(request()->query());
		return view('admin.order.list', compact('orders', 'keyword','startdate','enddate'));			
		
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
	    if ($status == 2) $statusOld = ' Đang xử lý';
	    if ($status == 1) $statusOld = ' Đã xử lý';
	    if ($status == 3) $statusOld = ' Hủy ';
	    if (isset($request->status)){
	    if ($request->status == 2) $statusNew = ' Đang xử lý';
	    if ($request->status == 1) $statusNew = ' Đã xử lý';
	    if ($request->status == 3) $statusNew = ' Hủy ';	
	    $order->update(['status'=>$request->status]);
	    return back()->with('success','Bạn đã thay đổi trạng thái đơn hàng có mã số ' .$order->id.'  từ trạng thái '. $statusOld . ' sang trạng thái  '. $statusNew );
	    }		
    }

	public function Status($id)
	{
		if (!empty($id)) {
			$orders = Order::where('status', '=', $id)->paginate(4)->appends(request()->query());
			return view('admin.order.list', compact('orders'));
		}
	}
}
