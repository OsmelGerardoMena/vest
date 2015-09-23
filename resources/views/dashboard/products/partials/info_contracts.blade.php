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
								@if(Auth::user()->isAdmin())
									<th>@lang('dashboard.table.go')</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach($product->contracts as $contract)
							<tr>
								<td>{{$contract->name}}</td>
								@if(Storage::disk('local_pdf')->exists($contract->contract_file))
									<td><a href="{{ asset('files/contracts') }}/{{ $contract->contract_file }}" target="_blank">
										@lang('dashboard.download_contract')
									</a></td>
								@else
									<td>@lang('dashboard.not_found')</td>
								@endif
								@if(Auth::user()->isAdmin())
									<td>
										<div class="btn-group btn-group-xs">
											<a data-toggle="tooltip" title="@lang('dashboard.buttons.go')" class="btn btn-info" 
												href="{{route('dashboard.contracts.edit', $contract->id)}}">
												<i class="glyphicon glyphicon-arrow-left"></i>
											</a>
										</div>
									</td>
								@endif
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
      		</div>
    	</div>
	</div>
</div>