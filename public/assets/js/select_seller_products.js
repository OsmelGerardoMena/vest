$(document).ready(function(){

	function optionsSelect(){
		// se almacena el valor del select vendedor
		var seller_id = $('#selected-seller').val();
		// se verifica que no esté en blanco
		if ($.trim(seller_id) != '') {
			// se envia el id del vendedor a la ruta dashboard/sales/seller
			$.get('seller', {id: seller_id}, function(products){
				// se recibe los productos del vendedor desde el controlador
				// se limpia primero el select
				$('select#selected-product').empty();
				$('select#selected-product').append("<option value=''>" + $('#firts_option').val() + "</option>");
				// se recorre el array y se agregan al select producto
				$.each(products, function(index, value){
					$('select#selected-product').append("<option value='" + index + "'>" + value + "</option>");
				});
			});
		}
	}

	// se ejecuta la funcion optionsSelect(), en caso de que se recargue 
	// la pagina y se necesite los valores ya seleccionados
	optionsSelect();

	// se ejecutara optionsSelect() cuando hay un cambio en el select de vendedor
	$('#selected-seller').on('change', optionsSelect);
});