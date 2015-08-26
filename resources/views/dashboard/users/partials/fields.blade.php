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
		{!! Form::select('type_id', ['' => '', '1' => 'Admin', '2' => 'Seller'], old('type_id'), ['class' => 'form-control']) !!}
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