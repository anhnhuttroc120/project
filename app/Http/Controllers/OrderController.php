<?php

namespace App\Http\Controllers;
use App\Order;
use App\Order_detail;
use App\Product;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Brian2694\Toastr\Facades\Toastr;
use PDF;

class OrderController extends Controller

{	
    public function list(Request $request,$id='default')
    {
	 	$query = Order::query();
	 	$queryCount = Order::query();
	 	$query->orderBy('id', 'desc');
	 	if ($request->has('keyword')) {
	 		$keyword = $request->keyword;
	 		$query->whereHas('user',function($query) use($keyword){
	 			$query->where('fullname','like',"%".$keyword . "%")->orWhere('id', $keyword);
			});	
			$queryCount->whereHas('user',function($query) use($keyword){
	 			$query->where('fullname','like',"%".$keyword . "%")->orWhere('id', $keyword);
			});	
	 	}
	 	if ($request->has('enddate')) {
	 		$startdate =  ($request->startdate == '') ? '2018-01-01' : $request->startdate;
	 		$enddate =  ($request->enddate == '') ? date('Y-m-d H:i:s',time()) : $request->enddate. ' 23:59:59';
	 		$query->whereBetween('created_at', [$startdate, $enddate]);
	 		$queryCount->whereBetween('created_at', [$startdate, $enddate]);
	 	}
	 	if ($request->has('status')) {
	 		$status = $request->status;
	 		if ($status != 'default') {
	 			$query->where('status', $status);
	 			$queryCount->where('status', $status);
	 		}
	 	}
	 	$countAll = $queryCount->select('status',DB::raw('count(*) as number'))->groupBy('status')->get();
        $total = $query->sum('total');	  
		if ($request->ajax()) {
			$orders = $query->paginate(10)->appends(['keyword'=>$request->keyword, 'startdate'=>$startdate, 'enddate'=>$enddate, 'status'=>$request->status]);	
		 	$view = view('ajax.order', compact('orders','total','countAll'))->render();
			return response()->json(['view'=>$view, 'total'=>$total], 200);
		} 	
		$orders = $query->paginate(10)->appends(request()->query());
		return view('admin.order.list', compact('orders', 'keyword','startdate','enddate', 'total', 'countAll', 'status'));			
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
	    $statusOld = $this->takeStatus($status);
	    if ($request->has('status')){
	    	$statusNew = $this->takeStatus($request->status);
	    }
	    $order->update(['status'=>$request->status]);
	    return back()->with('success', 'Bạn đã thay đổi trạng thái đơn hàng có mã số ' .$order->id.'  từ trạng thái '. $statusOld . ' sang trạng thái  '. $statusNew );    		
    }

	public function Status($id)
	{
		if (!empty($id)) {
			$orders = Order::where('status', $id)->paginate(4)->appends(request()->query());
			return view('admin.order.list', compact('orders'));
		}
	}

	public function exportExcel(Request $request)
	{
		$query = Order::query();
		if ($request->has('status') && $request->status==1) {
			$query->where('status', $request->status);
		} else {
			Toastr::warning('Vui lòng chọn những đơn hàng ở trạng thái đã xử lý', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
            return back();
		}	
		if ($request->has('keyword')) {
			$keyword = $request->keyword;
	 		$query->whereHas('user',function($query) use($keyword){
	 			$query->where('fullname','like',"%".$keyword . "%")->orWhere('id',$keyword);
			});
		}
		$startdate = empty($request->startdate) ? '2018-01-01' : $request->startdate;
 		$enddate =  empty($request->enddate) ? date('Y-m-d H:i:s', time()) : $request->enddate. ' 23:59:59';
 		$orders = $query->whereBetween('created_at', [$startdate, $enddate])->get();
		$timestamp = strtotime($startdate);
		$fileStartDate = date('Y-m-d', $timestamp);
		$timestamp = strtotime($enddate);
		$fileEndDate = date('Y-m-d', $timestamp);
		$fileName = $fileStartDate. '-' .$fileEndDate.str_random(6);
		if (count($orders) > 0 ) {
			Excel::create($fileName,function($excel) use($orders, $startdate, $enddate){
			$excel->sheet('Hóa đơn ', function ($sheet) use ($orders, $startdate, $enddate ) {
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
	            $startdate = date('d-m-Y', $timestamp);
	            $timestampend = strtotime($enddate);
	            $enddate   = date('d-m-Y', $timestampend);
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
		            $sheet->cell('A6:E6', function($cell){
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
		            $sheet->cell('E'.$distanceTotal, function($cell) use($total){
		            $cell->setFontWeight('bold');
		            $cell->setFontColor('#ff4131');
		            $cell->setBackground('#FFC7CE');
		            $cell->setValue($total. ' VNĐ');
		            $cell->setAlignment('center');
		            });
	            }         
    		});
			})->store('xlsx', public_path('excel'));
			$path = 'excel/'.$fileName.'.xlsx';
			return redirect(url($path));	
		} else {
			Toastr::warning('Không có đơn hàng nào để in hóa đơn !', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
            return back();
		}
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

	private function total($orders, $type='null'){
		$arrTemp = [];
		$result = 0;

		if (count($orders)>0) {
			foreach ($orders as $key => $order) {
				if ($type == 'null') {
				$arrTemp[] = $order->total;
				$result = array_sum($arrTemp);
				} else {
					if($order->status==1){
						$arrTemp[] = $order->total;
						$result = array_sum($arrTemp);
					}
				}
			}	
				
		}
		return $result;		
	}

	public function chart()
	{	
		$lengMonth = date('m');
		$now = date('d-m-Y H:i:s', time());
		for ($i=1; $i <=$lengMonth ; $i++) { 
			$done = Order::where('status', 1)->whereMonth('created_at', $i)->count();
			$cancel = Order::where('status' ,3)->whereMonth('created_at', $i)->count();
			$totalProduct = Order::where('status', 1)->whereMonth('created_at', $i)->sum('quantity');	
			$result[$i]['done'] = $done;
			$result[$i]['cancel'] = $cancel;
			$result[$i]['total'] = $totalProduct;
		}
		
		return view('admin.chart', compact('result', 'now'));
	}

	 public function getPDF($id) {
    	$order = Order::findOrFail($id);
    	if ($order->status == 1 ) {
    		$pdf = PDF::loadView('pdf.customer',compact('order'));
    		$fileName = $order->user->fullname;
    		return $pdf->stream($fileName.'.pdf');
    	}
    	Toastr::warning('Trạng thái đơn hàng không phù hợp để in hóa đơn !', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
    	return back();
    }

    private function takeStatus($status)
    {
    	if ($status == 2) $strStatus = ' Đang xử lý';
	    if ($status == 1) $strStatus = ' Đã xử lý';
	    if ($status == 3) $strStatus = ' Hủy ';
	    return $strStatus;
    }

    public function calendar()
    {	
    	$day = date('d');
    	$data['today'] = Order::whereDay('date_shipper', $day)->where('status', 2)->get();
    	$data['tomorrow'] = Order::whereDay('date_shipper', $day+1)->where('status', 2)->get();
    	return view('admin.calendar', compact('data'));
    }
}
