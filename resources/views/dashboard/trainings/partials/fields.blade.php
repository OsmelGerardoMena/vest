@inject('products', 'Vest\Services\OptionsSelectProduct')

<div class="form-group">
	{!! Form::label('url', trans('validation.attributes.url'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.url_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('date', trans('validation.attributes.date'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::date('date', null, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('product_id', trans('validation.attributes.product'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('product_id', $products->get(), old('product_id'), ['class' => 'form-control']) !!}
	</div>
</div>