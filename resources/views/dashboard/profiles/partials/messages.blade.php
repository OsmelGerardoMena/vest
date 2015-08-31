@if(Session::has('new_profile'))
 	<div class="alert alert-info" role="alert">
 		<strong>{{ Session::get('new_profile') }}</strong>
 	</div>
@endif

@if(Session::has('no_submodule'))
 	<div class="alert alert-danger" role="alert">
 		<strong>{{ Session::get('no_submodule') }}</strong>
 	</div>
@endif

@if(Session::has('edit_profile'))
 	<div class="alert alert-info" role="alert">
 		<strong>{{ Session::get('edit_profile') }}</strong>
 	</div>
@endif

@if(Session::has('delete_profile'))
 	<div class="alert alert-info" role="alert">
 		<strong>{{ Session::get('delete_profile') }}</strong>
 	</div>
@endif