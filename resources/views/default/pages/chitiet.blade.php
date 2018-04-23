@extends('default.master')
@section('content')
<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Trang chủ</a> / <span>Sản phẩm</span>
					/ <span>Sản phẩm chi tiết</span
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="images/book/2lozfcge.jpg" alt="123">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<h1  style="background: #e7e7e7;padding: 10px;" class="single-item-title">Sample Woman Top</h1>
								<p class="single-item-price">
									<h6 style="color: #ff9A00">120.000 <sup>đ</sup></h6>
								
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
									<option value="default">Chọn</option>
									<option value="XS">XS</option>
									<option value="S">S</option>
									<option value="M">M</option>
									<option value="L">L</option>
									<option value="XL">XL</option>
								</select>
								</div>
								<p>Số lượng:</p>
								
								<select class="wc-select" name="color">
									
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="7">8</option>
									<option value="7">9</option>
									<option value="7">10</option>
								</select>
								<p>Màu sắc: <b>Hồng</b> </p>
								<div style="margin-top:10px;">
								<a style="background: #ff6100;font-size: 25px;color: #e7e7e7" class="btn" href="">Mua ngay</a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div style="height: auto" class="woocommerce-tabs">
						<ul class="tabs">
							<li><a style="color: black ;font-weight: bold" href="#tab-description">Chi tiết</a></li>
							<li><a style="color:black ;font-weight: bold;" href="#tab-reviews">Hướng dẫn mua hàng</a></li>
						</ul>

						<div " class="panel" id="tab-description">
							<h6>Thông tin chi tiết</h6>
							<p><i class="fa fa-check" aria-hidden="true"></i>Tên sản phẩm:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Chất liệu:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Màu sắc:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Thiết kế:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Thiết kế:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>size S:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>size M:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>size L:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>size XL:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>size XXL:</p>
							<p><i class="fa fa-check" aria-hidden="true"></i>Màu sắc:</p>
							<div class="img-detail">
								<div class="img-portrait" >
								<img src="images/book/2lozfcge.jpg" alt="123">
								<img src="images/book/2lozfcge.jpg" alt="123">
								<img src="images/book/2lozfcge.jpg" alt="123">
								<img src="images/book/2lozfcge.jpg" alt="123">
								
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
							<div class="col-sm-4">
								<div class="single-item">
									<div class="single-item-header">
										<a href="product.html"><img src="source/assets/dest/images/products/4.jpg" alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">Sample Woman Top</p>
										<p class="single-item-price">
											<span>$34.55</span>
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="product.html"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="single-item">
									<div class="single-item-header">
										<a href="product.html"><img src="assets/dest/images/products/5.jpg" alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">Sample Woman Top</p>
										<p class="single-item-price">
											<p>120.000</p>
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="product.html"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="single-item">
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>

									<div class="single-item-header">
										<a href="#"><img src="assets/dest/images/products/6.jpg" alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">Sample Woman Top</p>
										<p class="single-item-price">
											<span class="flash-del">$34.55</span>
											<span class="flash-sale">$33.55</span>
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="#"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="#">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Sản phẩm bán chạy</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/1.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">120.000 VNĐ </span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/2.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/3.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/4.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">Sản phẩm mới</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/1.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/2.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/3.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/4.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection