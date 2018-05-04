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
			<div  style="background:#F5F5F5;min-height:600px;padding-top: 30px;" class="col-md-2" >
				<div class="user">
					<div class="image">
						<div style="border: 1px solid red; border-radius: 25px; width: 40px; height: 40px;">
							<img style="border-radius: 15px;" src="images/user/1GbEUfyoj9dzp1.jpg">
						</div>
					</div>
					<div class="username">
						<span>Dũng Trần</span>
						<p><i style="color: red;" class="fa fa-edit"></i>Sửa hồ sơ</p>
					</div>
				</div>
				<div class="nav-container">
					<div class="item-admin" style="padding-top: 20px;">
						<ul><i style="color: red; " class="fa fa-user-md"></i>&nbsp;<a href="">Quản lý tài khoản</a>
							<li><i style="color: black;" class="fa fa-user"></i><span style="margin-left: 10px;"><a href="">Thông tin tài khoản</a></span></li>
							<li><i style="color: blue;" class="fa fa-user"></i><span style="margin-left: 10px;"><a href="">Đổi mật khẩu</a></span></li>
							<li><i style="color: yellow;" class="fa fa-user"></i><span style="margin-left: 10px;"><a href="">Đơn hàng của tôi</a></span></li>
						</ul>
					</div>
					<div class="item-order">
						<ul style="margin-top: 10px;"><i style="color: red;" class="fa fa-th-list"></i>&nbsp;<a href="">Danh sách đơn hàng</a>
							<li><i style="color: black;" class="fa fa-list-ul"></i><span style="margin-left: 10px;"><a href="">Đơn hàng đổi trả</a></span></li>
							<li><i style="color: blue;" class="fa fa-list-ul"></i><span style="margin-left: 10px;"><a href="">Đơn hàng hủy</a></span></li>
						</ul>
					</div>
					<div class="item-comment">
						<h6>Nhận xét của tôi</h6>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
			<div style="" class="col-md-9">
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
