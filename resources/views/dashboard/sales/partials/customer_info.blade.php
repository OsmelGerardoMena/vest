<div class="panel-group accordion-toggle" id="accordiondemo">
	<div class="panel panel-darkblue-2">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	  			<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion-customer">
	      			<i class='icon-smiley-circled'></i>
	      			<strong>@lang('dashboard.title_customer_info')</strong>
	    		</a>
	  		</h4>
		</div>
    	<div id="accordion-customer" class="panel-collapse collapse">
      		<div class="panel-body">
	      		<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead>
							<tr>
								<th>@lang('dashboard.table.name')</th>
								<th>@lang('dashboard.table.address')</th>
								<th>@lang('dashboard.table.identifier')</th>
								<th>@lang('dashboard.table.city')</th>
								<th>@lang('dashboard.table.state')</th>
								<th>@lang('dashboard.table.status')</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $sale->customer->name }}</td>
								<td>{{ $sale->customer->address }}</td>
								<td>{{ $sale->customer->identifier }}</td>
								<td>{{ $sale->customer->city }}</td>
								<td>{{ $sale->customer->state }}</td>
								<td><span class="{{ ($sale->customer->getStatus()) ? 'label label-success' : 'label label-danger'}}">
									{{ trans('dashboard.link_status.'.$sale->customer->getStatus()) }}
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