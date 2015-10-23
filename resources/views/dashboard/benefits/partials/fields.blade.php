@can('admin')
	@inject('products', 'Vest\Services\OptionsSelectProduct')
@else
	@inject('products', 'Vest\Services\OptionsSelectCompanyProducts')
@endcan

@inject('types', 'Vest\Services\OptionsSelectBenefitTypes')

<div class="form-group">
	{!! Form::label('benefit_type_id', trans('validation.attributes.benefit_type_id'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('benefit_type_id', $types->get(), null, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('amount', trans('validation.attributes.amount'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.amount_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('product_id', trans('validation.attributes.product'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
	@can('admin')
		{!! Form::select('product_id', $products->get(), null, ['class' => 'form-control']) !!}
	@else
		{!! Form::select('product_id', $products->get(Auth::user()->id), null, ['class' => 'form-control']) !!}
	@endcan
	</div>
</div>