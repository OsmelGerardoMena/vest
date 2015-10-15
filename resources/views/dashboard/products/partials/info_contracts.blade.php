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
								<th>@lang('dashboard.table.file')</th>
								@can('admin')
									<th>@lang('dashboard.table.actions')</th>
								@endcan
							</tr>
						</thead>
						<tbody>
							@foreach($product->contracts as $contract)
							<tr>
								<td>{{$contract->name}}</td>

								@if($contract->hasFile())
									<td><a href="{{ asset('files/contracts') }}/{{ $contract->contract_file }}" target="_blank">
										@lang('dashboard.download_contract')
									</a></td>
								@else
									<td>@lang('dashboard.not_found')</td>
								@endif

								@can('admin')
									<td>
										<div class="btn-group btn-group-xs">
											<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit_delete')" class="btn btn-warning" 
												href="{{route('dashboard.contracts.edit', $contract->id)}}">
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