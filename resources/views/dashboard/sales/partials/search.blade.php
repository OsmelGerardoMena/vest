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
			<table>
				<tr><td>
					<center><strong>@lang('dashboard.table.sellers')</strong></center>
				</td></tr>
				<tr><td>
					{!! Form::select('seller', $sellers->get(), null, 
					['class' => 'form-control', 'id' => 'select-seller']) !!}
				</td></tr>
			</table>
		</div>
	@endcan

	<div class="form-group">
		<table>
			<tr><td>
				<center><strong>@lang('dashboard.table.products')</strong></center>
			</td></tr>
			<tr><td>
			@can('company')
				{!! Form::select('product', $products->get(Auth::user()->id), null, 
					['class' => 'form-control', 'id' => 'select-product']) !!}
			@else
				{!! Form::select('product', $products->get(), null, 
					['class' => 'form-control', 'id' => 'select-product']) !!}
			@endcan
			</td></tr>
		</table>
	</div>

	<div class="form-group">
		<table>
			<tr><td>
				<center><strong>@lang('dashboard.table.customers')</strong></center>
			</td></tr>
			<tr><td>
				{!! Form::select('customer', $customers->get(), null, 
					['class' => 'form-control', 'id' => 'select-customer']) !!}
			</td></tr>
		</table>
	</div>

	<button type="submit" class="btn btn-info"> 
		<i class="icon-search-1"></i>
		@lang('dashboard.buttons.search')
	</button>
{!! Form::close() !!}