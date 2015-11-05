@can('admin')
	@inject('products', 'Vest\Services\OptionsSelectProduct')
@else
	@inject('products', 'Vest\Services\OptionsSelectCompanyProducts')
@endcan

@inject('itypes', 'Vest\Services\OptionsSelectIncentiveTypes')

<div class="form-group">
	{!! Form::label('goal', trans('validation.attributes.goal'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('goal', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.goal_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('incentive_type_id', trans('validation.attributes.incentive_type_id'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('incentive_type_id', $itypes->get(), null, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('award', trans('validation.attributes.award'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('award', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.award_here')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('file', trans('validation.attributes.img'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::file('img',  ['class' => 'btn btn-default', 'title' => trans('dashboard.ph.select_img')]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('date_from', trans('validation.attributes.date_from'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::date('date_from', null, ['class' => 'form-control', 'min' => $today]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('date_to', trans('validation.attributes.date_to'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::date('date_to', null, ['class' => 'form-control', 'min' => $today]) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('product_id', trans('validation.attributes.product'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		@can('admin')
			{!! Form::select('product_id', $products->get(false, true), old('product_id'), ['class' => 'form-control']) !!}
		@else
			{!! Form::select('product_id', $products->get(), old('product_id'), ['class' => 'form-control']) !!}
		@endcan
	</div>
</div>