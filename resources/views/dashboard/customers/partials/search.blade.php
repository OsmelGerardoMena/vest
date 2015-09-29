{!! Form::model(Request::all(), 
		[	'route' => 'dashboard.customers.index', 
			'method' => 'GET', 
			'class' => 'form-inline', 
			'rol' => 'search'
		])
!!}
	<div class="form-group">
		<a class="btn btn-info" href="{{route('dashboard.customers.index')}}">
			<i class="icon-eye-1"></i>
			@lang('dashboard.buttons.seeall')
		</a>
	</div>

	<div class="form-group">
		{!! Form::text('name', null, [
				'class' => 'form-control', 
				'placeholder' => trans('dashboard.ph.search_name')]) 
		!!}
	</div>

	<button type="submit" class="btn btn-info"> 
		<i class="icon-search-1"></i>
		@lang('dashboard.buttons.search')
	</button>
{!! Form::close() !!}