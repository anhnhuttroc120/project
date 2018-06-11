<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laravel </title>
	<base href="{{asset('')}}">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	   <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="source/assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="source/assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" href="source/assets/dest/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="source/assets/dest/rs-plugin/css/responsive.css">
	<link rel="stylesheet" title="style" href="source/assets/dest/css/style.css">
	<link rel="stylesheet" href="source/assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="source/assets/dest/css/huong-style.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" href="css/loading.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
	<script>
		$(window).load(function() {
		// Animate loader off screen 
		$(".se-pre-con").fadeOut("fast");
			});
		</script>
	@yield('css')
	
{{-- 	<link rel="stylesheet" title="style" href="source/assets/dest/css/fontawesome509/fontawesome-all.min.css"> --}}
	
</head>

	@include('default.header')
	<div class="inner-header">
	<div class="se-pre-con"></div>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title text-left">Đăng nhập</h6>
        </div>
        <div class="modal-body" style="padding-left: 100px;">
        	<p>Những thông tin có đánh dấu (<span style="color: red;">*</span>) là bắt buộc nhập.</p>
        	<div class="username">
         	 <label style="width: 150px;" for="">Tên tài khoản<span style="color: red;">*</span></label> <input type="text" name="taikhoan" style="border-radius: 5px;border: 1px solid #395999" >
          </div>
          <div class="password" style="margin-top:10px;">
         	 <label style="width: 150px;"" for="">Mật khẩu<span style="color: red;">*</span></label> <input type="password" name="matkhau" style="border-radius: 5px;height: 37px !important;padding: 0px 12px; border: 1px solid #395999">
          </div>
          <div class="forget-pass">
          <a href="#" style="margin-left: 150px;color: black;">Quên mật khẩu ?</a>	
          <div class="alert alert-danger wrong" style="display: none;">
          	<p  class="text-danger" >Tài khoản và mật khẩu không chính xác</p>
          </div>
          </div>
        </div>
        <div class="modal-footer" >
          <button type="button"  class="btn attemp" style="margin-right:100px !important;width: 300px;background: #ff7542;font-weight: bold;" >Đăng nhập</button>
        </div>
      </div>
      
    </div>
  </div>


	
	@yield('content')
	{{-- Nút lên tóp --}}
	<div class="container-fluid">


		<div style="float: right;" class="back-to-top row">
			<div class="col-md-12">
				<a style="display: inline;background: #292431"  class="btn btn-top" href="javascript:void(0);"><i style="color: #e7e7e7;" class="fa fa-arrow-up fa-3x"></i></a>
			</div>
		</div> {{-- row --}}

		</div> {{-- container-fluid --}}

	@include('default.footer')


	<!-- include js files -->
	
	<script src="source/assets/dest/js/jquery.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="source/assets/dest/js/btn_top.js"></script>
	<script src="source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	{{-- <script src="source/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script> --}}
	<script src="source/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
	{{-- <script src="source/assets/dest/vendors/animo/Animo.js"></script> --}}
	<script src="source/assets/dest/vendors/dug/dug.js"></script>
	<script src="source/assets/dest/js/scripts.min.js"></script>
	
	{{-- <script src="source/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script src="source/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script> --}}
	{{-- <script src="source/assets/dest/js/waypoints.min.js"></script> --}}
{{-- 	<script src="source/assets/dest/js/wow.min.js"></script> --}}

	<script>
	$(document).ready(function($) {    
		$(window).scroll(function(){
			if($(this).scrollTop()>150){
			$(".header-bottom").addClass('fixNav')
			}else{
				$(".header-bottom").removeClass('fixNav')
			}
		})
	})


	</script>
		
	{{-- <script>
		 jQuery(document).ready(function($) {
                'use strict';
			
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag
        $(".menu-info a").each(function() {
        	// var a = $('.menu-info a').attr('href');

            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest("li").addClass("active2");
				 $(this).parents('li').addClass('parent-active');
           	
           		 }
           });		 
        
    }); 
	</script> --}}
	<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
<script>
	$(document).ready(function(){
 		$('.attemp').click(function(e){
 			e.preventDefault();
 			var taikhoan = $('input[name=taikhoan]').val();
 			var matkhau = $('input[name=matkhau]').val();
 			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 			var url = '{{url('dang-nhap')}}';
			 $.ajax({

                    /* the route pointing to the post function */
                    url: url,
                    type: 'POST',
                     /* send the csrf-token and the input to the controller */
                   	data: {username:taikhoan,_token:CSRF_TOKEN,password:matkhau},
             
                      // remind that 'data' is the response of the AjaxController 
                     success: function (data) { 
                     	console.log(data);
                     	var trangchu = '{{url('trang-chu')}}';
                     	if(data.status == 'success') {
                     		$(location).attr('href', trangchu);
                     	} else {
                     		$('.wrong').show();
                     	}
                     } 
           }); 
 		});
 	});
</script>
@yield('script')
</body>
</html>
