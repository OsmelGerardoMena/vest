@inject('customers', 'Vest\Services\OptionsSelectCustomer')

@can('admin')
	@inject('sellers', 'Vest\Services\OptionsSelectSeller')
	@inject('products', 'Vest\Services\OptionsSelectProduct')
@endcan

@can('company')
	@inject('products', 'Vest\Services\OptionsSelectCompanyProducts')
@endcan

@can('seller')
	@inject('products', 'Vest\Services\OptionsSelectSellerProducts')
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
	
	@can('admin')
		<div class="form-group">
			{!! Form::select('seller', $sellers->get(), null, 
			['class' => 'form-control', 'id' => 'select-seller']) !!}
		</div>
	@endcan

	<div class="form-group">
		{!! Form::select('product', $products->get(), null, 
			['class' => 'form-control', 'id' => 'select-product']) !!}
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