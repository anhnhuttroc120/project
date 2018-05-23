@extends('default.master')
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<style>
	.quantity_box span{
		cursor: pointer;
	}
</style>
@endsection
@section('content')




	<div class="container"><div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Trang chủ</a> / <span>Giỏ hàng</span>
				</div>
			</div></div>
	<div class="container">
		{{-- @if(!empty(Cart::content()) && count(Cart::content())>0)	 --}}
			<form  action="{{url('check-out')}}" method="post" id="form-checkout"> 
				<input type="hidden" name="_token" value="{{csrf_token()}}">

		<div class="row" style="margin-bottom: 20px;"> {{-- start row --}}
			   {!! Toastr::message() !!}
			    @if (Session::has('success'))
			        <div class="alert alert-success">
			          {!! Session::get('success') !!}
			        </div>
				@endif
			<div class="col-md-5">
						<div >
					<a style="border-bottom: 3px solid #FF0000;font-size: 20px;font-weight: bold;width: "><i class="fa fa-truck fa-2x" style="color: black"> </i>GIAO HÀNG TỚI</a>
						</div>
					<p style="margin-top:10px;">Bạn vui lòng nhập đầy đủ thông tin bên dưới</p>
					
						<div class="form-block">
							<label for="email">Họ tên <span style="color:red">*</span></label>
							<input type="text"  name="username" disabled="" value="{{$user->fullname}}">
						</div>
						<div class="form-block">
							<label for="email">Điện thoại <span style="color:red">*</span></label>
							<input type="text"  name="phone" autocomplete='email' value="{{$user->phone}}" >
						</div>

						<div class="form-block">
							<label for="your_last_name">Tỉnh/Thành phố <span style="color:red">*</span></label>
							<select style="height: 40px;" name="city"  autocomplete='address-level2'>
							@foreach($provinces as $id => $province)
								<option value="{{$id}}">{{$province}}</option>
							@endforeach	
							</select>
						</div>
						<div class="form-block">
							<label for="your_last_name">Quận/Huyện<span style="color:red">*</span> </label>
							<select style="height: 40px;" name="district" id="" autocomplete='address-level2'>
								<option value="0">Chọn</option>
							</select>
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ<span style="color:red">*</span></label>
							<input type="text"  name="address" autocomplete='address-line1' value="{{$user->address}}">
						</div>


						<div class="form-block">
							<label for="phone">Ghi chú</label>
							<textarea  style="padding-left:  1px !important;" rows="3" cols="35" name="note" >
								
							</textarea>
						</div>
						
			</div>

			<div class="col-md-7">
					<div style="margin-bottom: 20px;">
					<a style="border-bottom: 3px solid #FF0000;font-size: 20px;font-weight: bold; "><i class="fa fa-shopping-cart fa-2x" style="color: black"> </i>SẢN PHẨM ĐÃ CHỌN</a>
					</div>
				
						
						<div class="result">
						{!! view('ajax.giohang')->render() !!}
						</div> {{-- end result	 --}}
							<div  style="margin-top:10px;" class="row">
								<div class="col-md-12 bookcart">

									<a style="background: #A5A6A5" href="{{url('trang-chu')}}" class="btn">TIẾP TỤC MUA HÀNG</a>
									<button  style="background: #63AA38;float: right;font-size: 16px;color: #e7e7e7"  class="btn checkout">ĐẶT HÀNG</button>
								</div>
							</div>	
					</form>
				{{-- 	@else
					<h4>Không có sản phẩm nào trong giỏ hàng.Click vào <a style="color: blue" href="{{url('trang-chu')}}">đây</a> về trang chủ tiếp tục mua hàng. </h4>
					@endif --}}

				
			</div> <!-- COL MD-7 -->
			




		</div>	 {{-- row end --}}


	</div>
@endsection
@section('script')
<script>
	
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}
</script>

<script>
	$(document).ready(function(){
		$('a.checkout').click(function(){
			$('#form-checkout').submit();
		});

	});
</script>

<script>
	$(document).ready(function(){

		$('select[name=city]').change(function(){
			var idCity = $(this).val();
			
			 $.ajax({

                    /* the route pointing to the post function */
                    url: 'district',
                    type: 'get',
                     /* send the csrf-token and the input to the controller */
                   	data: {idCity:idCity},
                    dataType: 'text',
                     /* remind that 'data' is the response of the AjaxController */
                     success: function (data) { 
                     	$('select[name=district]').html(data);
                   
                     }
           }); 
			
		});
	});
</script>	

@endsection					