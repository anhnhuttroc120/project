function deleteItem(id) {

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$("#dialog-confirm").dialog({

		resizable : false,
		height : 200,
		modal : true,
		buttons : {
			"Có" : function() {

				$.get('admin/user/delete/'+id, function(data) {
					if(data.status == 'success' ){
						 $('#item-' + id).remove();	
					}else{
						$url = ""
						$(location).attr('href', url);
					}
					

				});
				$(this).dialog("close");
			},
			Không : function() {
				$(this).dialog("close");
			}
		}
	});
	
}