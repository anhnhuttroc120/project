@extends('default.master')

@section('content')
	<div class="container"><div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Trang chủ</a> / <span>Giỏ hàng</span>
				</div>
			</div></div>
	<div class="container">
		
		<div class="row" style="margin-bottom: 20px;"> {{-- start row --}}

			<div class="col-md-5">
						<div >
					<a style="border-bottom: 3px solid #FF0000;font-size: 20px;font-weight: bold;width: "><i class="fa fa-truck fa-2x" style="color: black"> </i>GIAO HÀNG TỚI</a>
						</div>
					<p style="margin-top:10px;">Bạn vui lòng nhập đầy đủ thông tin bên dưới</p>
					<form action="#" method="post">
						<div class="form-block">
							<label for="email">Họ tên <span style="color:red">*</span></label>
							<input type="text" id="email" name="username">
						</div>
						<div class="form-block">
							<label for="email">Điện thoại <span style="color:red">*</span></label>
							<input type="email" id="email" name="email" required>
						</div>

						<div class="form-block">
							<label for="your_last_name">Tỉnh/Thành phố <span style="color:red">*</span></label>
							<select style="height: 40px;" name="city" id="">
								<option value="0">Chọn</option>
							</select>
						</div>
						<div class="form-block">
							<label for="your_last_name">Quận/Huyện<span style="color:red">*</span> </label>
							<select style="height: 40px;" name="district" id="">
								<option value="0">Chọn</option>
							</select>
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ<span style="color:red">*</span></label>
							<input type="text" id="adress" value="" name="address" required>
						</div>


						<div class="form-block">
							<label for="phone">Ghi chú</label>
							<textarea style="width: 60%" name="note" id="" value="">
								
							</textarea>
						</div>
						


					</form>
			


			</div>

			<div class="col-md-7">
					<div style="margin-bottom: 20px;">
					<a style="border-bottom: 3px solid #FF0000;font-size: 20px;font-weight: bold; "><i class="fa fa-shopping-cart fa-2x" style="color: black"> </i>SẢN PHẨM ĐÃ CHỌN</a>
					</div>
					<form  action="#" method="post">
						
						<table class="table table-bordered">
							<thead>
							<tr >
								<th class="text-center">Sản phẩm</th>
								<th class="text-center">Size - Màu</th>
								<th class="text-center">Giá tiền</th>
								<th class="text-center">Số lượng</th>
								
								<th class="text-center">Thành tiền</th>
								<th class="text-center">Xóa</th>
								
							</tr>
							</thead>
							<tbody>
								@for($i=0;$i<10;$i++)
							<tr class="shopping-cart">
								<td ><img src="images/product/2.jpg" alt="" ></td>
								<td><p>XL-Hồng</p></td>
								<td><p>225.000đ</p></td>
								<td><p><select name="quantity[]" id=""><option value="">1</option>
									<option value="">2</option>
									<option value="">3</option>
									<option value="">4</option>
									<option value="">5</option>
									</select></p>

								</td>
								<td><p>450.000đ</p></td>
								<td><p style="padding-left: 10px;"><i style="color: red;" class="fa fa-trash-o"></i></p></td>
							</tr>
							@endfor
							</tbody>


						</table>
							<div class="row" style="border-bottom: 1px solid #DEDFDE">
								<div class="col-md-8"></div>
								<div class="col-md-4 sumarry" >
									<p><b>Tổng tiền hàng:</b> <span style="padding-left: 30px;">335.000<sup>đ</sup></span></p>
									<p><b>Phí vận chuyển:</b> <span style="padding-left: 30px;">0<sup>đ</sup></span></p>
									<p><b style="padding-left: 30px;">Tổng cộng:</b> <span style="padding-left: 30px;color: red;font-weight: bold;">335.000<sup>đ</sup></span></p>
									
								</div>

							</div>
							<div  style="margin-top:10px;" class="row">
								<div class="col-md-12 bookcart">
									<a style="background: #A5A6A5" href="#" class="btn">TIẾP TỤC MUA HÀNG</a>
									<a style="background: #63AA38;float: right;" href="#" class="btn">ĐẶT HÀNG</a>
								</div>
							</div>	
					</form>

				
			</div> <!-- COL MD-7 -->
			




		</div>	 {{-- row end --}}


	</div>
@endsection