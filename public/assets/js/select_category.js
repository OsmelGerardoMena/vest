$(document).ready(function(){

	// se verifica si el select del perfil ya posee la opcion con el id = 3
	// esto sirve para cuando se va a editar un usuario, o cuando se recarga la 
	// pagina y se necesita que muestre los valores que ya posee ese usuario
	if( $('select#select-profile').val() == 3 ) {
		$('div.select-category').show();
	}
	else{
		$('div.select-category').hide();
	}

	$('select#select-profile').on('change', function(){
		// se coloca el select de categoria en blanco
		$("select#select-category option[value='']").attr("selected", true);

		// si el profile es empresa, se desglosa el select de categoria
		if( $('select#select-profile').val() == 3 ) {
			$('div.select-category').slideDown();
			// tambien se puede usar:
			// css('display', 'block')
			// fadeIn()
			// show()
		}
		else{ // si no, se esconde
			$('div.select-category').slideUp();
			// tambien se puede usar:
			// css('display', 'none')
			// fadeOut()
			// hide()
		}
	});
});