@inject('companies', 'Vest\Services\CompanyProducts')

<h4>@lang('dashboard.title_select_product'):</h4>

<div class="panel-group accordion-toggle" id="accordiondemo">
	@foreach($companies->get() as $company)
		<div class="panel panel-darkblue-2">
			<div class="panel-heading">
		  		<h4 class="panel-title">
		    		<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion{{ $company['id'] }}">
		      			{{ $company['name'] }}
		    		</a>
		  		</h4>
			</div>
	    	<div id="accordion{{ $company['id'] }}" class="panel-collapse collapse">
	      		<div class="panel-body">
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
		</div>
	@endforeach
</div>
