@extends('default.master')
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

<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<a  class="product-new" >KẾT QUẢ TÌM KIẾM CHO: <span style="color: red;">	"đầm"</span> </a>
							<div style="margin-top:30px;" class="beta-products-details">
								
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($bookNew as $book)
								<div  class="col-sm-3">
									<div " class="single-item">
										<div class="single-item-header">
											<a href="chitiet/{{$book['id']}}"><img src="images/book/{{$book['picture']}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="name-product" style="height: 50px;"  class="single-item-title">{{$book['name']}}</p>
											<p class="single-item-price">
													<p class="price">{{number_format($book['price'])}} <sup>đ</sup><p>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Chi tiết <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						
					{{-- 	back -to-top --}}
					
					</div>
				</div> <!-- end section with sidebar and main content -->



			</div> <!-- .main-content -->
		</div> <!-- #content -->
</div> <!-- .container -->
@endsection