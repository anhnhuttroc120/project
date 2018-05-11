@extends('default.master')
@section('content')

	<div class="container">
		<div id="content">
			
			<form action="{{url('dang-nhap')}}" method="post" class="beta-form-checkout">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4 style="font-weight: bold;">Đăng nhập</h4>
						<div class="space20">&nbsp;</div>
							@if(Session::has('notice'))
							<div class="alert alert-danger">
								{{Session::get('notice')}}
							</div>
							@endif
						<div class="form-block">
							<label for="email">Tài khoản</label>
							<input type="text" id="email"  name="username">
						</div>
						<div class="form-block">
							<label for="phone">Mật khẩu</label>
							<input style="height: 40px;padding: 5px;border: 1px solid #e7e3e7" type="password" id="phone" name="password" required>
						</div>
						<div class="form-block">
							<label style="margin-left: -11px;" for="email"><a  style="color: #39698c;margin-right:25px;" href="{{url('forgetPass')}}" class="btn">Bạn không thể truy cập vào tài khoản?</a></label>


							</div>
								
						<div class="form-block" style="padding-left: 200px;">
							<button style="background: #ce3029;color:#e7e7e7" type="submit" class="btn">Đăng nhập</button>

						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->


@endsection