@inject('options', 'Vest\Services\OptionsSelectCompany')

<div class="form-group">
	{!! Form::label('name', trans('validation.attributes.name'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.name_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('price', trans('validation.attributes.price'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.price_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('url', trans('validation.attributes.url'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.presentation_link')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('company_id', trans('validation.attributes.company'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('company_id', $options->get(), old('company_id'), ['class' => 'form-control']) !!}
	</div>
</div>

{!! Form::hidden('creator', Auth::user()->name, ['class' => 'form-control']) !!}
