@inject('options', 'Vest\Services\OptionsSelectCompany')
@inject('categories', 'Vest\Services\OptionsSelectCompanyCategory')

{!! Form::model(Request::all(), 
		[	'route' => 'dashboard.products.index', 
			'method' => 'GET', 
			'class' => 'form-inline', 
			'rol' => 'search'
		])
!!}


	<div class="form-group">
		<a class="btn btn-info" href="{{route('dashboard.products.index')}}">
			<i class="icon-eye-1"></i>
			@lang('dashboard.buttons.seeall')
		</a>
	</div>

	<div class="form-group">
		{!! Form::text('name', null, ['class' => 'form-control', 'id' => 'text-name', 'placeholder' => trans('dashboard.ph.search_product')]) !!}
	</div>

	<div class="form-group">
		{!! Form::select('company', $options->get(), null, ['class' => 'form-control', 'id' => 'select-company']) !!}
	</div>

	<div class="form-group">
		{!! Form::select('category', $categories->get(), null, ['class' => 'form-control', 'id' => 'select-category']) !!}
	</div>

	<button type="submit" class="btn btn-info"> 
		<i class="icon-search-1"></i>
		@lang('dashboard.buttons.search')
	</button>

{!! Form::close() !!}