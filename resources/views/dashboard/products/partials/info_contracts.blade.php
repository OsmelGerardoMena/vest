<div class="panel-group accordion-toggle" id="accordiondemo">
	<div class="panel panel-darkblue-2">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	  			<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion-contracts">
	      			<i class='icon-docs'></i>
	      			@lang('dashboard.title_contracts')
	    		</a>
	  		</h4>
		</div>
    	<div id="accordion-contracts" class="panel-collapse collapse">
      		<div class="panel-body">
	      		<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead>
							<tr>
								<th>@lang('dashboard.table.name')</th>
								<th>@lang('dashboard.table.url')</th>
								<th>@lang('dashboard.table.go')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($product->contracts as $contract)
							<tr>
								<td>{{$contract->name}}</td>
								<td>{{$contract->url}}</td>
								<td>
									<div class="btn-group btn-group-xs">
										<a data-toggle="tooltip" title="@lang('dashboard.buttons.go')" class="btn btn-info" 
											href="{{route('dashboard.contracts.edit', $contract->id)}}">
											<i class="glyphicon glyphicon-arrow-left"></i>
										</a>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
      		</div>
    	</div>
	</div>
</div>