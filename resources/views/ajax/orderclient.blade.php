							
							@if($order->status == 2){
								<td class="" style="width: 15%;"><a data="{{$order->id}}" status="{{$order->status}}" class="status result-{{$order->id}}" style="cursor:pointer"><small style=" width:100% !important;" class="label label-default">  Đang xử lý</small></a></td>
							 @else
							 	<td class="" style=" width: 15%;"><a data="{{$order->id}}" status="{{$order->status}}" class="status result-{{$order->id}}" style="cursor:pointer"><small style=" width:100% !important;" class="label label-danger"> Hủy </small></a></td>
							 @endif


<script>
	$(document).ready(function(){
		$('.status').click(function(){
			var id = $(this).attr('data');
			var status = $(this).attr('status');
			url = "{{url('status')}}";
			$.ajax({

                    /* the route pointing to the post function */
                    url: url,
                    type: 'get',
                     /* send the csrf-token and the input to the controller */
                   	data: {id:id,status:status},
                     /* remind that 'data' is the response of the AjaxController */
                     success: function (data) { 
	   
	                     $('td.item-'+data.id).html(data.view);
                  
                     }
           }); 

		});
	});
</script>							 
								
								
						
							