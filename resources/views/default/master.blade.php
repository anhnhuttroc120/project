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
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="source/assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="source/assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" href="source/assets/dest/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="source/assets/dest/rs-plugin/css/responsive.css">
	<link rel="stylesheet" title="style" href="source/assets/dest/css/style.css">
	<link rel="stylesheet" href="source/assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="source/assets/dest/css/huong-style.css">
	@yield('css')
	
{{-- 	<link rel="stylesheet" title="style" href="source/assets/dest/css/fontawesome509/fontawesome-all.min.css"> --}}
	
</head>


	@include('default.header')
	<div class="inner-header">
		

	
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
	<script type="text/javascript" src="source/assets/dest/js/btn_top.js"></script>
	<script src="source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="source/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
	<script src="source/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
	<script src="source/assets/dest/vendors/animo/Animo.js"></script>
	<script src="source/assets/dest/vendors/dug/dug.js"></script>
	<script src="source/assets/dest/js/scripts.min.js"></script>
	<script src="source/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script src="source/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script src="source/assets/dest/js/waypoints.min.js"></script>
	<script src="source/assets/dest/js/wow.min.js"></script>
	<!--customjs-->
{{-- 	<script src="source/assets/dest/js/custom2.js"></script> --}}
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
	<script>
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
	</script>
	
	@yield('script')
</body>
</html>
