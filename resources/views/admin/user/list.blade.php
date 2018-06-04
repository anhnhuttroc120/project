@extends('layout.admin.master')

@section('css')
<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
  <script src='js/sweet-alert.min.js'></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

{{-- 
<link rel="stylesheet" href="AdminLTE-2.4.3/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> --}}

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
        {!! Toastr::message() !!}
      
        <div class="col-xs-12">
          <form action="{{url('admin/user/search')}}" method="get" id="form-search">
            <div class="form-group">
              <select style="height: 30px;" name="role" id="role">
                @foreach($arrRole as $key =>$value)
                @if(Request::get('role') == $key )
                <option selected value="{{$key}}">{{$value}}</option>
                @else
                   <option value="{{$key}}">{{$value}}</option>
                @endif
                @endforeach
              </select>
              <input  style="padding: 5px;" type="text" name="keyword" placeholder="Tìm kiếm theo tên" id="search" value="@if(Request::get('keyword')) {{Request::get('keyword')}}@endif" >
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
{{-- <script src="AdminLTE-2.4.3/bower_components/datatables.net/js/jquery.dataTables.min.js"></script> --}}
{{-- <script src="AdminLTE-2.4.3/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> --}}
<!-- SlimScroll -->
{{-- <script src="AdminLTE-2.4.3/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> --}}
<!-- FastClick -->
<script src="AdminLTE-2.4.3/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE-2.4.3/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="AdminLTE-2.4.3/dist/js/demo.js"></script> --}}
<!-- page script -->
{{-- <script>
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
</script> --}}
<script src="js/jquery.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script >
function deleteItem(id) {

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  $("#dialog-confirm").dialog({

    resizable : false,
    height : 200,
    modal : true,
    buttons : {
      "Có" : function() {

        $.get('admin/user/delete/'+id, function(data) {
          if(data.status == 'success' ){
             $('#item-' + id).remove();
              swal("success!", "Bạn đã xóa thành công !", "success"); 
              
          }else{
            var url = "{{route('index')}}";
            $(location).attr('href', url);
          }
          
        });
        $(this).dialog("close");
  
      },
      Không : function() {
        $(this).dialog("close");
      }
    }
  });
  
}
</script>
<script>
  $(document).ready(function(){
  
   
    $('#role').change(function(){
     callAjax();
    });
     $('#search').on('keyup', function(){
     callAjax();
  
          
    });
   
   });
</script>
<script>
  function callAjax(){
     var value = $('#search').val();
      var role = $('#role').val();
      var url = "{{route('index')}}";

      $.ajax({
        type :'get',
        url :url ,
        data:{keyword:value,role:role},
        success: function (data) { 
          console.log(data);
            $('#result').html(data.view);
        }
      })
  }
</script>
  
  
@endsection



