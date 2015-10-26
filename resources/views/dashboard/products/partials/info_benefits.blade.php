<div class="panel-group accordion-toggle" id="accordiondemo">
	<div class="panel panel-darkblue-2">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	  			<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion-benefits">
	      			<i class='fa fa-thumbs-o-up'></i>
	      			@lang('dashboard.title_benefits')
	    		</a>
	  		</h4>
		</div>
    	<div id="accordion-benefits" class="panel-collapse collapse">
      		<div class="panel-body">
	      		<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead>
							<tr>
								<th>@lang('dashboard.table.benefit_type')</th>
								<th>@lang('dashboard.table.amount')</th>
								<th>@lang('dashboard.table.admin_amount')</th>
								@can('admin')
									<th>@lang('dashboard.table.actions')</th>
								@endcan
							</tr>
						</thead>
						<tbody>
							@foreach($product->benefits as $benefit)
							<tr>
								<td>{{ $benefit->type->name }}</td>
								<td>{{ $benefit->amount }}</td>
								<td>{{ $benefit->admin_amount }}</td>
								@can('admin')
									<td>
										<div class="btn-group btn-group-xs">
											<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit_delete')" class="btn btn-warning" 
												href="{{route('dashboard.benefits.edit', $benefit->id)}}">
												<i class="fa fa-edit"></i>
											</a>
										</div>
									</td>
								@endcan
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
      		</div>
    	</div>
	</div>
</div>