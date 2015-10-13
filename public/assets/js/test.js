$('select#selected-seller').on('change', function(){

	var seller_id = $('#selected-seller').val();
	
	if ($.trim(seller_id) != '') {

		/*$.post("seller", {seller: seller_id}, function(data){
			alert('dfsdfdsggggggg');
		});*/
	}
});