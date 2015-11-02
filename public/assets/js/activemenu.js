$(document).ready(function(){
	
	var url = window.location.pathname.substring(1);
	//console.log(url.search('dashboard'));

	/*$('#start-link').on('click', function(){
		$(this).addClass('active');
	});*/

	// search() busca la posicion de una cadena, devuelve -1 si no se encuentra
	// si devuelvo algo distinto de -1 significa que si existe coincidencia
	// url.search('dashboard') != -1

	if(url == 'dashboard'){
		$('#start-link').addClass('active');
	}
	if(url == 'dashboard/users'){
		$('#user-link').addClass('active');
	}
	if(url == 'dashboard/users/create'){
		$('#user-link').addClass('active');
	}
	
});