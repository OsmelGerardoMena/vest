@inject('options', 'Vest\Services\OptionsSelectCompany')

<div class="form-group">
	{!! Form::label('name', trans('validation.attributes.name'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.name_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('company_id', trans('validation.attributes.company'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('company_id', $options->get(), old('company_id'), ['class' => 'form-control']) !!}
	</div>
</div>

{!! Form::hidden('creator_id', Auth::user()->id, ['class' => 'form-control']) !!}
