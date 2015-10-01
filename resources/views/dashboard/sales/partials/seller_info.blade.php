<div class="panel-group accordion-toggle" id="accordiondemo">
	<div class="panel panel-darkblue-2">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	  			<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion-seller">
	      			<i class='icon-suitcase'></i>
	      			<strong>@lang('dashboard.title_seller_info')</strong>
	    		</a>
	  		</h4>
		</div>
    	<div id="accordion-seller" class="panel-collapse collapse">
      		<div class="panel-body">
	      		<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead>
							<tr>
								<th>@lang('dashboard.table.name')</th>
								<th>@lang('dashboard.table.email')</th>
								<th>@lang('dashboard.table.identifier')</th>
								<th>@lang('dashboard.table.mobile')</th>
								<th>@lang('dashboard.table.phone')</th>
								<th>@lang('dashboard.table.address')</th>
								<th>@lang('dashboard.table.status')</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $sale->seller->name }}</td>
								<td>{{ $sale->seller->email }}</td>
								<td>{{ $sale->seller->identifier }}</td>
								<td>{{ $sale->seller->mobile }}</td>
								<td>{{ $sale->seller->phone }}</td>
								<td>{{ $sale->seller->address }}</td>
								<td><span class="{{ ($sale->seller->isActive()) ? 'label label-success' : 'label label-danger'}}">
									{{ trans('dashboard.status.'.$sale->seller->getStatusId()) }}
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
      		</div>
    	</div>
	</div>
</div>