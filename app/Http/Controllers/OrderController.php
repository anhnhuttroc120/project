<?php

namespace App\Http\Controllers;
use App\Order;
use App\Order_detail;
use App\Product;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Brian2694\Toastr\Facades\Toastr;

class OrderController extends Controller

{	
    public function list(Request $request,$id='default')

    {
	 	$query = Order::query();
	 	if ($request->has('keyword')) {
	 		$keyword = $request->keyword;
	 		$query->whereHas('user',function($query) use($keyword){
	 			$query->where('fullname','like',"%".$keyword . "%");
			});		
	 	}
	 	if ($request->has('enddate')) {
	 		$startdate =  ($request->startdate == '') ? '2018-01-01' : $request->startdate;
	 		$enddate =  ($request->enddate == '') ? date('Y-m-d',time()) : $request->enddate;
	 		$query->whereBetween('created_at',[$startdate, $enddate]);
	 	}
		if ($request->ajax()) {
			$orders = $query->paginate(10)->appends(['keyword'=>$request->keyword, 'startdate'=>$startdate, 'enddate'=>$enddate]);	
		 	$view = view('ajax.order', compact('orders'))->render();
			return response()->json(['view'=>$view], 200);
		}
		
		$orders = $query->paginate(10)->appends(request()->query());
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

	public function exportExcel(Request $request)
	{
		$query = Order::query();
		if ($request->has('keyword')) {
			$keyword = $request->keyword;
	 		$query->whereHas('user',function($query) use($keyword){
	 			$query->where('fullname','like',"%".$keyword . "%");
			});
		}
		$startdate =  empty($request->startdate) ? '2018-01-01' : $request->startdate;
 		$enddate =  empty($request->enddate) ? date('Y-m-d',time()) : $request->enddate;
 		$query->whereBetween('created_at', [$startdate, $enddate]);
		$orders = $query->get();
		$fileName = $startdate. '-' .$enddate.str_random(6);
		Excel::create($fileName,function($excel) use($orders, $startdate, $enddate){
			$excel->sheet('Hóa đơn ', function ($sheet) use ($orders, $startdate,$enddate ) {
				$sheet->setAllBorders('solid');
	            $sheet->mergeCells('A1:E1');
	            $sheet->cell('A1', function ($cell) {
                $cell->setValue('Cửa hàng thời trang Nữ của Team 1');
                $cell->setFontWeight('bold');
                $cell->setAlignment('center');
           		});
	            $sheet->mergeCells('A2:E2');
	            $sheet->cell('A2',function($cell){
	            $cell->setValue('222 Ngũ Hành Sơn,TP Đà Nẵng');
	            $cell->setAlignment('center');
	            });
	            $sheet->mergeCells('A3:E3');
	            $sheet->cell('A3',function($cell){
	            $cell->setValue('HÓA ĐƠN BÁN HÀNG');
	            $cell->setAlignment('center');
	            });
	            $sheet->mergeCells('A4:E4');
	            $sheet->cell('A4',function($cell) use ($startdate, $enddate){
	            $timestamp = strtotime($startdate);
	            $startdate = date('d-m-Y',$timestamp);
	            $timestamp = strtotime($enddate);
	            $enddate   = date('d-m-Y',$timestamp);
	            $cell->setValue('Từ ngày ' .$startdate. ' đến '.$enddate );
	            $cell->setAlignment('center');
	            });
	            $result  = $this->takeData($orders);
	            $countResult = count($result);
	            if($countResult>0){
	            	$distance = count($result) +6;
		            $sheet->fromArray($result,null, 'A6', true, true);
		          	$sheet->cell('A6:E'.$distance,function($cell){
		            $cell->setAlignment('center');
		            });
		            $sheet->setBorder('A6:E'.$distance, 'thin');
		            $sheet->cell('A6:E6',function($cell){
			            $cell->setFontWeight('bold');
			            $cell->setBackground('#FFC7CE');
		            });
		            $distanceTotal = $distance+1;
		            $sheet->mergeCells('A'.$distanceTotal.':D'.$distanceTotal);
		            $sheet->cell('A'.$distanceTotal, function($cell){
		   			$cell->setValue('Tổng tiền ');
		            $cell->setAlignment('center');
		            $cell->setFontWeight('bold');
		             $cell->setBackground('#FFC7CE');
		            });
		            $sheet->setBorder('A'.$distanceTotal.':D'.$distanceTotal, 'thin');
		            $sheet->setBorder('E'.$distanceTotal, 'thin');
		            $total = number_format($this->total($orders));
		            $sheet->cell('E'.$distanceTotal,function($cell) use($total){
		            $cell->setFontWeight('bold');
		            $cell->setFontColor('#ff4131');
		            $cell->setBackground('#FFC7CE');
		            $cell->setValue($total. ' VNĐ');
		            $cell->setAlignment('center');
		            });

	            } else {
	            	$sheet->mergeCells('A6:E6');
	            	$sheet->cell('A6',function($cell){
			            $cell->setFontWeight('bold');
			            $cell->setBackground('#FFC7CE');
			            $cell->setValue('Không có đơn hàng nảo cả');
		            	$cell->setAlignment('center');
		            });
	            }
	            
    		});
		})->store('xlsx', public_path('excel'));
		$path = 'excel/'.$fileName.'.xlsx';
		return redirect(url($path));	
	}

	private function takeData($orders)
	{
		$result = [];
    	foreach ($orders as $key => $order) {	
    		$timespamp = strtotime($order->created_at);
    		$timeOrder = date('d-m-Y H:i:s', $timespamp);	
	        $result[] = [
	            'Mã hóa đơn' => isset($order->id) ? $order->id  : '',
	            'Tên khách hàng' => isset($order->user->fullname) ? $order->user->fullname  : '',
	            'Địa chỉ' => isset($order->address) ? $order->address : '',
	 			'Ngày đặt hàng'=> $timeOrder,
	            'Tổng tiền' => isset($order->total) ? number_format($order->total). ' VNĐ'  : ''
	        ];
    	}	
    	return $result;
	}
	private function total($orders){
		$arrTemp = [];
		$result = '';
		if (count($orders)>0) {
			foreach ($orders as $key => $order) {
				$arrTemp[] = $order->total;
				$result = array_sum($arrTemp);
			}
			
		}
		return $result;
		
	}
	public function chart()

	{	

		$order = DB::table('order')->select(DB::raw('count(*) as countstatus','status'))->where('status','=',1)->groupBy('status')->first();
		dd($order);

	
	}
}
