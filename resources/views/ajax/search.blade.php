@foreach($products as $product)
								<?php 
									$pictures = json_decode($product->detail->picture,true);
									$picture_main = reset($pictures);
									if($product->detail->sale_off > 0){
										$price_sale = ((100 - $product->detail->sale_off)*$product->price)/100;
									}

								
								?>
								<div  class="col-sm-3">
									<div  class="single-item">
										<div class="single-item-header">
											<a href="chi-tiet/{{$product->slug}}"><img src="images/product/{{$picture_main}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="name-product" style="height: 50px;"  class="single-item-title">{{$product->name}}</p>
											@if($product->sale_off >0 )
												<span class="flash-del price">{{number_format($product->price)}}<sup>đ</sup ></span>
												<span class="flash-sale price">{{number_format($price_sale)}}<sup>đ</sup ></span>
												@else
												<span class="flash-sale price">{{number_format($product->price)}}<sup>đ</sup ></span>
												@endif
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="chi-tiet/{{$product->slug}}"><i class="fa fa-info-circle"></i></a>
											<a class="beta-btn primary" href="chi-tiet/{{$product->slug}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
											<div   class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach