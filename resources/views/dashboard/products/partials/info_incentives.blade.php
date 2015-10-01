<div class="panel-group accordion-toggle" id="accordiondemo">
	<div class="panel panel-darkblue-2">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	  			<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion-incentives">
	      			<i class='icon-star-empty'></i>
	      			@lang('dashboard.title_incentives')
	    		</a>
	  		</h4>
		</div>
    	<div id="accordion-incentives" class="panel-collapse collapse">
      		<div class="panel-body">
	      		<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead>
							<tr>
								<th>@lang('dashboard.table.goal')</th>
								<th>@lang('dashboard.table.award')</th>
								<th>@lang('dashboard.table.url')</th>
								<th>@lang('dashboard.table.date')</th>
								@if(Auth::user()->isAdmin())
									<th>@lang('dashboard.table.actions')</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach($product->incentives as $incentive)
							<tr>
								<td>{{$incentive->goal}}</td>
								<td>{{$incentive->award}}</td>
								<td><a href="{{ $incentive->url }}" target="_blank">{{ $incentive->url }}</a></td>
								<td>{{$incentive->date}}</td>
								@if(Auth::user()->isAdmin())
									<td>
										<div class="btn-group btn-group-xs">
											<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit_delete')" class="btn btn-info" 
												href="{{route('dashboard.incentives.edit', $incentive->id)}}">
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