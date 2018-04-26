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
        <li><a href="#">Người dùng</a></li>
        <li class="active"> Danh sách người dùng</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <div id="dialog-confirm" title="Thông báo!" style="display: none;">
      <p>Bạn có chắc muốn xóa phần tử này hay không?</p>
  </div>  
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
                  <th style="width: 13%;">STT</th>
                  <th style="width: 13%;" >Picture</th>
                  <th style="width: 13%;">FullName</th>
                  <th style="width: 13%;">UserName</th>
                  <th style="width: 13%;">Email</th>
                  <th style="width: 13%;">Is_admin</th>
                  <th style="width: 10%;">Hành động</th>
                  
                </tr>
                </thead>
                <tbody>
              	@foreach($users as $user)
                <tr id="item-{{$user->id}}">
                  <td>{{$user->id}}</td>
                  <td><img src="images/user/{{$user->picture}}"></td>
                  <td>{{$user->fullname}}</td>
                  <td> {{$user->username}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                    @if($user->is_admin==1)
                      {{"Admin"}}
                    @else
                      {{"Thuong"}}
                    @endif
                  </td>
                  <td style="width: 50px;" ><a  style="color: red";  href="javascript:deleteItem({{$user->id}})"><i class="fa fa-trash"></i></a>
                  <span style="font-weight: bold;margin-right: 5px;">|</span><a  style="color: green";  href="admin/user/edit/{{$user->id}}"><i class="fa fa-edit"></i></a>  </td>
          
                </tr>
          
                 @endforeach  
                </tbody>
                
              </table>
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
@endsection



