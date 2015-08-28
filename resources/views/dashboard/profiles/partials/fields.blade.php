@inject('modules', 'Vest\Services\AllModules')

<div class="form-group">
	{!! Form::label('name', trans('validation.attributes.name'), ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.name_here')]) !!}
	</div>
</div>
<hr>
@foreach($modules->get() as $module)
	<div class="form-group">
		<div class="col-sm-2 control-label">
			<strong>
				@lang('dashboard.sidebar.'.$module['description'])
			</strong>
		</div>
		<div class="col-sm-10">
			@foreach($module['submodule'] as $submodule)
				{!! Form::checkbox($submodule['description'], $submodule['id']) !!}
				@lang('dashboard.sidebar.'.$submodule['description'])
			@endforeach
		</div>
	</div>
	<hr>
@endforeach