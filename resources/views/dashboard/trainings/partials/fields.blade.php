@inject('products', 'Vest\Services\OptionsSelectProduct')

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

<div class="form-group">
	{!! Form::label('file', trans('validation.attributes.training_file'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::file('training_file',  ['class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">@lang('dashboard.content')</label>
	<div class="col-sm-10">
		<textarea class="summernote" name="content">@if(old('content')){{ old('content') }}@elseif(isset($training)){{ html_entity_decode($training->content) }}@else<p><br></p>@endif</textarea>
	</div>
</div>