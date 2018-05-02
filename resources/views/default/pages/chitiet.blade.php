@extends('default.master')
@section('css')
<link rel="stylesheet" href="css/pagination.css">
@endsection
@section('content')
<div class="container">
	<?php 
	if(!empty($product->detail->picture)){
		$pictures = json_decode($product->detail->picture,true);
		$picture_main = $pictures[1];
		$sizes = json_decode($product->detail->size,true);
		$colors = json_decode($product->detail->color,true);
		if($product->detail->sale_off > 0 ){
			$price = ((100 - $product->detail->sale_off)*$product->price)/100;
		} else {
			$price =$product->price;
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
					<div class="row">
						<div class="col-sm-4">
							<input type="hidden" name="id" value="{{$product->id}}">
							<img src="images/product/{{$picture_main}}" alt="123">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<h1  style="background: #e7e7e7;padding: 10px;" class="single-item-title">{{$product->name}}</h1>
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
								<select class="wc-select" name="size">
									@foreach($sizes as $size)
									<option value="{{$size}}">{{$size}}</option>
									@endforeach
								</select>

									
								</div>
								<p>Màu:</p>
								<div>
								<select class="wc-select" name="color">
									
									@foreach($colors as $color)
									<option value="{{$color}}">{{$color}}</option>
									@endforeach
									</select>
								</div>
								<p>Số lượng:</p>
								
								<select class="wc-select" name="quantity">
									@for($i = 1 ; $i<=10; $i++)
									<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
								<p>Màu sắc:
								@foreach($colors as $key => $color) 
									@if($key == count($colors)-1)
									<b>{{$color}}  </b>
									@else
									<b>{{$color}} ,  </b>
									@endif
									@endforeach 
								</p>
								<div style="margin-top:10px;">
								<button type="submit" style="background: #ff6100;font-size: 25px;color: #e7e7e7" class="btn" >Mua ngay</button>
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
							{!! $product->detail->description !!}


							{{-- <p><i class="fa fa-check" aria-hidden="true"></i>Tên sản phẩm:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Chất liệu:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Màu sắc:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Thiết kế:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Thiết kế:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>size S:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>size M:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>size L:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>size XL:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>size XXL:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Màu sắc:</p> --}}
							<div class="img-detail">
								<div class="img-portrait" >
									<?php
									$pictures = array_reverse($pictures);

									 ?>
								@foreach($pictures as  $picture)	
								<img  src="images/product/{{$picture}}" alt="123">
								
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
					<div class="beta-products-list">
						<h4>Sản phẩm liên quan</h4>

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
										<div class="single-item-header">
											<a href="chi-tiet/{{$product->slug}}"><img src="images/product/{{$picture_main}}" alt=""></a>
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
									$name = substr($product->name, 0,50) .'...'	;

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

								<@foreach($products['new'] as $product)
								<?php
									$pictures = json_decode($product->detail->picture,true);
									$picture_main = $pictures[1];
									if($product->detail->sale_off > 0){
										$price = ((100 - $product->detail->sale_off)*$product->price)/100;

									} else {
										$price = $product->price;
										}
									$name = substr($product->name, 0,50) .'...'	;

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
				</div>
			</div>
		</div> <!-- #content -->
		<div><hr></div>
		<div style="width: 501px;">
			<h3>Bình luận</h3>
			<form>
				<input type="hidden" name="">
				<div>
					<label>Email</label><br>
					<input type="email" name="email" placeholder="Email" style="width: 500px;">
				</div>
				<div>
					<label>Tên</label> <br>
					<input type="text" name="name" style="width: 500px;">
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Bình luận</label>
    				<textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10" style="width: 500px;"></textarea>
				</div>
				<div style="float: right;">
					<button type="submit" style="background: #ff6100;font-size: 15px;color: #e7e7e7" class="btn" >Gửi</button>
				</div>
			</form>
		</div>
		<div style="padding-top: 100px; padding-bottom: 30px;">
			<p style="font-weight: bold; line-height: 30px;">Project-team1:</p>
			<p>2018-05-02 00:00:00</p>
			<p style="font-weight: bold;line-height: 30px;">Tên:</p>
			<p>Dũng</p>
			<p style="font-weight: bold;">Nội dung:</p>
			<p>ai mà biết</p>
		</div>
	</div> <!-- .container -->
@endsection