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
	    if($status == 2) $statusOld = ' Đang xử lý';
	    if($status == 1) $statusOld = ' Đã xử lý';
	    if($status == 3) $statusOld = ' Hủy ';
	    if(isset($request->status)){
	    if($request->status == 2) $statusNew = ' Đang xử lý';
	    if($request->status == 1) $statusNew = ' Đã xử lý';
	    if($request->status == 3) $statusNew = ' Hủy ';	
	    $order->update(['status'=>$request->status]);
	    return back()->with('success','Bạn đã thay đổi trạng thái đơn hàng có mã số ' .$order->id.'  từ trạng thái '. $statusOld . ' sang trạng thái  '. $statusNew );
	    }		
    }

    public function Search(Request $request)
    {	
    	if( !empty($request->search)) {
    		$keyword = $request->search;
    		$orders = DB::table('order')
    		->join('users','order.users_id','=','users.id')
    		->where('order.id','like', $keyword)
    		->orWhere('users.fullname','like',"%".$keyword."%")
    		->orWhere('date_shipper','like',$keyword)
    		->select('order.id','order.users_id','users.fullname','order.address','order.date_shipper','order.total','order.status')
    		->paginate(4)->appends(request()->query());    			
    		return view('admin.order.list',compact('orders'));
    	}
	}

	public function Date(Request $request)

	{
		$startdate = isset($request->startdate) ? $request->startdate : '1970-01-01';
		$enddate = 	isset($request->enddate) ? $request->enddate : date("Y-m-d", time());
		$orders = Order::whereBetween('created_at',[$startdate, $enddate])->paginate(4)->appends(request()->query());
		return view('admin.order.list',compact('startdate','enddate','orders'));	
		
	}

	public function Status($id)
	{
		if (!empty($id)) {
			$orders = Order::where('status', '=', $id)->paginate(4)->appends(request()->query());
			return view('admin.order.list', compact('orders'));
		}
	}
}
