@extends('default.master')
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="css/dung.css">
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
	select{
		font-family: fontAwesome;
	}
</style>

@endsection
@section('content')

	<div class="container-fluid" style="margin-top: -19px; ">
		<div class="row">
				@include('default.pages.order.sidebar')
			
			<div style="" class="col-md-8">
				<div style="margin-bottom: 20px;">
					<a style="border-bottom: 3px solid #FF0000;font-size: 20px;font-weight: bold; ">ĐỔI MẬT KHẨU</a>
					</div>
					<form class="account" action="{{url('profile')}}" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="form-group">
						<label  for="">TÊN TÀI KHOẢN:</label>
						<span>{{Auth::user()->username}}</span>
						</div>
						<div class="form-group">
						<label for="">MẬT KHẨU CŨ:</label>
							<input type="password" name="password_old">
						</div>
						<div class="form-group">
						<label for="">MẬT KHẨU MỚI:</label>
							<input type="password" name="password_new">
						</div>
						<div class="form-group">
						<label for="">NHẬP LẠI MẬT KHẨU:</label>
							<input type="password" name="re-password">
						</div>
						
						<button style="margin-left: 150px;" type="submit" class="btn btn-primary">Cập Nhập</button>
						
					</form>
						
			</div>
		</div>
	</div>
@endsection
@section('script')
<script>
	
	 
</script>
@endsection
