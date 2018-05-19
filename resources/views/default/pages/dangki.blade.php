@extends('default.master')
@section('content')
	<div class="container">
		<div id="content">
			
			<form action="{{url('dang-ki')}}" method="post" class="beta-form-checkout">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="row">
					 @if (Session::has('success'))
			        <div class="alert alert-success">
			          {!! Session::get('success') !!}
			        </div>
					@endif
					<div class="col-sm-6">
						<h4 style="font-weight: bold;">Đăng kí</h4>
						<div class="space20">&nbsp;</div>

							<div class="form-block">
							<label for="email">Tài khoản <span style="color:red">*</span></label>

							<input type="text" id="email" name="username">
							@if($errors->has('username'))
								<p style="padding-left: 200px;" class="text-danger">{{$errors->first('username')}}</p>
							@endif
						</div>
						<div class="form-block">
							<label for="email">Địa chỉ email <span style="color:red">*</span></label>
							<input type="email" id="email" name="email" >
							@if($errors->has('email'))
								<p style="padding-left: 200px;" class="text-danger">{{$errors->first('email')}}</p>
							@endif
						</div>

						<div class="form-block">
							<label for="your_last_name">Tên đầy đủ</label>
							<input type="text" id="your_last_name" name="fullname" >
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ<span style="color:red">*</span></label>
							<input type="text" id="adress" value="" name="address" >
							@if($errors->has('address'))
								<p style="padding-left: 200px;" class="text-danger">{{$errors->first('address')}}</p>
							@endif
						</div>


						<div class="form-block">
							<label for="phone">Điện thoại<span style="color:red">*</span></label>
							<input type="text" id="phone" name="phone" >
								@if($errors->has('phone'))
								<p style="padding-left: 200px;" class="text-danger">{{$errors->first('phone')}}</p>
							@endif
						</div>
						<div class="form-block">
							<label for="phone">Mật khẩu<span style="color:red">*</span></label>
							<input type="password" id="phone" name="password" >
								@if($errors->has('password'))
								<p style="padding-left: 200px;" class="text-danger">{{$errors->first('password')}}</p>
							@endif
						</div>
						<div class="form-block">
							<label for="phone">Nhập lại mật khẩu<span style="color:red">*</span></label>
							<input type="password" id="phone" name="re-password" >
							@if($errors->has('re-password'))
								<p style="padding-left: 200px;" class="text-danger">{{$errors->first('re-password')}}</p>
							@endif

						</div>
						<div class="form-block" style="padding-left: 200px;">
							<button style="background:#217994;color: #e7e7e7;font-weight: bold; " type="submit" class="btn">Đăng kí</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection