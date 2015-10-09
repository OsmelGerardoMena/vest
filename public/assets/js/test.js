$('select#selected-seller').on('change', function(){

	var seller_id = $('#selected-seller').val();
	
	if ($.trim(seller_id) != '') {
		$.post('ruta', {seller_id: seller_id}, function(data){
			alert(data);
		});
	}
});