@can('admin')
	@inject('products', 'Vest\Services\OptionsSelectProduct')
@else
	@inject('products', 'Vest\Services\OptionsSelectCompanyProducts')
@endcan

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
		@can('admin')
			{!! Form::select('product_id', $products->get(), null, ['class' => 'form-control']) !!}
		@else
			{!! Form::select('product_id', $products->get(Auth::user()->id), null, ['class' => 'form-control']) !!}
		@endcan
	</div>
</div>