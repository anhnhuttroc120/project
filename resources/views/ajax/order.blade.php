<?php 
if(count($countAll)>0){
    foreach ($countAll as $key => $order) {
      switch ($order->status) {
          case '1':
              $count['done'] = $order->number;
              break;
          case '2':
              $count['waiting'] = $order->number;
              break;
          case '3':
              $count['cancel'] = $order->number;
              break; 
         
      }
     } 
}    
      $count['done'] = !empty($count['done']) ? $count['done'] : 0;
      $count['waiting'] = !empty($count['waiting']) ? $count['waiting'] : 0;
      $count['cancel'] = !empty($count['cancel']) ? $count['cancel'] : 0;
  


  


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
                
                <tr>
                  <td>{{$order->id}}</td>
                  <td> @if(!empty($order->user->fullname)){{$order->user->fullname}}@else {{$order->fullname}} @endif</td>
                  <td>{{$order->address}}</td>
                  <td>{{$order->date_shipper}}</td>
                  <td>{{number_format($order->total)}} VNĐ</td>
                  <td >{!! $statusHTML[$order->status] !!} </td>
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
                  <p>Tổng đơn hàng đã xử lý: {{ $count['done']}}  </p>
                  <p>Tổng đơn hàng đang xử lý : {{$count['waiting']}} </p>
                  <p>Tổng đơn hàng hủy :{{$count['cancel']}} </p>
                   <p ><b>Tổng tiền đơn hàng </b> : <span style="color: red;" class="subtotal">{{number_format($total)}}  </span> <span style="color: red;">VNĐ</span></p>
                </div>
         
              