<div id="header">
		<div style="background: #cecfce" class="header-top">
			<div  class="container">
				
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
						@if(Auth::check())
					
						<li style="position: relative"><a href="{{url('profile')}}"><i class="fa fa-user"></i>Chào bạn ! {{Auth::user()->fullname}} </a>
							
				
						</li>
							<li><a href="{{url('dang-xuat')}}">Đăng xuất</a></li>
						@else
						<li><a href="{{url('dang-ki')}}">Đăng kí</a></li>
						<li><a href="{{url('dang-nhap')}}">Đăng nhập</a></li>
						@endif
						
						
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div  class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="index.html" id="logo"><img style="width: 700px;height:152px;" src="images/banner.jpg" width="200px" alt=""></a>
				</div>
				<div style="padding-top:30px;" class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="/">
					        <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
					        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>

					<div class="beta-comp">
						<div class="cart">
							<div class="beta-select"><i style="color: red" class="fa fa-shopping-cart"></i> Giỏ hàng (Trống) <i class="fa fa-chevron-down"></i></div>
							<div class="beta-dropdown cart-body">
								<div class="cart-item">
									<div class="media">
										<a class="cart-item-delete" href="#"><i class="fa fa-times"></i></a>
										<a class="pull-left" href="#"><img src="source/assets/dest/images/products/cart/1.png" alt=""></a>
										<div class="media-body">
											<span class="cart-item-title">Sample Woman Top</span>
											<span class="cart-item-options">Size: XS; Colar: Navy</span>
											<span class="cart-item-amount">1*<span>$49.50</span></span>
										</div>
									</div>
								</div>

								<div class="cart-item">
									<div class="media">
											<a class="cart-item-delete" href="#"><i class="fa fa-times"></i></a>
										<a class="pull-left" href="#"><img src="source/assets/dest/images/products/cart/2.png" alt=""></a>
										<div class="media-body">
											<span class="cart-item-title">Sample Woman Top</span>
											<span class="cart-item-options">Size: XS; Colar: Navy</span>
											<span class="cart-item-amount">1*<span>$49.50</span></span>
										</div>
									</div>
								</div>

								<div class="cart-item">
									<div class="media">
											<a class="cart-item-delete" href="#"><i class="fa fa-times"></i></a>
										<a class="pull-left" href="#"><img src="source/assets/dest/images/products/cart/3.png" alt=""></a>
										<div class="media-body">
											<span class="cart-item-title">Sample Woman Top</span>
											<span class="cart-item-options">Size: XS; Colar: Navy</span>
											<span class="cart-item-amount">1*<span>$49.50</span></span>
										</div>
									</div>
								</div>

								<div class="cart-caption">
									<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">$34.55</span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="checkout.html" class="beta-btn primary text-center">Đặt hàng <i  class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
						</div> <!-- .cart -->
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="background-color: #f97742;">
			<div class="container">
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						


						 
						<li><a   href="{{url('trang-chu')}}">TRANG CHỦ</a></li>
						<li><a href="#">ĐẦM CÔNG SỞ</a>
							{{-- <ul class="sub-menu">
							
								<li><a style="" href="category/"></a></li>
								
							</ul> --}}
						</li>
						<li><a href="about.html">ĐẦM DẠO PHỐ -DỰ TIỆC</a></li>
						<li><a href="about.html">ÁO SƠ MI</a></li>
						<li><a href="about.html">ĐỒ BỘ</a></li>
						<li   class="lienhe" > <img style="width: 150px;height: 61px;"  src="images/right_menu.png" alt=""></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->	</div> <!-- #header -->