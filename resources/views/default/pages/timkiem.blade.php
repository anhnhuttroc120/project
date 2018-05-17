@extends('default.master')
@section('css')
<link rel="stylesheet" href="css/pagination.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
	select{
		font-family: fontAwesome;
	}
</style>
@endsection
@section('content')
<div class="container">
			{{-- <div class="pull-left">
				<h6 class="inner-title">tìm kiếm</h6>
			</div> --}}
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Trang chủ</a> / <span>Sản phẩm</span>/ <span>Tìm kiếm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<?php 
			$result = isset($products) ? count($products) : 0;
	?>

<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h2  class="product-new" data="{{$keyword}}" >Tìm thấy {{$products->total()}} kết quả với từ khóa  <span style="">	"{{$keyword}}"</span> </h2>
							<div style="margin-top:10px;float:right;">
								<select style="width: 300px;" class="form-control" name="order" id="">		
								@foreach($sorts as $key =>$value)
								@if(isset($sort) && $sort == $key)	
								<option style="font-weight: bold;" selected value="{{$key}}"> &#xf00c;{{$value}}</option>
								@else
								<option  value="{{$key}}">&emsp;&nbsp;{{$value}}</option>
								@endif
								@endforeach
							
							</select></div>
							<div style="margin-top:30px;" class="beta-products-details">
								
								<div class="clearfix"></div>
							</div>

					<div class="row product-search">
						@foreach($products as $product)
								<?php 
									$pictures = json_decode($product->detail->picture,true);
									$picture_main = $pictures[1];
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
							
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>
						@if(count($products) >=8)
						<div class="list" style="padding-left: 500px;">
							<a class="btn btn-success load-more">Xem thêm sản phẩm <i style="color: #ffffff;" class="fa fa-chevron-down"></i></a>
						</div>
						@endif
						
					{{-- 	back -to-top --}}
					
					</div>
				</div> <!-- end section with sidebar and main content -->
				<div class="row">
					
							
					</div>
				</div>



			</div> <!-- .main-content -->
		</div> <!-- #content -->
</div> <!-- .container -->
@endsection
@section('script')

<script>
	$(document).ready(function(){
		$('select[name=order]').change(function(){
			var order = $(this).val();
			var keyword = $('h2.product-new').attr('data');
			var url =  '{{url('search/')}}'   + '?keyword=' + keyword +'&sort=' +order ;
			$(location).attr('href', url);

		});

	});
</script>
<script>
	$(document).ready(function(){
		var position = 8;
		var item = 4;
		$('.load-more').click(function(){
			var order = $('select[name=order]').val();
			var keyword = $('h2.product-new').attr('data');
			var url =  '{{url('search/')}}'    + '?keyword=' + keyword +'&sort=' +order ;
			$.ajax({

                    /* the route pointing to the post function */
                    url: url,
                    type: 'get',
                     /* send the csrf-token and the input to the controller */
                   	data: {position:position , item:item},
                      // remind that 'data' is the response of the AjaxController 
                     success: function (data) { 
                     	position +=4;
                		if (data.view !='') {
                			$('.product-search .col-sm-3:last').after(data.view);		
                		} else {
                			$('.list').remove();
                		}
                     	
                     }
           }); 
		});
	});
</script>
@endsection

