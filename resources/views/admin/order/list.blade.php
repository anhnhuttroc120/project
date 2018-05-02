@extends('layout.admin.master')


@section('css')

<link rel="stylesheet" type="text/css" href="css/dung.css">
<link rel="stylesheet" href="AdminLTE-2.4.3/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
{{-- <link rel="stylesheet" href="team1/team1.css"> --}}
<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
        <!--search-->
        <div class="container">
            <div class="row">
              <form method="get" action="{{url('admin/order/search')}}">
                    <div class="col-sm-3">
                        <div id="imaginary_container"> 
                            <div class="input-group stylish-input-group">
                            
                                <input name="search" type="text" class="form-control"  placeholder="Tìm kiếm" >
                                <span style="border: 0" class="input-group-addon">
                                    <button type="submit">
                                       <i class="fa fa-search fa-1x"></i>
                                    </button>  
                                </span>
                            </div>
                        </div>
                    </div>
              </form>
              </div>
        </div>
         <!--endsearch-->
        <!--form-date-->
        <div class="col-sm-6"></div>
        <form method="get" action="{{url('admin/order/date')}}">
              <div class="col-sm-3 wrapper-date">
          
            <div style="float:right" >
              <label>Từ:</label>
              <input  class="date rounded"  id="date" name="startdate" placeholder="1970-01-01" value="@if(!empty($startdate)){{$startdate}}@endif" type="text"/></div>
           </div>
       

            <!--end-date-->
            <div class="col-sm-3 ">
          
            <div >
              <label>Đến:</label>
              <input class="date" id="date" name="enddate" placeholder="{{date('Y-m-d',time())}}" type="text" value="@if(!empty($enddate)){{$enddate}}@endif" /> <button type="submit"><i class="fa fa-search"></i></button></div>
           </div>
        </form>
      
      
   


            <!-- /.box-header -->
            <div class="box-body">
                <div id="dialog-confirm" title="Thông báo!" style="display: none;">
      		<p>Bạn có chắc muốn xóa phần tử này hay không?</p>
 		 </div>  
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr >
                  <th style="width: 13%;">Mã số đơn hàng</th>
                  <th style="width: 13%;">Tên người order</th>
                  <th style="width: 13%;">Địa chỉ</th>
                  <th style="width: 13%;">Ngày Giao hàng</th>
                  <th style="width: 5%;" >Tổng tiền</th>
                  <th style="width: 10%;">Trạng thái</th>
                  <th style="width: 10%;">Hành động</th>
                  
                </tr>
                </thead>
                <tbody>
               	 @foreach($orders as $order) 
               	 <?php 
               	 	$result = '';
               	 	if($order->status == 3){
               	 		$result = '<small style="width:200px;" class="label label-danger">Hủy</small>';
               	 	} elseif ($order->status == 1){
               	 		   $result = '<small class="label label-success">Đã xử lý</small>';
               	 	} elseif($order->status== 2) {
               	 			$result = '<small style=" width:150px !important;" class="label label-default">  Đang xử lý</small>';
               	 	  }

               	 ?>    
                <tr>
                  <td>{{$order->id}}</td>
                  <td> @if(!empty($order->user->fullname)){{$order->user->fullname}}@else {{$order->fullname}} @endif</td>
                  <td>{{$order->address}}</td>
                  <td>{{$order->date_shipper}}</td>
                  <td>{{$order->total}}</td>
                  <td>{!! $result !!}</td>
                  <td > <a href="{{url('admin/order/detail/'.$order->id)}}">Chi tiết</a> </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
               
               </tfoot> 


               
              </table>
              <div style="float:right" class="pagination">
                {!! $orders->links() !!}

              </div>
              <hr>
              <div>
              	<table id="example1" class="table table-bordered table-striped">
              		
                <tr>
	                <th colspan="6"><span class="pull-right">Tổng đơn hàng đã xử lý</span></th>
	                <th><a href="{{url('admin/order/status/1')}}">{{$data['done']}}</a></th>
           		 </tr>
	            <tr>
	                <th colspan="6"><span class="pull-right">Tổng đơn hàng đang xử lý</span></th>
	                <th><a href="{{url('admin/order/status/2')}}">{{$data['waiting']}}</a></th>
	            </tr>
	            <tr>
	                <th colspan="6"><span class="pull-right">Tổng đơn hàng đã hủy</span></th>
	                <th><a href="{{url('admin/order/status/3')}}">{{$data['cancel']}}</a></th>
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
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
  $(document).ready(function(){
    var date_input=$('input[name="startdate"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })
  })
</script>
<script>
  $(document).ready(function(){
    var date_input=$('input[name="enddate"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })
  })
</script>
@endsection



