@extends('default.master')
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="css/dung.css">
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
	select{
		font-family: fontAwesome;
	}
</style>

@endsection
@section('content')

	<div class="container-fluid" style="margin-top: -19px; ">
		<div class="row">
				@include('default.pages.order.sidebar')
			
			<div style="" class="col-md-8">
				<div style="margin-bottom: 20px;">
					<a style="border-bottom: 3px solid #FF0000;font-size: 20px;font-weight: bold; "><i class="fa fa-shopping-cart fa-2x" style="color: black"> </i>SẢN PHẨM ĐÃ CHỌN</a>
					</div>
						<table class="table table-bordered">
							<thead>
							<tr >
								<th class="text-center">Sản phẩm</th>
								<th class="text-center">Size - Màu</th>
								<th class="text-center">Số lượng</th>
								<th class="text-center">Giá tiền</th>
								<th class="text-center">Thành tiền</th>
								<th class="text-center">Trạng thái</th>
								
							</tr>
							</thead>
							<tbody>
							<tr class="">
								<input type="hidden" id="">
								<td class="center" ><img src="" alt="" >Áo</td>
								<td class="center">S</td>
								<td class="center">2</td>
								<td class="center">1200000</td>
								<td class="center">34000000</td>
								<td><a href="" style="padding-left: 10px;line-height: 50px;"><i  style="color: red;font-size: 15px;" class="fa fa-trash-o "></i></a></td>
							</tr>
							</tbody>
						</table>
			</div>
		</div>
	</div>
@endsection
@section('script')
@endsection
