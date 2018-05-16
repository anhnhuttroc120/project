<?php 

  $countDone = 0;
  $countCancel = 0;
  $countWaiting = 0;
  foreach ($orders as $key => $order) {
      if($order->status ==1 ){
        $countDone++;

      }elseif($order->status ==2) {
        $countWaiting++;
      }else{
       $countCancel++;
      }
  }

?>
 <table id="example1" class="table table-bordered table-striped">

                <thead style="background: #398ebd">
                <tr >
                  <th style="width: 13%;">Mã số đơn hàng</th>
                  <th style="width: 13%;">Tên người order</th>
                  <th style="width: 18%;">Địa chỉ</th>
                  <th style="width: 13%;">Ngày Giao hàng</th>
                  <th style="width: 10%;" >Tổng tiền</th>
                  <th style="width: 10%;">Trạng thái</th>
                  <th style="width: 10%;">Hành động</th>
                </tr>
                </thead>
                <tbody>
               	 @forelse($orders as $order) 
               	 <?php 
               	 	$result = '';
               	 	if($order->status == 3){
               	 		$result = '<small style="width:200px;line-height:25px;" class="label label-danger">Hủy</small>';
               	 	} elseif ($order->status == 1){
               	 		   $result = '<small style="line-height:25px;"  class="label label-success">Đã xử lý</small>';
               	 	} elseif($order->status== 2) {
               	 			$result = '<small style=" width:150px !important;line-height:25px;" class="label label-default">  Đang xử lý</small>';
               	 	  }
               	 ?>    
                <tr>
                  <td>{{$order->id}}</td>
                  <td> @if(!empty($order->user->fullname)){{$order->user->fullname}}@else {{$order->fullname}} @endif</td>
                  <td>{{$order->address}}</td>
                  <td>{{$order->date_shipper}}</td>
                  <td>{{number_format($order->total)}} VNĐ</td>
                  <td >{!! $result !!}</td>
                  <td > <a href="{{url('admin/order/detail/'.$order->id)}}">Chi tiết</a> </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7">Không có đơn hàng nào đc tìm thấy</td>
                </tr>
                @endforelse
                </tbody>
                <tfoot>
               </tfoot>  
              </table>
              <div style="float:right" class="pagination">
                {!! $orders->links() !!}
              </div>
              <div class="shiping-report">
                  <p>Tổng đơn hàng đã xử lý: {{$countDone}}</p>
                  <p>Tổng đơn hàng đang xử lý : {{$countWaiting}}</p>
                  <p>Tổng đơn hàng hủy : {{$countCancel}}</p>
                   <p ><b>Tổng tiền đơn hàng đã xử lý</b> : <span style="color: red;" class="subtotal">{{number_format($total)}}  </span> <span style="color: red;">VNĐ</span></p>
                </div>
         