@extends('default.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{-- <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
   {{-- <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" /> --}}
    
<style>

	.borderinput{
		border: 1px solid red !important;
		border-radius: 2px;
	}
</style>
@endsection
@section('content')
	<div class="container">
		<div id="content">
			        {!! Toastr::message() !!}
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

							<input type="text" id="email" name="username" >
							
								<p id="error_username" style="padding-left: 200px;" class="text-danger">1</p>
							
						</div>
						<div class="form-block">
							<label for="email">Địa chỉ email <span style="color:red">*</span></label>
							<input type="email" id="email" name="email" >
							
								<p id="error_email" style="padding-left: 200px;" class="text-danger"></p>
						
						</div>

						<div class="form-block">
							<label for="your_last_name">Tên đầy đủ</label>
							<input type="text" id="your_last_name" name="fullname" >
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ<span style="color:red">*</span></label>
							<input type="text" id="adress" value="" name="address" >
						
								<p id="error_address" style="padding-left: 200px;" class="text-danger"></p>
						
						</div>


						<div class="form-block">
							<label for="phone">Điện thoại<span style="color:red">*</span></label>
							<input type="text" id="phone" name="phone" >
								
								<p id="error_phone" style="padding-left: 200px;" class="text-danger "></p>
							
						</div>
						<div class="form-block">
							<label for="phone">Mật khẩu<span style="color:red">*</span></label>
							<input type="password" id="phone" name="password" >
								<p id="error_password"  style="padding-left: 200px;" class="text-danger error_password"></p>
							
						</div>
						<div class="form-block">
							<label for="phone">Nhập lại mật khẩu<span style="color:red">*</span></label>
							<input type="password" id="phone" name="re-password" >
							
								<p id="error_repassword" style="padding-left: 200px;" class="text-danger">1</p>
							

						</div>
						<div class="form-block" style="padding-left: 200px;">
							<a style="background:#217994;color: #e7e7e7;font-weight: bold;cursor: pointer; " type="submit" id="login" class="btn">Đăng kí</a>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
@section('script')
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}

<script>
			function checkUserName(){
				// var errorUsername =false;
				var userName = 	$('input[name=username]').val();
				if(userName==''){
					$('#error_username').html('Vui lòng tên tài khoản không để trống');
					$('#error_username').show();
					$('input[name=username]').addClass('borderinput');
					 errorUsername = true;
				}else if(userName.length <6 || userName.length>16){
					$('#error_username').html('Độ dài tài khoàn từ 6 đến 12');
					$('#error_username').show();
					$('input[name=username]').addClass('borderinput');
					errorUsername = true;

				}else{
					$('#error_username').hide();
					$('input[name=username]').removeClass('borderinput');
					errorUsername =false;
				}
			
				
				
			}
			function checkEmail(){
				var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if($('input[name=email]').val() == '') {
					$('#error_email').html('Email không đc để trống');
					$('#error_email').show();
					$('input[name=email]').addClass('borderinput');
					errorEmail=true;

				}else if(pattern.test($('input[name=email]').val())){
					$('#error_email').hide();
					$('input[name=email]').removeClass('borderinput');
					errorEmail=false;
				}else{
					$('#error_email').html('Không phải định dạng email');
					$('#error_email').show();
					$('input[name=email]').addClass('borderinput');
					errorEmail=true;
				}
			}
			
			function checkRepassword(){
				errorre_password = false;
				var re_password = $('input[name=re-password]').val();
				var password = $('input[name=password]').val();
				if(re_password != password){
					$('#error_repassword').html('Mật khẩu nhập không khớp');
					$('#error_repassword').show();
					$('input[name=re-password]').addClass('borderinput');
					errorre_password = true;
				}else{
					$('#error_repassword').hide();
					$('input[name=re-password]').removeClass('borderinput');
					
					
				}
			}
			function checkPhone(){
				var pattern = /^(01[2689]|09)[0-9]{8}$/;
				var phone = $('input[name=phone]').val();
				 errorphone  = false;
				if(pattern.test(phone)){
					$('#error_phone').hide();
					$('input[name=phone]').removeClass('borderinput');
				}else{
					$('#error_phone').html('Không phải định dạng số điện thoại');
					$('#error_phone').show();
					$('input[name=phone]').addClass('borderinput');
					errorphone = true;
				}
			}
			function checkPassword(){
					var password = $('input[name=password]').val();
					  errorpassword = false;
					if(password.length < 6 || password.length >16){
						$('#error_password').html('Độ dài mật khầu từ 6 đến 16');
						$('#error_password').show();
						$('input[name=password]').addClass('borderinput');
						 errorpassword=true;
					}else if(password == ''){
						$('#error_password').html('Email không được để trống');
						$('#error_password').show();
						$('input[name=password]').addClass('borderinput');
						 errorpassword = true;
					}else{
						$('#error_password').hide();
						$('input[name=password]').removeClass('borderinput');
					}
				}
	
</script>
	<script>
		$(document).ready(function(){

			$('#error_username').hide();
			$('#error_email').hide();
			$('#error_phone').hide();
			$('#error_address').hide();
			$('#error_password').hide();
			$('#error_repassword').hide();
		});
		$('input[name=username]').on('keyup',function(){
			checkUserName();
		});
		$('input[name=username]').on('focusout',function(){
			checkUserName();
		});
		
		$('input[name=email]').on('keyup',function(){
			checkEmail();
		});
		$('input[name=email]').on('focusout',function(){
			checkEmail();
		});
		$('input[name=password]').on('keyup',function(){
			checkPassword();
		});
		$('input[name=password]').on('focusout',function(){
			checkPassword();
		});
		$('input[name=re-password]').on('keyup',function(){
			checkRepassword();
		});
		$('input[name=re-password]').on('focusout',function(){
			checkRepassword();
		});
		$('input[name=phone]').on('keyup',function(){
			checkPhone();
		});
		$('input[name=phone]').on('focusout',function(){
			checkPhone();
		});
		

		
	
		
	</script>
	<script>
		
		$('#login').click(function(){
			checkUserName();
			checkPhone();
			checkEmail();
			checkRepassword();
			checkPassword();		
		if(errorpassword == false && errorre_password==false && errorphone==false && errorUsername==false && errorEmail==false){
			var url = '{{url('dang-ki')}}';
			var username = $('input[name=username]').val();
			var email = $('input[name=email]').val();
			var password = $('input[name=password]').val();
			var phone = $('input[name=phone]').val();
			var address = $('input[name=address]').val();
			var fullname = $('input[name=fullname]').val();
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			 $.ajax({

                    /* the route pointing to the post function */
                    url: url,
                    type: 'post',
                      // send the csrf-token and the input to the controller 
                   	data: {username:username,email:email,_token:CSRF_TOKEN,fullname:fullname,address:address,password:password,phone:phone},
                     /* remind that 'data' is the response of the AjaxController */
                     success: function (data) { 
                     	console.log(data);
                   			if(data.error == false){
                   				
                   				$(location).attr('href', url);
                   			}else{
                   				if(data.messages.username != undefined) {
                   						$('#error_username').show().html('Tên tài khoản đã tồn tại');
										$('input[name=username]').addClass('borderinput');
                   				}else if(data.messages.email != undefined){
                   					$('#error_email').show().html('Email đã tồn tại');
										$('input[name=email]').addClass('borderinput');
                   				}
                   			}
                     }
			
			
           }); 
			
		}

		});
		
	</script>
		
@endsection