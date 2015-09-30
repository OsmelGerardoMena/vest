// Para selectores de la vista ventas
$('#select-seller').click(select_reload1);
$('#select-product').click(select_reload2);
$('#select-customer').click(select_reload3);

function select_reload1(){
	$("#select-product option[value='']").attr("selected",true);
	$("#select-customer option[value='']").attr("selected",true);
}
function select_reload2(){
	$("#select-seller option[value='']").attr("selected",true);
	$("#select-customer option[value='']").attr("selected",true);
}
function select_reload3(){
	$("#select-seller option[value='']").attr("selected",true);
	$("#select-product option[value='']").attr("selected",true);
}