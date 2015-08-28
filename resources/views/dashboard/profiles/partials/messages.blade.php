@if(Session::has('new_user'))
 	<div class="alert alert-info" role="alert">
 		<strong>{{ Session::get('new_user') }}</strong>
 	</div>
@endif

@if(Session::has('edit_user'))
 	<div class="alert alert-info" role="alert">
 		<strong>{{ Session::get('edit_user') }}</strong>
 	</div>
@endif

@if(Session::has('delete_user'))
 	<div class="alert alert-info" role="alert">
 		<strong>{{ Session::get('delete_user') }}</strong>
 	</div>
@endif