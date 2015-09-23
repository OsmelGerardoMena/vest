@inject('products', 'Vest\Services\OptionsSelectProduct')

<div class="form-group">
	{!! Form::label('name', trans('validation.attributes.name'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.name_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('file', trans('validation.attributes.contract_file'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::file('contract_file',  ['class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('product_id', trans('validation.attributes.product'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('product_id', $products->get(), old('product_id'), ['class' => 'form-control']) !!}
	</div>
</div>