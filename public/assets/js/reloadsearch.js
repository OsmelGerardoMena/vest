$(document).ready(function(){

	$('#my-text').click(select_reload);
	$('#my-select').click(text_reload);

	function select_reload(){
		$("#my-select option[value='']").attr("selected",true);
	}

	function text_reload(){
		$('#my-text').val(null);
	}
});