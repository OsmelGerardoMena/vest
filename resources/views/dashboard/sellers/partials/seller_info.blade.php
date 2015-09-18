<div class="panel-group accordion-toggle" id="accordiondemo">
	<div class="panel panel-darkblue-2">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	  			<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion-info">
	      			<i class='icon-info-circled'></i>
	      			<strong>@lang('dashboard.title_seller_info')</strong>
	    		</a>
	  		</h4>
		</div>
    	<div id="accordion-info" class="panel-collapse collapse">
      		<div class="panel-body">
	      		<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead>
							<tr>
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
								<td>{{ $seller->email }}</td>
								<td>{{ $seller->identifier }}</td>
								<td>{{ $seller->mobile }}</td>
								<td>{{ $seller->phone }}</td>
								<td>{{ $seller->address }}</td>
								<td><span class="{{ ($seller->isActive()) ? 'label label-success' : 'label label-danger'}}">
									{{ trans('dashboard.status.'.$seller->getStatusId()) }}
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