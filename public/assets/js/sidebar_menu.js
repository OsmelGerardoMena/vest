$(document).ready(function(){
	var url = window.location.pathname.substring(1);
	// search() busca la posicion de una cadena, devuelve -1 si no se encuentra
	// si devuelvo algo distinto de -1 significa que si existe coincidencia
	// url.search('dashboard') != -1
	if (url.search('users') != -1 || url.search('sellers') != -1) {
		$('a#user').addClass('active');
	}

	if (url.search('company-categories') != -1) {
		$('a#category').addClass('active');
	}
	
	if (url == 'dashboard' || 
			url.search('account') != -1 || 
			url.search('help') != -1 || 
			url.search('notifications') != -1) {
		$('a#start').addClass('active');
	}

	if (url.search('dashboard/products') != -1 ||
			url.search('contracts') != -1 || 
			url.search('benefits') != -1 || 
			url.search('incentives') != -1 || 
			url.search('trainings') != -1 ||
			url.search('categories-and-companies') != -1) {
		$('a#product').addClass('active');
	}

	if (url.search('customers') != -1) {
		$('a#customer').addClass('active');
	}

	if (url.search('sales') != -1) {
		$('a#sale').addClass('active');
	}

	if (url.search('my-products') != -1 || 
			url.search('contracts') != -1 || 
			url.search('benefits') != -1 || 
			url.search('incentives') != -1 || 
			url.search('trainings') != -1) {
		$('a#my-product').addClass('active');
	}

	if (url.search('dashboard/companies') != -1) {
		// cuando es esta ruta, se verifica si en boton oculto en el topbar
		// contiene true o false, es decir, si es admin o no
		if ($('#user-is-admin').val()) {
			// si es un admin el usuario, se activa el modulo user
			$('a#user').addClass('active');
		}
		else {
			// si no es un admin el usuario, se activa el modulo product
			$('a#product').addClass('active')
		}
	}
});