@inject('companies', 'Vest\Services\CompanyProducts')

<h4>@lang('dashboard.title_select_product')</h4>
<hr>
@foreach($companies->get() as $company)
	<div class="form-group">
		<div class="col-sm-4 control-label">
			<strong>
				{{ $company['name'] }}
			</strong>
		</div>
		<div class="col-sm-8">
			@foreach($company['products'] as $product)
				@if($seller->productExists($product['id']))
					{!! Form::checkbox($product['name'], $product['id'], true) !!}
				@else
					{!! Form::checkbox($product['name'], $product['id']) !!}
				@endif
				{{ $product['name'] }}<br>
			@endforeach

		</div>
	</div>
	<hr>
@endforeach