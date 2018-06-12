<div id="header">
		<div style="background: #cecfce" class="header-top">
			<div  class="container">
				
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
						@if(Auth::check())
					
						<li style="position: relative"><a href="{{url('profile')}}"><i class="fa fa-user"></i>Chào bạn ! {{Auth::user()->fullname}} </a>
							
				
						</li>
							<li><a href="{{url('dang-xuat')}}">Đăng xuất</a></li>
						@else
						<li><a href="{{url('dang-ki')}}">Đăng kí</a></li>
						<li><a  style="cursor: pointer;" id="myBtn" >Đăng nhập</a></li>
						@endif
						
						
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div  class="header-body" >
			<div class="container beta-relative" 	>
				<div class="pull-left">
					<a href="{{url('/')}}" id="logo"><img style="width: 700px;height:152px;" src="images/banner.jpg" width="200px" alt=""></a>
				</div>
				<div style="padding-top:30px;" class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					 <div class="beta-comp">
						<form role="search" method="get" id="searchform" action="{{url('search')}}">
					        <input style=" " type="text"  name="keyword" value="@if(!empty($keyword)){{$keyword}}@endif"  id="s" placeholder="Nhập từ khóa..." autocomplete="off" />
					        <div class="ajax-search" style="position:absolute;"  >
					        	<table class="table table-bordered result-search animated fadeIn" style="position: relative;z-index: 2323233;width:400px;display: none;" >
					        		<thead>
					        			<tr>
					        				<td colspan="2"> <span style="border-bottom: 1px solid black;">Kết quả từ khóa:</span> <span id="key"></span></td>
					        			</tr>
					        		</thead>
					        	<tbody class="result-search">
					        		

					        	</tbody>
					        		
					        	
					        		
					        		
					        	</table>
					        	
					        </div>
					        
					        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>
					 <div class="beta-comp">
						<div class="cart" data="1">
							<div class="beta-select">
						<i style="color: red" class="fa fa-shopping-cart"></i>
						       Giỏ hàng(<span class="count"> @if(!empty(Cart::count())){{Cart::count()}}@else 0 @endif </span> )<i class="fa fa-chevron-down"></i>
					 		</div>
					
					
					<span id="list-header">

						{!! view('ajax.header')->render() !!}
						

					</span> {{-- end result --}}
					</div> <!-- .cart -->

				</div> {{-- end beta-comp --}}
	
				</div>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="wraper-header" style="background-color: #f97742;position: relative;z-index: 0" >
			<div class="container" >
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu"    >
					<ul class="l-inline ov"  >
						 
						<li class="{{(Request::is('trang-chu') || Request::is('profile') || Request::is('changepass') || Request::is('order')  || Request::is('search/*') || Request::is('/')) ? "active3" :'' }}"><a   href="{{url('trang-chu')}}">TRANG CHỦ</a></li>
						
						@foreach($categories_main as $key => $category)
						<li class="{{(Request::is('category/'.$category->slug)) ? 'active3' : ''}}"><a href="category/{{$category->slug}}">{{$category->name}}</a>
							
						</li>
						@endforeach
						{{-- <li style="height: 61px;"   > <img style="width: 150px;height: 61px;"  src="images/right_menu.png" alt=""></li> --}}
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->	</div> <!-- #header -->
		{{-- <ul class="sub-menu">
							
								<li><a style="" href="category/"></a></li>
								
							</ul> --}}
<script>
	$(document).ready(function(){
		$('input[name=keyword]').on('keyup', function(){
			var keyword = $(this).val();
			var result = $('.result-search') ;
			var url = '{{url('autocomplete')}}';
			$('span#key').html(keyword);

			if (keyword.trim() != '') {
				$.ajax({
                    /* the route pointing to the post function */
                    url: url,
                    type: 'get',
                     /* send the csrf-token and the input to the controller */
                   	data: {keyword:keyword},
                     /* remind that 'data' is the response of the AjaxController */
                     success: function (data) { 
                     	console.log(data.products)
                     	$('tbody.result-search').html(data.products);
                     	result.show();
                       
                     }
          		}); 

			} else {
				result.hide();
				return false;
			}
			
    
		});
	   
    
		
	});
</script>
			
<script>
	//bat su kien kick khac phan tu do thi an
	$(document).click(function(e){
			var table = $('.result-search');
			if (!table.is(e.target) && table.has(e.target).length === 0)
    {
        table.hide();
    }
	});
</script>
