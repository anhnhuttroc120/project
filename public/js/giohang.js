$(document).ready(function(){
		
		 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$('select[name=quantity]').change(function(){
			var qty = $(this).val();
			var rowId = $(this).attr('data');
			var url = "{{route('update-cart')}}";
			
			 $.ajax({

                    /* the route pointing to the post function */
                    url: url,
                    type: 'post',
                     /* send the csrf-token and the input to the controller */
                   	data: {_token: CSRF_TOKEN, qty:qty,rowId:rowId},
                     /* remind that 'data' is the response of the AjaxController */
                     success: function (data) { 
                     	$('#list-header').html(data.header);
                     	$('.result').html(data.view);
                   	
                     }
           }); 


		});

	});