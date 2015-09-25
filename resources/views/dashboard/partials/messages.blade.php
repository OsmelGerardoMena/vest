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

@if(Session::has('add_products'))
 	<div class="alert alert-info" role="alert">
 		<strong>{{ Session::get('add_products') }}</strong>
 	</div>
@endif

@if(Session::has('remove_products'))
 	<div class="alert alert-info" role="alert">
 		<strong>{{ Session::get('remove_products') }}</strong>
 	</div>
@endif

@if(Session::has('restricted_access'))
 	<div class="alert alert-danger" role="alert">
 		<strong>{{ Session::get('restricted_access') }}</strong>
 	</div>
@endif

@if(Session::has('status'))
 	<div class="alert alert-warning" role="alert">
 		<strong>{{ Session::get('status') }}</strong>
 	</div>
@endif

@if(Session::has('disabled'))
 	<div class="alert alert-danger" role="alert">
 		<strong>{{ Session::get('disabled') }}</strong>
 	</div>
@endif

@if(Session::has('file_error'))
 	<div class="alert alert-danger" role="alert">
 		<strong>{{ Session::get('file_error') }}</strong>
 	</div>
@endif

@if(Session::has('error'))
 	<div class="alert alert-danger" role="alert">
 		<strong>{{ Session::get('error') }}</strong>
 	</div>
@endif