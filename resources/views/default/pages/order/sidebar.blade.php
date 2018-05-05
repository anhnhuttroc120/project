<div  style="background:#F5F5F5;min-height:600px;padding-top: 30px;" class="col-md-2" >
				<div class="user">
					<div class="image">
						<div style="border: 1px solid red; border-radius: 25px; width: 40px; height: 40px;">
							<img style="border-radius: 15px;" src="images/user/{{Auth::user()->picture}}">
						</div>
					</div>
					<div class="username">
						<span>{{Auth::user()->fullname}}</span>
						<p><i style="color: red;" class="fa fa-edit"></i>Sửa hồ sơ</p>
					</div>
				</div>
				<div class="nav-container">
					<div class="item-admin" style="padding-top: 20px;">
						<nav class="menu-info">
						<ul >	
							<li ><i style="color: black;" class="fa fa-user"></i><span style="margin-left: 10px;"><a href="{{url('profile')}}">Thông tin tài khoản</a></span></li>
							<li><i style="color: #315510;" class="fa fa-key"></i><span style="margin-left: 10px;"><a href="{{url('changepass')}}">Đổi mật khẩu</a></span></li>
							<li><i style="color: #f44131;" class="fa fa-shopping-cart"></i><span style="margin-left: 10px;"><a href="{{url('order')}}">Đơn hàng của tôi</a></span></li>
						</ul>
						</nav>
					</div>
					
				</div>
			</div> {{-- col-md-2 end --}}
			<div class="col-md-1" style="background: #FFFBFF"></div>