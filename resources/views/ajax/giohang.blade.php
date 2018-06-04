<table class="table table-bordered animated fadeIn">
							<thead>
							<tr >
								<th class="text-center">Sản phẩm</th>
								<th class="text-center">Size - Màu</th>
								<th class="text-center">Giá tiền</th>
								<th style="width: 15%;" class="text-center">Số lượng</th>
								
								<th class="text-center">Thành tiền</th>
								<th class="text-center">Xóa</th>
								
							</tr>
							</thead>
							<tbody>
								@foreach(Cart::content() as $item)
								<?php 
								

								?>
							<tr class="shopping-cart {{$item->rowId}}" data="{{$item->rowId}}">
								<input type="hidden" rowId="{{$item->rowId}}">
								<td ><img src="images/product/{{$item->options->img}}" alt="{{$item->name}}" ></td>
								<td><p>{{$item->options->size}}-{{$item->options->color}}</p></td>
								<td><p>{{number_format($item->price)}} VNĐ</p></td>
							<div>
								<td  class="quantity_box">

									<span style="width: 30px;border: 1px solid #ccc;padding-left: 5px;padding-right: 5px;"> - </span>
								 	<input  readonly="readonly" style="width: 40px;height: 23px;margin-top:15px;padding-left: 9px;padding-right:0px;" type="text" name="quantity" value="{{$item->qty}}" data="{{$item->rowId}}"/>
								 	<span style="border: 1px solid #ccc;width: 30px;padding-left: 5px;margin-left: -4px;padding-right: 5px;"> + </span>
								 	
								

								</td>
								<td ><span style="line-height: 50px;" class="{{$item->rowId}}" id="{{$item->rowId}}" >{{number_format($item->qty * $item->price)}} </span><span> VND</span></td>
							</div>
								<td style="line-height: 50px;text-align: center"><a class="delete-cart"  style="cursor: pointer;"  data="{{$item->rowId}}" style="padding-left: 10px;"><i  style="color: red;font-size: 15px;" class="fa fa-trash-o "></i></a></td>
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
	<script>
$(document).ready(function(){
			
			$('.quantity_box span:nth-child(1)').click(function(){
				var parent = 	$(this).parents('tr');
				var quantity = parseInt(parent.find('input[name=quantity]').val());
    	   		 var rowId = parent.find('input[type=hidden]').attr('rowId');
    	   		 if(quantity == 1){
    	   		 	return false;
    	   		 }
    	   		 callAjax('down',quantity,rowId);
    	   		 parent.find('input[name=quantity]').val(quantity-1);	
			});
			$('.quantity_box span:nth-child(3)').click(function(){
				var parent = $(this).parents('tr')
			
				var quantity = parseInt(parent.find('input[name=quantity]').val());
				
				if (quantity > 9) {
           	 		return false;
    	   		 }
    	   		 var rowId = parent.find('input[type=hidden]').attr('rowId');
    	   		 callAjax('up',quantity,rowId);
    	   		 parent.find('input[name=quantity]').val(quantity+1);
			});
			
			// $('.quantity_box input').blur(function(){
				
			// 	var parent = 	$(this).parents('tr')
		
			// 	var quantity = parent.find('input[name=quantity]').val();
				
			// 	if (quantity > 10 || quantity < 1 || isNaN(quantity) ) {
   //         		 	quantity = 1;
   //    			  }
   //    			  	parent.find('input[name=quantity]').val(quantity);
			// });
			// $(".quantity_box input").blur(function () {
		 //        var quantity = parseInt($('.quantity_box input').val());
		 //        if (quantity > 10 || quantity < 1 || isNaN(quantity) ) {
   //         		 	quantity = 1;
   //    			  }
   //    			  $('.quantity_box input').val(quantity);

   // 			 });
 });
	</script>

<script>
	function callAjax(type,qty,rowId){
			var url = "{{route('update-cart')}}";	
			 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			  $.ajax({
	
                   
                    url: url,
                    type: 'post',
               
                   	data: {_token: CSRF_TOKEN, qty:qty,rowId:rowId,type:type},
                  
                     success: function (data) { 
                     	$('#list-header').html(data.header);
                     	$('.result').html(data.view);
                     	$('.count').html(data.count);
                   	
                     }
           }); 
	}	

		

	
</script>