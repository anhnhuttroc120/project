@extends('default.master')
@section('css')
<link rel="stylesheet" href="css/pagination.css">
<link rel="stylesheet" href="css/comment.css">
<style>
	.size li ,.color li{
		display: inline-table;
		border: 1px solid #cccccc;
		cursor: pointer;
		width: 25px;
		text-align: center;
	}
	.activesize{
		background: black;
		color: #fff;
	}
	.size li:hover , .color li:hover{
		background: black;
		color: #fff;
	}
	.quantity_box {
		list-style: none;
	}
	.quantity_box li , .quantity_box input{
		display: inline-block;

	}
	.quantity_box input{
		width: 30px;
		padding:5px !important;
		height: 40px;
		
	/*	text-align: center;	*/
	}
	.quantity_box li{
		 width: 15px;
    text-align: center;
    line-height: 40px;
    background-color: #ff6000;
    font-size: 20px;
    color: #fff;
    cursor: pointer;

	}
</style>
@endsection
@section('content')
<div class="container">
	<?php 
	if(!empty($product_main->detail->picture)){
		$pictures = json_decode($product_main->detail->picture,true);
		$picture_main = $pictures[1];
		$sizes = json_decode($product_main->detail->size,true);
		$colors = json_decode($product_main->detail->color,true);
		if($product_main->detail->sale_off > 0 ){
			$price = ((100 - $product_main->detail->sale_off)*$product_main->price)/100;
		} else {
			$price = $product_main->price;
			}
	}
	

	?>
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Trang chủ</a> / <span>Sản phẩm</span>
					/ <span>Sản phẩm chi tiết</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">
						{!!Form::open(['url'=>'add-cart','method'=>'post','id'=>'form-cart'])!!}
					<div class="row parentImage" data='1'>
						<div class="col-sm-4">
							<input type="hidden" name="id" value="{{$product_main->id}}">
							<img style="width: 286px;height: 381px;" class="imgtofly" src="images/product/{{$picture_main}}" alt="123">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">

								<h1  style="background: #e7e7e7;padding: 10px;" class="single-item-title">{{$product_main->name}}</h1>
								<p class="single-item-price">
									<h6 style="color: #ff9A00">{{number_format($price)}}<sup>đ</sup></h6>
								
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<h6 style="font-weight: bold">Mô tả sản phẩm</h6>
								<p><i class="fa fa-check"></i> Anie.vn giao hàng và thu tiền tận nơi toàn quốc.<i class="fa fa-check"></i>Miễn phí vận chuyển TOÀN QUỐC đối với đơn hàng từ 3 sản phẩm trở lên.<i class="fa fa-check"></i>Nhanh tay click MUA NGAY !</p>

							</div>
							<div class="space20">&nbsp;</div>

							
							<div class="{{-- single-item-options --}}">

								<p>Kích thước:</p>
								<div>
								{{-- <select class="wc-select" name="size"> --}}
								@if(!empty($sizes))	
								
									<ul class="size">
											@foreach($sizes as $size)
										<li data-size="{{$size}}">{{$size}}</li>
											@endforeach
									</ul>
									{{-- <option value="{{$size}}">{{$size}}</option>
									 --}}
								
								@endif	
								{{-- </select> --}}
	
									
								</div>
								<p>Màu:</p>
								<div>
								<ul class="color">
											@foreach($colors as $color)
										<li style="padding: 4px;" data-color="{{$color}}">{{$color}}</li>
											@endforeach
									</ul>
									
			
								</div>
								<p>Số lượng:</p>
								
								<ul class="quantity_box">
									<li> - </li>
									<input type="text" name="quantity" value="1" >
									<li> + </li>
								</ul>
								
								<div style="margin-top:10px;">
								
								<a  style="background: #ff6100;font-size: 25px;color: #e7e7e7" class="btn add-cart" >Thêm vào giỏ hàng</a>
								
				
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					{!!Form::close()!!}

					<div class="space40">&nbsp;</div>
					<div style="height: auto" class="woocommerce-tabs">
						<ul class="tabs">
							<li><a style="font-size: 16px;" href="#tab-description">Chi tiết</a></li>
							<li><a style="font-size: 16px;" href="#tab-reviews">Hướng dẫn mua hàng</a></li>
						</ul>

						<div " class="panel" id="tab-description">
							<h6>Thông tin chi tiết</h6>
							{!! $product_main->detail->description !!}


							<div class="img-detail">
								<div class="img-portrait" >
									<?php
									$pictures = array_reverse($pictures);

									 ?>
								@foreach($pictures as  $picture)
								<div style="max-width: 810px;" class="pictureproduct">
								<img  src="images/product/{{$picture}}" alt="123">
								</div>	
								@endforeach
								
								</div>
							
								
								
									

							</div>
							
							
						</div>
						<div class="panel" id="tab-reviews">
							<p><i class="fa fa-check"> Để đặt hàng vui lòng bấm vào nút</i><span style="background: #ff6100" class="btn" href="">Mua ngay</span> (nhớ chọn size và màu sắc cần mua ) sau đó điền đầy đủ thông tin và bấm <span style="background: #00cf00" class="btn">Đặt hàng</span> Hoặc gọi trực tiếp Hotline <b>1900.6835</b> phím số 1 để đặt hàng </p>
							<p>+ Nhân viên của shop sẽ liên hệ lại với Quý Khách trong thời gian sớm nhất sau khi đặt hàng thành công</p>
							<p>+ Hàng sẽ được đóng gói và vận chuyển ngay sau khi gọi điện thoại cho quý khách.</p>
							<p>+ Thời giang vận chuyển ở Đà Nẵng là từ 1-2 ngày còn ở tỉnh thành khác từ 3-7 ngày </p>
							<p>+ Shop giao hàng và thu tiền tận nơi.. thanh toán khi nhận hàng</p>
							<p><span  style="color: #ff0000;font-weight: bold;">+ Lưu ý</span>: <b> tất cả mặt hàng của shop nếu quý khách ở ĐN có thể kiểm tra và thử hàng khi nhận hàng , còn đối với khách hàng ở tỉnh thành khác do đặc thù của phía bưu điện quý khách phải thanh toán tiền cho bưu điện khi họ giao hàng rồi sau đó mới được kiểm tra hàng , Hàng shop có cam kết bảo hành và để tránh thất thoát nên quý khách không thể kiểm tra hàng trước khi thanh toán ! mọi thắc mắc xin liên hệ Hotline 1900 6835 để được hỗ trợ </b> </p>
							
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list" style="border: 0px;">
						<h4 style="margin-bottom: 10px;">Sản phẩm liên quan</h4>

						<div class="row">
							@foreach($products['relate'] as $product)
								<?php 
									$pictures = json_decode($product->detail->picture,true);
									$picture_main = $pictures[1];
									if($product->detail->sale_off > 0){
										$price_sale = ((100 - $product->detail->sale_off)*$product->price)/100;
									}

								
								?>
								<div  class="col-sm-4">
									<div  class="single-item">
										<div class="single-item-header" style="">
											<a href="chi-tiet/{{$product->slug}}"><img style="width: 251px;height: 334px;" class="picture-main"  src="images/product/{{$picture_main}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="name-product" style="height: 50px;"  class="single-item-title">{{$product->name}}</p>
											@if($product->detail->sale_off >0 )
												<span class="flash-del price">{{number_format($product->price)}}<sup>đ</sup ></span>
												<span class="flash-sale price">{{number_format($price_sale)}}<sup>đ</sup ></span>
												@else
												<span class="flash-sale price">{{number_format($product->price)}}<sup>đ</sup ></span>
												@endif
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href=""><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="chi-tiet/{{$product->slug}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
											<div   class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							
						</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Sản phẩm bán chạy</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($products['bestseller'] as $product)
								<?php
									$pictures = json_decode($product->detail->picture,true);
									$picture_main = $pictures[1];
									if($product->detail->sale_off > 0){
										$price = ((100 - $product->detail->sale_off)*$product->price)/100;

									} else {
										$price = $product->price;
										}
									$name = substr($product->name, 0,37) .'...'	;

								 ?>
								<div class="media beta-sales-item">
									<a class="pull-left" href="chi-tiet/{{$product->slug}}"><img src="images/product/{{$picture_main}}" alt=""></a>
									<div class="media-body">
										{{$name}}
										<span class="beta-sales-price">{{number_format($price)}} VNĐ </span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">Sản phẩm mới</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">

								@foreach($products['new'] as $product)
								<?php
									$pictures = json_decode($product->detail->picture,true);
									$picture_main = $pictures[1];
									if($product->detail->sale_off > 0){
										$price = ((100 - $product->detail->sale_off)*$product->price)/100;

									} else {
										$price = $product->price;
										}
									$name = substr($product->name, 0,37) .'...'	;

								 ?>
								<div class="media beta-sales-item">
									<a class="pull-left" href="chi-tiet/{{$product->slug}}"><img src="images/product/{{$picture_main}}" alt=""></a>
									<div class="media-body">
										{{$name}}
										<span class="beta-sales-price">{{number_format($price)}}VNĐ </span>
									</div>
								</div>
								@endforeach
								
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
		<div><hr></div>
	<div> <!-- wrapper form -->
			<form method="post" action="{{url('comment')}}">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="form-group">
					<input type="hidden" name="slug" value="{{$product_main->slug}}">
					<label for="email">Email:</label>
					<input required type="email" name="email" class="form-control" id="email">
				</div>
				<div class="form-group">
					<label for="name">Tên:</label>
					<input  required type="text" name="name" id="name" class="form-control">
				</div>
				<div class="form-group">
					<label for="cm">Bình luận:</label>
					<textarea required rows="10" id="cm" class="form-control" name="content"></textarea>
				</div>
				<div class="form-group text-right">
					<a  class="btn btn-default comment">Gửi</a>
				</div>

			</form>
		
		<div id="showcomment">
			 <div class="container" style="padding-bottom: 60px;">
			<div class="row list-product">

				<a class="btn btn-primary">Ý kiến phản hồi (<span class="countComment">{{count($product_main->comments)}}</span>)</a>
			<div class="wrapper-comment">
				@foreach($product_main->comments as $comment)
						<div class="item-comment" style="margin-top: 10px;">
							<div class="top">
								<h5>{{$comment->name}}</h5>
								<p>{{date('d/m/Y H:i:s', strtotime($comment->created_at))}}</p>
							</div>
							<div class="bot">
								<p>{{$comment->content}}</p>
							</div>
						</div>

				@endforeach
			</div>		

			</div>
		</div>

		</div>
	</div> <!-- end wrapper form -->

	</div> <!-- .container -->
@endsection
@section('script')
<script type="text/javascript">
		$(document).ready(function(){
			$('ul.size li:first').addClass('activesize');
			$('ul.size li').click(function(){

				$('ul.size li').removeClass('activesize');
				$(this).addClass('activesize');
			});
			
		});
	
</script>
<script type="text/javascript">
		$(document).ready(function(){
			$('ul.color li:first').addClass('activesize');
			$('ul.color li').click(function(){

				$('ul.color li').removeClass('activesize');
				$(this).addClass('activesize');
			});
			
		});
	
</script>

<script>

	$(document).ready(function(){
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		$('.add-cart').click(function(){
			var size = '';
			var color = '';
			var cart = $('.cart');
	
			var parent = $(this).parents('.parentImage');
			var src = parent.find('img').attr('src');
			var parTop = parent.offset().top;
			var parLeft = parent.offset().left;
		
			$('<img />',{
				class:'img-product-fly',
				src:src,

			}).appendTo('body').css({
				'top': parseInt(parTop),
				'left': parseInt(parLeft) +parseInt(parent.width()) - 600
			});
			setTimeout(function(){
				$(document).find('.img-product-fly').css({
					'top':cart.offset().top,
					'left':	cart.offset().left
				});
				setTimeout(function(){
					$(document).find('.img-product-fly').remove();

					
				},1000);
			},500);
			var quantity = $('input[name=quantity]').val();
			$('ul.size li').each(function(){
					if($(this).hasClass("activesize")){
						 size = $(this).attr('data-size');
						
					}
				
				});
			$('ul.color li').each(function(){
					if($(this).hasClass("activesize")){
						 color = $(this).attr('data-color');
						
					}
				
				});
			var id = $('input[name=id]').val();
			var url = "{{route('add-cart')}}";
			$.ajax({

                    /* the route pointing to the post function */
                    url: url,
                    type: 'post',
                     /* send the csrf-token and the input to the controller */
                   	data: {_token: CSRF_TOKEN, quantity:quantity,size:size,color:color,id:id},
                     /* remind that 'data' is the response of the AjaxController */
                     success: function (data) { 
                     	console.log(data);
                     	$('.count').html(data.count);
                     	$('#list-header').html(data.header);
                       
                     }
           }); 

			
		});
	});	
		
</script>
<script type="text/javascript">
	$(document).ready(function(){
		 $('.comment').click(function(){
		 	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			var email = $('#email').val();
			var name  = $('#name').val();
			var comment = $('#cm').val();
			var product_id = $('input[name=id]').val();
			var url =  "{{route('comment')}}";
			
			$.ajax({

                    /* the route pointing to the post function */
                    url: url,
                    type: 'post',
                     /* send the csrf-token and the input to the controller */
                  	data: {_token: CSRF_TOKEN, email:email,name:name,content:comment,id:product_id},
                     /* remind that 'data' is the response of the AjaxController */
                     success: function (data) { 
                     	console.log(data);
                     	if ($('.item-comment').length>0) {
	                     	$('#showcomment .item-comment:last').after(data.view);
	                     	
                     	} else {
	                     	$('.wrapper-comment').html(data.view);
                     	}
                     	$('.countComment').html(data.countComment);
                     	$('#cm').val('');
                       
                     }
           }); 


		 });
	});

</script>


	<script>
$(document).ready(function(){
			$('ul.quantity_box li:nth-child(1)').click(function(){
				var quantity = parseInt($('.quantity_box input').val())
				if (quantity > 1) {
           	 		$('.quantity_box input').val(quantity - 1);
    	   		 }
			});
			$(".quantity_box li:nth-child(3)").click(function () {
		        var quantity = parseInt($('.quantity_box input').val());
		        if (quantity < 10) {
           		 $('.quantity_box input').val(quantity + 1);
      			  }
   			 });
			$(".quantity_box input").blur(function () {
		        var quantity = parseInt($('.quantity_box input').val());
		        if (quantity > 10 || quantity < 1 || isNaN(quantity) ) {
           		 	quantity = 1;
      			  }
      			  $('.quantity_box input').val(quantity);

   			 });
 });
	</script>


@endsection
