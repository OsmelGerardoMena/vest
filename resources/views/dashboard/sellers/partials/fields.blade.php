@inject('companies', 'Vest\Services\Companies')

<h4>@lang('dashboard.title_select_product'):</h4>

<div class="panel-group accordion-toggle" id="accordiondemo">
	<div class="panel panel-darkblue-2">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	    		<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion">
	      			@lang('dashboard.title_companies')
	    		</a>
	  		</h4>
		</div>
    	<div id="accordion" class="panel-collapse collapse-in">
      		<div class="panel-body">
      			<div class="alert alert-warning" role="alert">
 					<strong>@lang('messages.company_products')</strong>
 				</div>
	      		@foreach($companies->get() as $company)
	        		@if($seller->companyExists($company->id))
						{!! Form::checkbox($company->name, $company->id, true) !!}
					@else
						{!! Form::checkbox($company->name, $company->id) !!}
					@endif
					{{ $company->name }}<br>
				@endforeach
      		</div>
    	</div>
	</div>
</div>