@extends('layout')

@section('title')
	@lang('dashboard.title_create')
@stop

@section('content')

@include('partials/modal')
<!-- Begin page -->
<div id="wrapper">
	@include('partials/topbar')
	@include('partials/sidebar')

	<!-- Start right content -->
	<div class="content-page">

		<!-- Start Content here -->
		<div class="content">
			<div class="page-heading">
            		<h1><i class='icon-user-add'></i> 
            			@lang('dashboard.title_create')
            		</h1>
            </div>

            <div class="widget">
				<div class="widget-content padding">
					@include('partials/errors')
					{!! Form::open([
							'route' => 'dashboard.users.store', 
							'method' => 'POST', 
							'class' => 'form-horizontal',
							'role' => 'form'
						]) 
					!!}
				  		<div class="form-group">
				  			{!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Aqui nombre']) !!}
							</div>
				  		</div>

					  	<div class="form-group">
							{!! Form::label('email', 'E-mail', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Aqui e-mail']) !!}
							</div>
					  	</div>

					  	<div class="form-group">
							{!! Form::label('identifier', 'Identifier', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::text('identifier', null, ['class' => 'form-control', 'placeholder' => 'Aqui identificador']) !!}
							</div>
					  	</div>

					  	<div class="form-group">
							{!! Form::label('mobile', 'Mobile Number', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Aqui numero movil']) !!}
							</div>
					  	</div>

					  	<div class="form-group">
							{!! Form::label('phone', 'Phone Number', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Aqui telefono fijo']) !!}
							</div>
					  	</div>

					  	<div class="form-group">
							{!! Form::label('address', 'Address', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Aqui direccion']) !!}
							</div>
					  	</div>

					  	<div class="form-group">
							{!! Form::label('type_id', 'Profile', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::select('type', ['' => '', '1' => 'Admin', '2' => 'Seller'], old('type_id'), ['class' => 'form-control']) !!}
							</div>
					  	</div>

					  	<div class="form-group">
							{!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Aqui Contraseña']) !!}
							</div>
					  	</div>

					  	<div class="form-group">
							{!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Repetir Contraseña']) !!}
							</div>
					  	</div>

					  	 <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-plus-circle"></i>
									Create
								</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>

		</div>
		<!-- End content here -->
	
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection