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
								<th>@lang('dashboard.table.incentive_type')</th>
								<th>@lang('dashboard.table.award')</th>
								<th>@lang('dashboard.table.img')</th>
								<th>@lang('dashboard.table.date_from')</th>
								<th>@lang('dashboard.table.date_to')</th>
								@can('admin')
									<th>@lang('dashboard.table.actions')</th>
								@endcan
							</tr>
						</thead>
						<tbody>
							@foreach($product->incentives as $incentive)
							<tr>
								<td>{{$incentive->goal}}</td>
								<td>{{ $incentive->type->name }}</td>
								<td>{{$incentive->award}}</td>
								@if($incentive->hasFile())
									<td><a href="{{ asset('files/incentives') }}/{{ $incentive->img }}" target="_blank">
										@lang('dashboard.see_image')
									</a></td>
								@else
									<td>@lang('dashboard.image_not_found')</td>
								@endif
								<td>{{ $incentive->date_from }}</td>
								<td>{{ $incentive->date_to }}</td>
								@can('admin')
									<td>
										<div class="btn-group btn-group-xs">
											<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit_delete')" class="btn btn-warning" 
												href="{{route('dashboard.incentives.edit', $incentive->id)}}">
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