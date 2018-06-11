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

	<div class="container-fluid" style="margin-top: -19px;  ">
		<div class="row">
				@include('default.pages.order.sidebar')
			{!! Toastr::message() !!}
			<div style="" class="col-md-8">
				<div style="margin-bottom: 20px;">
					<a style="border-bottom: 3px solid #FF0000;font-size: 20px;font-weight: bold; ">Thông tin tài khoản</a>
					</div>
					 @if($errors->any())
           <div style="margin-left: 10px;width: 700px;" class="alert alert-danger">
            <ul style="list-style-type: none">
                @foreach ($errors->all() as $error)
                    <li >{{ $error }}</li>
                @endforeach
            </ul>
           
           </div>
        @endif
					<form class="account" action="{{url('profile/'.Auth::user()->id)}} " method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}">

						<input type="hidden" name="username" value="{{Auth::user()->username}}">
						<div class="form-group">
						<label  for="">TÊN TÀI KHOẢN:</label>
						<span>{{Auth::user()->username}}</span>
						</div>
						<div class="form-group">
						<label for="">EMAIL:</label>
						<input type="email" name="email" value="{{Auth::user()->email}}">
						</div>
						<div class="form-group">
						<label for="">ĐỊA CHỈ :</label>
							<input type="text" value="{{Auth::user()->address}}" name="address">
						</div>
						<div class="form-group">
						<label for="">TÊN ĐẦY ĐỦ :</label>
							<input type="text" value="{{Auth::user()->fullname}}" name="fullname">
						</div>
						
						<div class="form-group">
						<label for="">HÌNH ẢNH:</label>
						<input type="file" name="picture">
							<div style="padding-left: 250px;">
								<img  style="width: 80px;height: 80px;" src="images/user/{{Auth::user()->picture}}" alt="">
							</div>
						</div>
						<div class="form-group">
						<label for="">SỐ ĐIỆN THOẠI:</label>
						<input type="text" value="{{Auth::user()->phone}}" name="phone">
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
