$(document).ready(function(){

	// Para vistas cuyo buscador tiene un campo de texto y un solo select
	$('#my-text').click(select_reload);
	$('#my-select').click(text_reload);

	function select_reload(){
		$("#my-select option[value='']").attr("selected", true);
	}
	function text_reload(){
		$('#my-text').val(null);
	}

	// Para vistas Productos, donde hay un text y dos select
	$('#text-name').click(restart_company_category);
	$('#select-company').click(restart_name_category);
	$('#select-category').click(restart_name_company);

	function restart_company_category(){
		$("#select-company option[value='']").attr("selected", true);
		$("#select-category option[value='']").attr("selected", true);
	}
	function restart_name_category(){
		$('#text-name').val(null);
		$("#select-category option[value='']").attr("selected", true);
	}
	function restart_name_company(){
		$('#text-name').val(null);
		$("#select-company option[value='']").attr("selected", true);
	}

	// Para vista Ventas, donde hay 3 selectores
	$('#select-seller').click(select_reload1);
	$('#select-product').click(select_reload2);
	$('#select-customer').click(select_reload3);

	function select_reload1(){
		$("#select-product option[value='']").attr("selected", true);
		$("#select-customer option[value='']").attr("selected", true);
	}
	function select_reload2(){
		$("#select-seller option[value='']").attr("selected", true);
		$("#select-customer option[value='']").attr("selected", true);
	}
	function select_reload3(){
		$("#select-seller option[value='']").attr("selected", true);
		$("#select-product option[value='']").attr("selected", true);
	}
});