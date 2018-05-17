@extends('layout.admin.master')

@section('css')
<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">


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
        <li><a href="">Người dùng</a></li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <div id="dialog-confirm" title="Thông báo!" style="display: none;">
      <p>Bạn có chắc muốn xóa phần tử này hay không?</p>
  </div>  
      <div class="row">
        <div class="col-xs-12">
          <form action="{{url('admin/user/search')}}" method="get" id="form-search">
            <div class="form-group">
              <input  style="padding: 5px;" type="text" name="keyword" placeholder="Tìm kiếm theo tên" id="search" value="@if(!empty($keyword)){{$keyword}}@endif" >
            </div>
          </form>
       

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><a class="btn" href="{{url('admin/user/add')}}" style="color: #e7e7e7;background: #E3458B;">Thêm người dùng</a></h3>

            </div>

            <!-- /.box-header -->
            <div class="box-body">

             <div id="result">
            @if($users)
                {!! view('ajax.user',compact(['users']))->render()  !!}
            @endif


              </div> {{-- ket thuc result --}}
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
<script src="js/jquery.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/userdelete.js"></script>
<script>
  $(document).ready(function(){
   
    $('#search').on('keyup', function(){
      var value = $(this).val();
      var url = "{{route('index')}}";
      $.ajax({
        type :'get',
        url :url ,
        data:{keyword:value},
        success: function (data) { 
          
            $('#result').html(data.view);
        }
      })
    });
   
   });
</script>
@endsection



