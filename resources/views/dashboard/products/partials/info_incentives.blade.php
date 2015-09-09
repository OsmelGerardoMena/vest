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
								<th>@lang('dashboard.table.go')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($product->incentives as $incentive)
							<tr>
								<td>{{$incentive->goal}}</td>
								<td>{{$incentive->award}}</td>
								<td>{{$incentive->url}}</td>
								<td>{{$incentive->date}}</td>
								<td>
									<div class="btn-group btn-group-xs">
										<a data-toggle="tooltip" title="@lang('dashboard.buttons.go')" class="btn btn-info" 
											href="{{route('dashboard.incentives.edit', $incentive->id)}}">
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