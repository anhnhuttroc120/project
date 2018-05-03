@extends('default.master')
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
@endsection
@section('content')
<?php ?>



	<div class="container"><div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Trang chủ</a> / <span>Giỏ hàng</span>
				</div>
			</div></div>
	<div class="container">
		@if(!empty(Cart::content()) && count(Cart::content())>0)	
			<form  action="{{url('check-out')}}" method="post" id="form-checkout"> 
		<div class="row" style="margin-bottom: 20px;"> {{-- start row --}}
			   {!! Toastr::message() !!}

			<div class="col-md-5">
						<div >
					<a style="border-bottom: 3px solid #FF0000;font-size: 20px;font-weight: bold;width: "><i class="fa fa-truck fa-2x" style="color: black"> </i>GIAO HÀNG TỚI</a>
						</div>
					<p style="margin-top:10px;">Bạn vui lòng nhập đầy đủ thông tin bên dưới</p>
					
						<div class="form-block">
							<label for="email">Họ tên <span style="color:red">*</span></label>
							<input type="text"  name="username">
						</div>
						<div class="form-block">
							<label for="email">Điện thoại <span style="color:red">*</span></label>
							<input type="text"  name="phone" autocomplete='email' >
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
							<input type="text"  name="address" autocomplete='address-line1'>
						</div>


						<div class="form-block">
							<label for="phone">Ghi chú</label>
							<textarea style="width: 60%" name="note" id="" value="">
								
							</textarea>
						</div>
						
			</div>

			<div class="col-md-7">
					<div style="margin-bottom: 20px;">
					<a style="border-bottom: 3px solid #FF0000;font-size: 20px;font-weight: bold; "><i class="fa fa-shopping-cart fa-2x" style="color: black"> </i>SẢN PHẨM ĐÃ CHỌN</a>
					</div>
				
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						
						<table class="table table-bordered">
							<thead>
							<tr >
								<th class="text-center">Sản phẩm</th>
								<th class="text-center">Size - Màu</th>
								<th class="text-center">Giá tiền</th>
								<th class="text-center">Số lượng</th>
								
								<th class="text-center">Thành tiền</th>
								<th class="text-center">Xóa</th>
								
							</tr>
							</thead>
							<tbody>
								@foreach(Cart::content() as $item)
								<?php 
								

								?>
							<tr class="shopping-cart {{$item->rowId}}" data="{{$item->rowId}}">
								<input type="hidden" id="{{$item->rowId}}">
								<td ><img src="images/product/{{$item->options->img}}" alt="{{$item->name}}" ></td>
								<td><p>{{$item->options->size}}-{{$item->options->color}}</p></td>
								<td><p>{{number_format($item->price)}} VNĐ</p></td>
							<div>
								<td>

								 <p><select name="quantity" data="{{$item->rowId}}">
								 	@foreach($quantitys as $key =>$quantity)
								 	@if($item->qty == $quantity)
								 	<option selected value="{{$quantity}}">{{$quantity}}</option>
								 	@else
								 	<option  value="{{$quantity}}">{{$quantity}}</option>
								 	@endif
								 	@endforeach
								
									</select></p>

								</td>
								<td ><span style="line-height: 50px;" class="{{$item->rowId}}" id="{{$item->rowId}}" >{{number_format($item->qty * $item->price)}} </span><span> VND</span></td>
							</div>
								<td><a href="{{url('delete-cart/'.$item->rowId)}}" style="padding-left: 10px;line-height: 50px;"><i  style="color: red;font-size: 15px;" class="fa fa-trash-o "></i></a></td>
							</tr>
							@endforeach
							</tbody>


						</table>
							<div class="row" style="border-bottom: 1px solid #DEDFDE">
								<div class="col-md-7"></div>
								<div class="col-md-5 sumarry" >
									<p><b>Tổng tiền hàng:</b> <span class="sub-total"  style="padding-left: 10px;">{{Cart::subtotal()}}<sup>đ</sup></span></p>
									<p><b>Phí vận chuyển:</b> <span style="padding-left: 10px;">0<sup>đ</sup></span></p>
									<p><b style="padding-left: 30px;">Tổng cộng:</b> <span class="sub-total" style="padding-left: 10px;color: red;font-weight: bold;">{{Cart::subtotal()}}</span><sup>đ</sup></p>
									
								</div>

							</div>
							<div  style="margin-top:10px;" class="row">
								<div class="col-md-12 bookcart">
									<a style="background: #A5A6A5" href="{{url('trang-chu')}}" class="btn">TIẾP TỤC MUA HÀNG</a>
									<button  style="background: #63AA38;float: right;font-size: 16px;color: #e7e7e7"  class="btn checkout">ĐẶT HÀNG</button>
								</div>
							</div>	
					</form>
					@else
					<h4>Không có sản phẩm nào trong giỏ hàng.Click vào <a style="color: blue" href="{{url('trang-chu')}}">đây</a> về trang chủ tiếp tục mua hàng. </h4>
					@endif

				
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
		
		 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$('select[name=quantity]').change(function(){
			var qty = $(this).val();
			var rowId = $(this).attr('data');
			 $.ajax({

                    /* the route pointing to the post function */
                    url: 'update-cart',
                    type: 'post',
                     /* send the csrf-token and the input to the controller */
                   	data: {_token: CSRF_TOKEN, qty:qty,rowId:rowId},
                    dataType: 'json',
                     /* remind that 'data' is the response of the AjaxController */
                     success: function (data,status) { 
                     	console.log(data.cart_one);
                     	
                     	var price = data.cart_one.price;
                     	var qty = data.cart_one.qty;
                     	var total = formatNumber(price * qty);
                     	var subtotal = data.total;
                     	var count = data.count;
                     	 $('span#'+rowId).text(total);
                     	 $('span.'+data.cart_one.rowId).text(total);
                     		$('span.sub-total').text(subtotal);
                     		$('span.count').text(count);
                     		$('span.sub-total').text(subtotal);
                   
                     }
           }); 


		});

	});
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