<div class="form-group">
	{!! Form::label('name', trans('validation.attributes.name'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.tradename_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('address', trans('validation.attributes.address'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.address_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('identifier', trans('validation.attributes.identifier'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('identifier', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.identi_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('city', trans('validation.attributes.city'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.city_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('province', trans('validation.attributes.province'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('province', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.province_here')]) !!}
	</div>
</div>