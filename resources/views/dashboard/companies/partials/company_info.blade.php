<div class="panel-group accordion-toggle" id="accordiondemo">
	<div class="panel panel-darkblue-2">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	  			<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion-info">
	      			<i class='icon-info-circled'></i>
	      			<strong>@lang('dashboard.title_company_info')</strong>
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
								<td>{{ $company->email }}</td>
								<td>{{ $company->identifier }}</td>
								<td>{{ $company->mobile }}</td>
								<td>{{ $company->phone }}</td>
								<td>{{ $company->address }}</td>
								<td><span class="{{ ($company->status->id == 1) ? 'label label-success' : 'label label-danger'}}">
									{{ trans('dashboard.status.'.$company->status->id) }}
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