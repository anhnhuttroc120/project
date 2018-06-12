
					 <div class="beta-dropdown cart-body">
						@if(count(Cart::content())>0)
							@foreach(Cart::content() as $item)	
								<div class="cart-item">
									<div class="media">
										
										<a class="pull-left" href="#"><img src="images/product/{{$item->options->img}}" alt=""></a>
										<div class="media-body" style="width: auto;">
											<span class="cart-item-title">{{$item->name}}</span>
										
											<span class="cart-item-amount">{{$item->qty}} X <span>{{number_format($item->price)}}</span><span> VND</span></span>
										</div>
									</div>
								</div>
							@endforeach
								
								<?php 
									$total = explode('.', Cart::subtotal());
								?>
								<div class="cart-caption">
									<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{$total[0]}} </span><span>VND</span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="{{url('giohang')}}" class="beta-btn primary text-center">Đặt hàng <i  class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>{{--  cart body --}}	
							@else
									<p>Không có sản phẩm nào trong giỏ hàng</p>
							@endif		
						

