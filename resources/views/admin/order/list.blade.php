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
        Danh sách Order
    <!--     <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li><a href="{{url('admin/product/list')}}">Order</a></li>
        <li class="active"> Danh sách Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
       

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div id="dialog-confirm" title="Thông báo!" style="display: none;">
      		<p>Bạn có chắc muốn xóa phần tử này hay không?</p>
 		 </div>  
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr >
                  <th style="width: 13%;">ID</th>
                  <th style="width: 13%;">Tên người order</th>
                  <th style="width: 13%;">Địa chỉ</th>
                  <th style="width: 13%;">Ngày Đặt Hàng</th>
                  <th style="width: 5%;" >Tổng tiền</th>
                  <th style="width: 10%;">Trạng thái</th>
                  <th style="width: 10%;">Hành động</th>
                  
                </tr>
                </thead>
                <tbody>
               	 @foreach($orders as $order) 
               	 <?php 
               	 	$result = '';
               	 	if($order->status == 0){
               	 		$result='<small style="width:200px;" class="label label-default">Đang xử lý</small>';
               	 	}elseif($order->status==1){
               	 		$result='<small class="label label-success">Đã xử lý</small>';
               	 		}else{
               	 			$result='<small style=" width:150px !important;" class="label label-danger">Hủy</small>';
               	 		}

               	 ?>    
                <tr>
                  <td>{{$order->id}}</td>
                  <td>{{$order->user->fullname}}</td>
                  <td>{{$order->address}}</td>
                  <td>{{$order->date_shipper}}</td>
                  <td>dung@gmail.com</td>
                  <td>{!! $result !!}</td>
                  <td > <a href="">Chi tiết</a> </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
               
               </tfoot> 


               
              </table>
              <hr>
              <div>
              	<table id="example1" class="table table-bordered table-striped">
              		
                <tr>
	                <th colspan="6"><span class="pull-right">Tổng đơn hàng đã xử lý</span></th>
	                <th>5</th>
           		 </tr>
	            <tr>
	                <th colspan="6"><span class="pull-right">Tổng đơn hàng chưa xử lý</span></th>
	                <th>2</th>
	            </tr>
	            <tr>
	                <th colspan="6"><span class="pull-right">Tổng đơn hàng đã hủy</span></th>
	                <th>2</th>
	            </tr>
              	</table>
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



