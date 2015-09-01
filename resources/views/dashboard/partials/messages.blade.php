@if(Session::has('new'))
 	<div class="alert alert-info" role="alert">
 		<strong>{{ Session::get('new') }}</strong>
 	</div>
@endif

@if(Session::has('edit'))
 	<div class="alert alert-info" role="alert">
 		<strong>{{ Session::get('edit') }}</strong>
 	</div>
@endif

@if(Session::has('delete'))
 	<div class="alert alert-info" role="alert">
 		<strong>{{ Session::get('delete') }}</strong>
 	</div>
@endif

@if(Session::has('no_submodule'))
 	<div class="alert alert-danger" role="alert">
 		<strong>{{ Session::get('no_submodule') }}</strong>
 	</div>
@endif