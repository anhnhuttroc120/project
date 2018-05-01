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
								@foreach($products['new'] as $product)
								<?php 
									$pictures = json_decode($product->detail->picture,true);
									$picture_main = $pictures[1];
									if($product->detail->sale_off > 0){
										$price_sale = ((100 - $product->detail->sale_off)*$product->price)/100;
									}

								
								?>
								<div  class="col-sm-3">
									<div  class="single-item">
										@if($product->detail->sale_off > 0 )
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif

										<div class="single-item-header">
											<a href="chi-tiet/{{$product->slug}}"><img src="images/product/{{$picture_main}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="name-product" style="height: 50px;"  class="single-item-title">{{$product->name}}</p>
											<p class="single-item-price">
												@if($product->detail->sale_off >0 )
												<span class="flash-del price">{{number_format($product->price)}}<sup>đ</sup ></span>
												<span class="flash-sale price">{{number_format($price_sale)}}<sup>đ</sup ></span>
												@else
												<span class="flash-sale price">{{number_format($product->price)}}<sup>đ</sup ></span>
												@endif
											</p>
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

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4 class="product-sell">Sản phẩm bán chạy</h4>
							<div class="beta-products-details">
								
								<div class="clearfix"></div>
							</div>
						
								
							<div class="row">
							
								
								@foreach($products['bestseller'] as $product)
								<?php 
								$pictures = json_decode($product->detail->picture,true);
								$picture_main = $pictures[1];
								if($product->detail->sale_off > 0){
										$price_sale = ((100 - $product->detail->sale_off)*$product->price)/100;
									}

								?>
								<div  class="col-sm-3">
									<div  class="single-item">
										@if($product->detail->sale_off > 0 )
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif

										<div class="single-item-header">
											<a href="chi-tiet/{{$product->slug}}"><img src="images/product/{{$picture_main}}" alt=""></a>
										</div>
										<div class="single-item-body">
										<p class="name-product" style="height: 50px;"  class="single-item-title">{{$product->name}}</p>
											<p class="single-item-price">
												@if($product->detail->sale_off >0 )
												<span class="flash-del price">{{number_format($product->price)}}<sup>đ</sup ></span>
												<span class="flash-sale price">{{number_format($price_sale)}}<sup>đ</sup ></span>
												@else
												<span class="flash-sale price">{{number_format($product->price)}}<sup>đ</sup ></span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="chi-tiet/{{$product->slug}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
											<div   class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							
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

