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
								<th>@lang('dashboard.table.name')</th>
								<th>@lang('dashboard.table.benefit_type')</th>
								@if(Auth::user()->isAdmin())
									<th>@lang('dashboard.table.go')</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach($product->benefits as $benefit)
							<tr>
								<td>{{$benefit->name}}</td>
								<td>{{$benefit->type->name}}</td>
								@if(Auth::user()->isAdmin())
									<td>
										<div class="btn-group btn-group-xs">
											<a data-toggle="tooltip" title="@lang('dashboard.buttons.go')" class="btn btn-info" 
												href="{{route('dashboard.benefits.edit', $benefit->id)}}">
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