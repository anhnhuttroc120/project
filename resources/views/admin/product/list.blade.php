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
                
              <select name="category" id="category">
              
                @foreach($categories as $key => $category)
                @if(!empty($category_id) && $category_id== $key)
                <option selected value="{{$key}}">{{$category}}</option>
                @else
                <option  value="{{$key}}">{{$category}}</option>
                @endif
                @endforeach
              </select>
              <select name="sort" id="sort">
              
                @foreach($sorts as $key => $sort)
                @if(!empty($sort) && $sort== $key)
                <option selected value="{{$key}}">{{$sort}}</option>
                @else
                <option  value="{{$key}}">{{$sort}}</option>
                @endif
                @endforeach
              </select>
              <input  style="width: 200px;"  type="text"  name="keyword" id="search" placeholder="Tìm kiếm theo tên sản phẩm">
                <div id="result">
                    {!! view('ajax.product',compact(['products']))->render() !!}
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

        
    });
</script>
<script>
    function callAjax(){
      var category = $('#category').val();
      var sort = $('#sort').val();
      var keyword = $('#search').val();
      var url = "{{route('product')}}";
      $.ajax({
        type :'get',
        url :url ,
        data:{keyword:keyword,sort:sort,category:category},
        success: function (data) { 
    
            
        }
      });

    }
</script>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/delete.js"></script>

@endsection



