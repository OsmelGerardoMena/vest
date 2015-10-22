@inject('sellers', 'Vest\Services\OptionsSelectSeller')
@inject('products', 'Vest\Services\OptionsSelectProduct')
@inject('customers', 'Vest\Services\OptionsSelectCustomer')

<div class="form-group">
	{!! Form::label('seller_id', trans('validation.attributes.seller_id'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('seller_id', $sellers->get('true'), null, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('product_id', trans('validation.attributes.product'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('product_id', $products->get('true'), null, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('customer_id', trans('validation.attributes.customer_id'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('customer_id', $customers->get('true'), null, ['class' => 'form-control']) !!}
	</div>
</div>