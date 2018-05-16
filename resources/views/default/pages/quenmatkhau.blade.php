@extends('default.master')
@section('content')

<div class="container">
		<div id="content">
			
			<form action="{{ route('password.email') }}" method="post" class="beta-form-checkout">
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
							<label for="email">Email</label>
							<input type="text" id="email"  name="email">
						</div>
						
								
						<div class="form-block" style="padding-left: 200px;">
							<button style="background: #ce3029;color:#e7e7e7" type="submit" class="btn">Gửi</button>

						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->


@endsection