@inject('sellers', 'Vest\Services\OptionsSelectSeller')
@inject('customers', 'Vest\Services\OptionsSelectCustomer')

@can('company')
	@inject('products', 'Vest\Services\OptionsSelectCompanyProducts')
@else
	@inject('products', 'Vest\Services\OptionsSelectProduct')
@endcan

{!! Form::model(Request::all(), 
		[	'route' => 'dashboard.sales.index', 
			'method' => 'GET', 
			'class' => 'form-inline', 
			'rol' => 'search'
		])
!!}

	<div class="form-group">
		<a class="btn btn-info" href="{{route('dashboard.sales.index')}}">
			<i class="icon-eye-1"></i>
			@lang('dashboard.buttons.seeall')
		</a>
	</div>
	
	@cannot('seller')
		<div class="form-group">
			{!! Form::select('seller', $sellers->get(), null, 
			['class' => 'form-control', 'id' => 'select-seller']) !!}
		</div>
	@endcan

	<div class="form-group">
		@can('company')
			{!! Form::select('product', $products->get(Auth::user()->id), null, 
				['class' => 'form-control', 'id' => 'select-product']) !!}
		@else
			{!! Form::select('product', $products->get(), null, 
				['class' => 'form-control', 'id' => 'select-product']) !!}
		@endcan
	</div>

	<div class="form-group">
		{!! Form::select('customer', $customers->get(), null, 
			['class' => 'form-control', 'id' => 'select-customer']) !!}
	</div>

	<button type="submit" class="btn btn-info"> 
		<i class="icon-search-1"></i>
		@lang('dashboard.buttons.search')
	</button>
{!! Form::close() !!}