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
								@if(Auth::user()->isAdmin())
									<th>@lang('dashboard.table.go')</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach($product->trainings as $training)
							<tr>
								<td>{{$training->date}}</td>
								@if(Auth::user()->isAdmin())
									<td>
										<div class="btn-group btn-group-xs">
											<a data-toggle="tooltip" title="@lang('dashboard.buttons.go')" class="btn btn-info" 
												href="{{route('dashboard.trainings.edit', $training->id)}}">
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