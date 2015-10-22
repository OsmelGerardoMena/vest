@inject('categories', 'Vest\Services\OptionsSelectCompanyCategory')

{!! Form::model(Request::all(), 
		[	'route' => 'dashboard.companies.index', 
			'method' => 'GET', 
			'class' => 'form-inline', 
			'rol' => 'search'
		])
!!}
	<div class="form-group">
		<a class="btn btn-info" href="{{route('dashboard.companies.index')}}">
			<i class="icon-eye-1"></i>
			@lang('dashboard.buttons.seeall')
		</a>
	</div>

	<div class="form-group">
		{!! Form::text('company', null, ['class' => 'form-control', 'id' => 'my-text', 'placeholder' => trans('dashboard.ph.search')]) !!}
	</div>

	<div class="form-group">
		{!! Form::select('category', $categories->get(), null, ['class' => 'form-control', 'id' => 'my-select']) !!}
	</div>

	<button type="submit" class="btn btn-info"> 
		<i class="icon-search-1"></i>
		@lang('dashboard.buttons.search')
	</button>
{!! Form::close() !!}