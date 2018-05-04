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
        Danh sách người dùng
    <!--     <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li><a href="{{url('admin/product/list')}}">Sản phẩm</a></li>
        <li class="active"> Danh sách sản phẩm</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
       

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><a class="btn" href="{{url('admin/product/add')}}" style="color: white;background: #E3458B;">Thêm Sản Phẩm</a></h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div id="dialog-confirm" title="Thông báo!" style="display: none;">
      <p>Bạn có chắc muốn xóa phần tử này hay không?</p>
  </div>  

              {!!Form::open(['url' => 'admin/product/category', 'method' => 'post','files'=>true,'id'=>'admin-form'])!!}
                
              <select name="category_id" id="">
              
                @foreach($categories as $key => $category)
                @if(!empty($category_id) && $category_id== $key)
                <option selected value="{{$key}}">{{$category}}</option>
                @else
                <option  value="{{$key}}">{{$category}}</option>
                @endif
                @endforeach
              </select>
              <table id="example1" class="table table-bordered table-striped">
                <thead  >
                <tr >
                  <th style="width: 13%;">Mã sản phẩm </th>
                  <th style="width: 13%;">Tên sản phẩm</th>
                  <th style="width: 13%;">Hình ảnh</th>
                  <th style="width: 13%;">Loại sản phẩm</th>
                  <th style="width: 5%;" >Giá</th>
                  <th style="width: 10%;">Hành động</th>
                  
                </tr>
                </thead>
                <tbody>
                 
               @foreach($products as $product)
                  <?php
                  $price=explode('.', $product->price);
                        if(!empty($product->detail->picture)){

                             $pictures=json_decode($product->detail->picture,true); //CHUYEN VE 1  mảng
                             $randomKey=array_rand($pictures,1); // lay ngẫynhieen key trong mảng pictures

                        }
            
                       
                       ?> 
                   
                <tr id="item-{{$product->id}}">
                  <td>{{$product->id}}</td>
                  <td>{{$product['name']}}</td>
                  <td> @if(!empty($pictures)) <img src="images/product/{{$pictures[$randomKey]}}" style="width: 50px;height: 50px;" alt="23">@else{!! '<span class="btn btn-warning">Chưa có ảnh</span>'!!} @endif</td>
                  <td>{{$product->category->name}} </td>
                  <td style="float: right;">{{number_format($price[0])}}đ</td>
                  <td style="width: 50px;" ><a  style="color: red";  href="javascript:deleteItem({{$product->id}})"><i class="fa fa-trash"></i></a>
                  <span style="font-weight: bold;margin-right: 5px;">|</span><a  style="color: green";  href="{{url('admin/product/updated/'.$product->id)}}"><i class="fa fa-edit"></i></a>  </td>
          
                </tr>
                  
                @endforeach  
         
  
                </tbody>
                <tfoot>
               
               </tfoot> 


               
              </table>
              {!!Form::close() !!}
               <div style="float:right" >
                    {!! $products->appends(request()->query()) !!}
                    {{--  --}}

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



