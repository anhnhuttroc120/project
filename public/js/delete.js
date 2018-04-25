function deleteItem(id) {

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$("#dialog-confirm").dialog({

		resizable : false,
		height : 200,
		modal : true,
		buttons : {
			"Có" : function() {

				$.get('admin/product/delete/'+id, function(data) {
					 console.log(data);
					$('#item-' + id).remove().slideUp(300);

				});
				$(this).dialog("close");
			},
			Không : function() {
				$(this).dialog("close");
			}
		}
	});
	
}

$(document).ready(function(){
 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	$('#admin-Form select[name=school]').change(function(){
		
	 
		var school=$(this).val();
		 $.ajax({

                    /* the route pointing to the post function */
                    url: '/select',
                    type: 'post',
                     /* send the csrf-token and the input to the controller */
                   	data: {_token: CSRF_TOKEN, school:school},
                    dataType: 'text',
                     /* remind that 'data' is the response of the AjaxController */
                     success: function (data) { 
                     	console.log(data);
                        
                         $('#result').html(data);
                       
                     }
           }); 

	});

});
//phân trang ajaxlarravel
// $(document).on('click','.pagination a', function(e){
//            e.preventDefault();
//            var page = $(this).attr('href').split('page=')[1];

//            getPosts(page);
//        });
 
//        function getPosts(page)
//        {
//            $.ajax({
//                type: "GET",
//                url: '?page='+ page
//            })
//            .done(function(data) {
//                $('body').html(data);
//            });
//        }