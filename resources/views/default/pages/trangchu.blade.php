@extends('default.master')
@section('css')
     {{-- <link rel="stylesheet" href="assets/css/docs.theme.min.css"> --}}
<link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
   <link rel="stylesheet" href="assets/owlcarousel/assets/owl.theme.default.min.css">
   <style>
   	button.owl-prev{
   		position: relative;
   		top:-400px;
   		right: 520px;
   		height: 0px;

   	}
   	.owl-prev span{
   		font-size:  70px;
   		color: #181818;
   	}
   	button.owl-next{
   		position: relative;
   		top:-400px;
   		left: 520px;
   		height: 0px;
 

   	}
   	.owl-next span{
   		font-size:  70px;
   		 color: #181818;
   	}
   	.owl-dots{
   		display: none;
   	}
   	.owl-nav{
   		height: 0px;
   	}
   	
   </style>

@endsection
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
						 <div class="large-12 columns">
							<div class="row owl-carousel owl-theme">
								@foreach($products['new'] as $product)
								<?php 
									$pictures = json_decode($product->detail->picture,true);
									$picture_main = $pictures[1];
									if($product->detail->sale_off > 0){
										$price_sale = ((100 - $product->detail->sale_off)*$product->price)/100;
									}

								
								?>
								<div  class="col-sm-3 item">
									<div  class="single-item">
									{{-- 	@if($product->detail->sale_off > 0 )
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif --}}

										<div class="single-item-header">
											<a href="chi-tiet/{{$product->slug}}"><img src="images/product/{{$picture_main}}" alt=""></a>


										</div>
										<div class="single-item-body" style="width: 250px;">
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
										
										<div class="single-item-caption" style="width: 250px;">
											<a class="add-to-cart pull-left" href="chi-tiet/{{$product->slug}}"><i class="fa fa-info-circle"></i></a>
											<a class="beta-btn primary" href="chi-tiet/{{$product->slug}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
											<div   class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div> {{-- row --}}
						</div>{{-- lar12-column	 --}}

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
											<a class="add-to-cart pull-left" href="chi-tiet/{{$product->slug}}"><i class="fa fa-info-circle"></i></a>
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
@section('script')

  <script src="assets/owlcarousel/owl.carousel.js"></script>
<script>   
$('#myCarousel').carousel({ 
    interval:   2000    
});
</script>
<script>
            $(document).ready(function() {
              $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
                  1000: {
                    items: 4,
                    nav: true,
                    loop: true,
                    margin: 20,
                    autoplay:true
                  }
                }
              })
            })
          </script>
        
@endsection


