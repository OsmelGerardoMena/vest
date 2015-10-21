@inject('categories', 'Vest\Services\OptionsSelectCompanyCategory')

<div class="form-group">
	{!! Form::label('category', trans('validation.attributes.category'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('category', $categories->get(), null, ['class' => 'form-control']) !!}
	</div>
</div>