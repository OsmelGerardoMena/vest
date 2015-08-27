@inject('options', 'Vest\Services\OptionsSelect')

{!! Form::model(Request::all(), 
		[	'route' => 'dashboard.users.index', 
			'method' => 'GET', 
			'class' => 'form-inline', 
			'rol' => 'search'
		])
!!}
	<div class="form-group">
		<a class="btn btn-info" href="{{route('dashboard.users.index')}}">
			<i class="icon-eye-1"></i>
			@lang('dashboard.buttons.seeall')
		</a>
	</div>

	<div class="form-group">
		{!! Form::text('namemail', null, ['class' => 'form-control', 'id' => 'my-text', 'placeholder' => trans('dashboard.ph.search')]) !!}
	</div>

	<div class="form-group">
		{!! Form::select('type', $options->get(), null, ['class' => 'form-control', 'id' => 'my-select']) !!}
	</div>

	<button type="submit" class="btn btn-info"> 
		<i class="icon-search-1"></i>
		@lang('dashboard.buttons.search')
	</button>
{!! Form::close() !!}