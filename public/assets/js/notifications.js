$(document).ready(function(){
	$.get('/dashboard/notifications/ajax', function(notifications){
		// se coloca el contador de las notificaciones no leidas
		$('#noti-count').text(notifications.length);
		// si la cantidad de elementos es distinta de cero, se limpia para quitar
		// el mensaje de 'No existen a notificaciones nuevas'
		if (notifications.length != 0) { $('.unread').empty(); }
		notifications.forEach(item => {
			// luego se colocan los titulos de las notificaiones y parte del contenido
			$('.unread').append(`<a href="/dashboard/notifications/show/${item.id}"><p><strong>${item.title}</strong><br><i>${item.content.slice(0,50)} ...</i></p></a>`);
		});
	});
});