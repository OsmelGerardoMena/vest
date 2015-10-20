<div class="form-group">
	{!! Form::label('name', trans('validation.attributes.name'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.name_here')]) !!}
	</div>
</div>