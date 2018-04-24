@extends('layout.admin.master')

@section('css')


<link rel="stylesheet" href="AdminLTE-2.4.3/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
{{-- <link rel="stylesheet" href="team1/team1.css"> --}}

@endsection
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Danh sách người dùng
    <!--     <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li><a href="#">Người dùng</a></li>
        <li class="active"> Danh sách người dùng</li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead  >
                <tr>
                  <th style="width: 13%;">Số thứ tự</th>
                  <th style="width: 13%;">Tên sản phẩm</th>
                  <th style="width: 13%;">Hình ảnh</th>
                  <th style="width: 13%;">Loại sản phẩm</th>
                  <th style="width: 5%;" >Giá</th>
                  <th style="width: 10%;">Hành động</th>
                  
                </tr>
                </thead>
                <tbody>
                  <?php $i=1;
                  ?>
               @foreach($products as $product)
                  <?php
                    $picture=  $product->product_detail->picture;
                       $picture=json_decode($picture) ; 
                        
                        $price=explode('.',$product->price);
                   ?>
                <tr>
                  <td>{{$product->id}}</td>
                  <td>{{$product['name']}}</td>
                  <td><img src="images/product/{{$picture[0]}}" style="width: 50px;height: 50px;" alt=""></td>
                  <td>{{$product->category->name}} </td>
                  <td style="float: right;">{{number_format($price[0])}}đ</td>
                  <td style="width: 50px;" ><a  style="color: red";  href=""><i class="fa fa-trash"></i></a>
                  <span style="font-weight: bold;margin-right: 5px;">|</span><a  style="color: green";  href="{{url('admin/product/updated/'.$product->slug)}}"><i class="fa fa-edit"></i></a>  </td>
          
                </tr>
                  <?php $i++ ?>
                @endforeach  
         
  
                </tbody>
                <tfoot>
               
               </tfoot> 


               
              </table>
               <div style="float:right" >
                    {!! $products->links() !!}

                </div>
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
<!-- <script src="AdminLTE-2.4.3/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="AdminLTE-2.4.3/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
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
@endsection



