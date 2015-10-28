
@inject('customers', 'Vest\Services\OptionsSelectCustomer')

@can('seller')
	{!! Form::hidden('seller_id', Auth::user()->id, ['id' => 'selected-seller']) !!}
@endcan

@can('admin')
	@inject('sellers', 'Vest\Services\OptionsSelectSeller')
	<div class="form-group">
		{!! Form::label('seller_id', trans('validation.attributes.seller_id'), ['class' => 'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::select('seller_id', $sellers->get('true'), null, ['class' => 'form-control', 'id' => 'selected-seller']) !!}
		</div>
	</div>
@endcan

<div class="form-group">
	{!! Form::label('product_id', trans('validation.attributes.product'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('product_id', $firts_option, null, ['class' => 'form-control', 'id' => 'selected-product']) !!}
	</div>
</div>{!! Form::hidden('firts_option', $firts_option[''], ['id' => 'firts_option']) !!}

<div class="form-group">
	{!! Form::label('customer_id', trans('validation.attributes.customer_id'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('customer_id', $customers->get('true'), null, ['class' => 'form-control']) !!}
	</div>
</div>