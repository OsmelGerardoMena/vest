$(document).ready(function(){

	if( $('select#select-profile').val() == 3 ) {
		$('div.select-category').show();
	}
	else{
		$('div.select-category').hide();
	}

	$('select#select-profile').on('change', function(){

		if( $('select#select-profile').val() == 3 ) {
			$('div.select-category').slideDown();
			// tambien se puede usar:
			// css('display', 'block')
			// fadeIn()
			// show()
		}
		else{
			$('div.select-category').slideUp();
			// tambien se puede usar:
			// css('display', 'none')
			// fadeOut()
			// hide()
		}
	});
});