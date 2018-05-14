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
								<td><a class="delete-cart"  style="cursor: pointer;"  data="{{$item->rowId}}" style="padding-left: 10px;line-height: 50px;"><i  style="color: red;font-size: 15px;" class="fa fa-trash-o "></i></a></td>
							</tr>
							@endforeach
							</tbody>


						</table>
						<?php
							$subtotal = explode('.', Cart::subtotal());


						 ?>
							<div class="row" style="border-bottom: 1px solid #DEDFDE">
								<div class="col-md-7"></div>
								<div class="col-md-5 sumarry" >
									<p><b>Tổng tiền hàng:</b> <span class="sub-total"  style="padding-left: 10px;">{{$subtotal[0]}}<sup>đ</sup></span></p>
									<p><b>Phí vận chuyển:</b> <span style="padding-left: 10px;">0<sup>đ</sup></span></p>
									<p><b style="padding-left: 30px;">Tổng cộng:</b> <span class="sub-total" style="padding-left: 10px;color: red;font-weight: bold;">{{$subtotal[0]}}</span><sup>đ</sup></p>
									
								</div>

							</div>


<script>
	$(document).ready(function(){
		
		 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$('select[name=quantity]').change(function(){
			var qty = $(this).val();
			var rowId = $(this).attr('data');
			var url = "{{route('update-cart')}}";
			
			 $.ajax({

                    /* the route pointing to the post function */
                    url: url,
                    type: 'post',
                     /* send the csrf-token and the input to the controller */
                   	data: {_token: CSRF_TOKEN, qty:qty,rowId:rowId},
                     /* remind that 'data' is the response of the AjaxController */
                     success: function (data) { 
                     	$('#list-header').html(data.header);
                     	$('.result').html(data.view);
                     	$('.count').html(data.count);
                   	
                     }
           }); 


		});

	});
</script>
<script>
	$(document).ready(function(){
		$('.delete-cart').click(function(){
			var rowId = $(this).attr('data');
			var url = "{{route('delete-cart')}}"
			 $.ajax({

                    /* the route pointing to the post function */
                    url: url,
                    type: 'get',
                     /* send the csrf-token and the input to the controller */
                   	data: {rowId:rowId},
        
                     /* remind that 'data' is the response of the AjaxController */
                     success: function (data) { 
                  		$('#list-header').html(data.header);
                     	$('.result').html(data.view);
                     	$('.count').html(data.count);
                   
                     
					}
           }); 
			
		});
	});
</script>