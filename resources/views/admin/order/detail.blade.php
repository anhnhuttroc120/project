@extends('layout.admin.master')

@section('css')


<link rel="stylesheet" href="AdminLTE-2.4.3/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
{{-- <link rel="stylesheet" href="team1/team1.css"> --}}
<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">

@endsection
@section('content')
 <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Danh sách chi tiết
    <!--     <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li><a href="{{url('admin/product/list')}}">Order</a></li>
        <li class="active"> Danh sách Order Chi Tiết</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
       

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách Chi Tiết</h3>
            </div>
            @if (Session::has('success'))
        <div class="alert alert-success">
          {{ Session::get('success') }}
        </div>
      @endif>

            <!-- /.box-header -->
            <div class="box-body">
                <div id="dialog-confirm" title="Thông báo!" style="display: none;">
      		<p>Bạn có chắc muốn xóa phần tử này hay không?</p>
 		 </div>  
      <div class="khach-hang">
        <h5 style="font-weight: bold;">Thông tin khách hàng:</h5>
        <div>
           <label style="font-weight:400; width: 250px;">Thông tin người đặt hàng:</label> <span>{{$order->user->fullname}}</span>
        </div>
       <div>
          <label style="font-weight:400; width: 250px;">Ngày đặt hàng:</label> <span>{{$order->date_shipper}}</span>
       </div>
       <div>
         <label style="font-weight:400;width: 250px;">Số điện thoại:</label> <span>{{$order->user->phone}}</span>
       </div>
        <div>
          <label style="font-weight:400;width: 250px;">Địa chỉ:</label> <span>{{$order->user->address}}</span>
        </div>
        <div>
          <label style="font-weight:400;width: 250px;">Email:</label> <span>{{$order->user->email}}</span>
        </div>
        <div>
          <label style="font-weight:400;width: 250px;">Ghi chú:</label> <span>{{$order->note}}</span>
        </div>
      </div>
      <div>
          <table id="" class="table table-bordered table-striped">
                <thead  >
                <tr >
                  <th style="width: 23%;">STT</th>
                  <th style="width: 23%;">Tên sản phẩm</th>
                  <th style="width: 23%;">Số lượng</th>
                  <th style="width: 23%;">Giá tiền</th>
                 
                    
                </tr>
                </thead>
                <tbody>

                  @foreach($order->orders_detail as $order_detail)
                  <?php 
                      $arrTemp[] = $order_detail->total;
                  ?>
                  <tr>
                  <td>{{$order_detail->id}}</td>
                  <td>{{$order_detail->product->name}}</td>
                  <td>{{$order_detail->quantity}}</td>
                  <td>{{$order_detail->total}}</td>
                 
                  </tr>
                  @endforeach
                 <?php 
                  if(!empty($arrTemp)){
                     $subtotal = array_sum($arrTemp);

                  }else{
                    $subtotal = '0';
                    }

                if($order->status == 1){
                   $arrStatus = ['Đã xử lý'];
                }

                 ?>
                  
                </tbody>
                <tfoot>
                  <td  colspan="3" class="text-right" ;" >Tổng tiền:</td>
                  <td colspan="1" ><span style="color: red;padding-left: 15px;">{{number_format($order->total)}}<sup>đ</sup></span></td>
                </tfoot>
        </table>
        <div>
          <form action="{{url('admin/order/change-status/'.$order->id)}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="status" style="float:right">
          <label>Trạng thái giao hàng:</label>
          <select  name="status" class="" style="width: 150px;height: 30px;padding: 5px;">
            @foreach($arrStatus as $key => $status)

                @if($order->status == $key))
                     <option selected value="{{$key}}">{{$status}}</option>
                @else
                    <option  value="{{$key}}">{{$status}}</option>
                @endif
            @endforeach
          </select>
          @if($order->status != 1)
          <button style="height: 30px;padding: 5px;"  class="btn btn-primary">Thay đổi trạng thái</button>
            @endif
          </div>
          </form>
        </div>
      </div>
              {!!Form::close() !!}
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('script')
<script src="AdminLTE-2.4.3/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="AdminLTE-2.4.3/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="AdminLTE-2.4.3/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="AdminLTE-2.4.3/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="AdminLTE-2.4.3/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="AdminLTE-2.4.3/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE-2.4.3/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="AdminLTE-2.4.3/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {+
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
<script>
    $(document).ready(function(){
        $('select[name=category_id]').change(function(){
              var category_id = $(this).val();
              
              var url =  '{{url('admin/product/category/')}}' + '/' + category_id;
             
              $(location).attr('href', url);

        });
    });
</script>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/delete.js"></script>

@endsection



