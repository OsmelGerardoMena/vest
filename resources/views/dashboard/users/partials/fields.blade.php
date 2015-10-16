@inject('options', 'Vest\Services\OptionsSelectProfile')

<div class="form-group">
	{!! Form::label('name', trans('validation.attributes.name'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.name_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('email', trans('validation.attributes.email'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.email_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('identifier', trans('validation.attributes.identifier'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('identifier', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.identi_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('mobile', trans('validation.attributes.mobile'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.mobile_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('phone', trans('validation.attributes.phone'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.phone_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('address', trans('validation.attributes.address'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.address_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('type_id', trans('validation.attributes.profile'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('type_id', $options->get(), old('type_id'), ['class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('password', trans('validation.attributes.password'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.pass_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('password_confirmation', trans('validation.attributes.password_confirmation'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.repeatpass_here')]) !!}
	</div>
</div>