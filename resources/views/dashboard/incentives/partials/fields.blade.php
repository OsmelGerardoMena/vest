@can('admin')
	@inject('products', 'Vest\Services\OptionsSelectProduct')
@else
	@inject('products', 'Vest\Services\OptionsSelectCompanyProducts')
@endcan

<div class="form-group">
	{!! Form::label('goal', trans('validation.attributes.goal'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('goal', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.goal_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('award', trans('validation.attributes.award'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('award', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.award_here')]) !!}
	</div>
</div>

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
		@can('admin')
			{!! Form::select('product_id', $products->get(), old('product_id'), ['class' => 'form-control']) !!}
		@else
			{!! Form::select('product_id', $products->get(Auth::user()->id), old('product_id'), ['class' => 'form-control']) !!}
		@endcan
	</div>
</div>