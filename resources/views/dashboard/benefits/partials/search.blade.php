@can('admin')
	@inject('products', 'Vest\Services\OptionsSelectProduct')
@else
	@inject('products', 'Vest\Services\OptionsSelectCompanyProducts')
@endcan

{!! Form::model(Request::all(), 
		[	'route' => 'dashboard.benefits.index', 
			'method' => 'GET', 
			'class' => 'form-inline', 
			'rol' => 'search'
		])
!!}
	<div class="form-group">
		<a class="btn btn-info" href="{{route('dashboard.benefits.index')}}">
			<i class="icon-eye-1"></i>
			@lang('dashboard.buttons.seeall')
		</a>
	</div>

	<div class="form-group">
		@can('admin')
			{!! Form::select('product', $products->get(), null, ['class' => 'form-control']) !!}
		@else
			{!! Form::select('product', $products->get(Auth::user()->id), null, ['class' => 'form-control']) !!}
		@endcan
	</div>
	
	<button type="submit" class="btn btn-info"> 
		<i class="icon-search-1"></i>
		@lang('dashboard.buttons.search')
	</button>
{!! Form::close() !!}