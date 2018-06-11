@extends('layout.admin.master')

@section('css')
<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">

<link rel="stylesheet" href="AdminLTE-2.4.3/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
{{-- <link rel="stylesheet" href="team1/team1.css"> --}}
<link rel="stylesheet" href="css/pagination.css">

@endsection
@section('content')
<?php
	$user = Auth::user();
	
             


 ?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Thông tin Người dùng
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li class="">Thông tin Người dùng</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
      @if (Session::has('success'))
      <div class="alert alert-success">
         {{ Session::get('success') }}
      </div>
      @endif
      <!-- left column -->
      <div class="col-md-12">
         <!-- general form elements -->
         <div class="box box-primary" style="padding-left: 50px;">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['url' => 'admin/changePass', 'method' => 'post','files'=>true,'id'=>'profile-form']) !!}
            <input type="hidden" name="username" value="{{$user->username}}">
            <div>
               <label for="">Tài khoản: </label> <span>{{$user->username}}</span>
            </div>
            <div>
               <label for="">Email    : </label> <span>{{$user->email}}</span>
            </div>
            <div>
               <label for="">Mật khẩu :</label> <span>
               ********
               </span>
            </div>
            <div>
               <label for="">Hình ảnh :</label>
               <div style="padding-left: 200px;">
                  @if($user->picture != '')
                  <img style="width: 80px;height: 80px;" src="images/user/{{$user->picture}}" alt="">
                  @else
                  Chưa có ảnh
                  @endif
               </div>
            </div>
            <div>
               <label for="">Địa chỉ   : </label> <span>{{$user->address}}</span>
            </div>
            <div>
               <label for="">Số Điện thoại: </label> <span>{{$user->phone}}</span>
            </div>
            <!-- /.box-body -->
            <div class="">
               <a style="cursor: pointer;display: block" class="change" >Đổi mật khẩu</a>
               <a style="cursor: pointer;display: none" class="test" >Đổi mật khẩu</a>
            </div>
            <div class="form-changepass" style="display: block;">
               <div class="form-pass">
                  <label for="">Mật khẩu cũ :</label> <input style="padding:5px;" type="password" name="password_old" disabled value="{{old('password_old')}}">
                  @if($errors->has('password_old'))
                  <p style="padding-left: 200px;" class="text-danger">{{$errors->first('password_old')}}</p>
                  @endif
               </div>
               <div class="form-pass" >
                  <label for="">Mật khẩu mới :</label> <input style="padding:5px;" type="password" name="password_new" disabled value="{{old('password_new')}}">
                  @if($errors->has('password_new'))
                  <p style="padding-left: 200px;" class="text-danger">{{$errors->first('password_new')}}</p>
                  @endif
               </div>
               <div class="form-pass">
                  <label for="">Nhập lại mật khẩu mới :</label> <input style="padding:5px;" type="password" name="re-password" disabled  value="{{old('re-password')}}">
                  @if($errors->has('re-password'))
                  <p style="padding-left: 200px;" class="text-danger">{{$errors->first('re-password')}}</p>
                  @endif
               </div>
               <button  style="margin-left: 200px;background: #18a263;margin-top:10px;" type="submit" class="btn"> Cập nhật</button>
            </div>
            {!! Form::close() !!}
         </div>
         <!-- /.box -->
         <!-- Form Element sizes -->
         <!--/.col (left) -->
         <!-- right column -->
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
	$(document).ready(function(){
		$('a.change').click(function(){
			$(this).hide();
			$('div.form-changepass').show();
			$('input').removeAttr('disabled');
			$('a.test').show();
			
			
		});
		$('a.test').click(function(){
			$('input').attr('disabled','');
			$(this).hide();
			$('a.change').show();
		});
			
		

		// });
	});
	
</script>
@endsection