@extends('default.master')
@section('content')
@include('default.slide')
<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h2 class="product-new" >Sản phẩm mới</h2>
							<div class="beta-products-details">
						
								<div class="clearfix"></div>
							</div>

							<div class="row">
								
								<div  class="col-sm-3">
									<div  class="single-item">
										<div class="single-item-header">
											<a href="chitiet/"><img src="images/book/" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="name-product" style="height: 50px;"  class="single-item-title"></p>
											<p class="single-item-price">
												<p class="price" ><sup>đ</sup ></p>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Chi tiết <i class="fa fa-chevron-right"></i></a>
											<div   class="clearfix"></div>
										</div>
									</div>
								</div>
								
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4 class="product-sell">Sản phẩm bán chạy</h4>
							<div class="beta-products-details">
								<p class="pull-left">438 styles found</p>
								<div class="clearfix"></div>
							</div>
						
								
							<div class="row">
							
								

								<div  class="col-sm-3">
									<div  class="single-item">
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										<div class="single-item-header">
											<a href="chitiet/"><img src="images/book/" alt=""></a>
										</div>
										<div class="single-item-body">
										<p class="name-product" style="height: 50px;"  class="single-item-title"></p>
											<p class="single-item-price">
												<p class="price"> <sup>đ</sup><p>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Chi tiết <i class="fa fa-chevron-right"></i></a>
											<div   class="clearfix"></div>
										</div>
									</div>
								</div>
							
							
							</div>
							<div class="space40">&nbsp;</div>

						
							
						</div> <!-- .beta-products-list -->
					{{-- 	back -to-top --}}
					
					</div>
				</div> <!-- end section with sidebar and main content -->



			</div> <!-- .main-content -->
		</div> <!-- #content -->
</div> <!-- .container -->
@endsection