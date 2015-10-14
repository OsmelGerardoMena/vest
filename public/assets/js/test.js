$(document).ready(function(){
	$('select#selected-seller').on('change', function(){

		var seller_id = $('#selected-seller').val();
		
		if ($.trim(seller_id) != '') {

			//$.post( "", {}, function(){} )

			/*$.ajax({
	  			url: 'sales',
	  			type: 'POST',
	  			data: seller_id,
	  			success: function( data ) {
	    			alert('Yupiii');
	  			}
			});*/
		}
	});
});