$(document).ready(function(){

	var seller_id = $('#selected-seller').val();

	$('select#selected-seller').on('change', function(){

		var seller_id = $('#selected-seller').val();

		if ($.trim(seller_id) != '') {
			$.get('seller', {id: seller_id}, function(products){
				$.each(products, function(index, value){
					$('#selected-product').append("<option value='" + index + "'>" + value + "</option>");
				});
			});
		}
	});
});