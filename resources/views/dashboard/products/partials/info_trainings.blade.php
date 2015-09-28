<div class="panel-group accordion-toggle" id="accordiondemo">
	<div class="panel panel-darkblue-2">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	  			<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion-trainings">
	      			<i class='fa fa-book'></i>
	      			@lang('dashboard.title_trainings')
	    		</a>
	  		</h4>
		</div>
    	<div id="accordion-trainings" class="panel-collapse collapse">
      		<div class="panel-body">
	      		<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead>
							<tr>
								<th>@lang('dashboard.table.date')</th>
								<th>@lang('dashboard.table.actions')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($product->trainings as $training)
							<tr>
								<td>{{$training->date}}</td>
								<td>
									<div class="btn-group btn-group-xs">
										@if(Auth::user()->isAdmin())
											<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit_delete')" class="btn btn-warning" 
												href="{{route('dashboard.trainings.edit', $training->id)}}">
												<i class="fa fa-edit"></i>
											</a>
										@endif
										<a data-toggle="tooltip" title="@lang('dashboard.buttons.info')" class="btn btn-info" 
											href="{{route('dashboard.trainings.show', $training->id)}}">
											<i class="fa fa-info-circle"></i>
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