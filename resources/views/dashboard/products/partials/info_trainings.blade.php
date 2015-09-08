<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-content">
				<div class="data-table-toolbar">
					<div class="row">
						<div class="col-md-8">
							<h3>
								<i class='icon-star-empty'></i>
								<strong>
									@lang('dashboard.title_trainings')
								</strong>
							</h3>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead>
							<tr>
								<th>@lang('dashboard.table.url')</th>
								<th>@lang('dashboard.table.date')</th>
								<th>@lang('dashboard.table.go')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($product->trainings as $training)
							<tr>
								<td>{{$training->url}}</td>
								<td>{{$training->date}}</td>
								<td>
									<div class="btn-group btn-group-xs">
										<a data-toggle="tooltip" title="@lang('dashboard.buttons.go')" class="btn btn-info" 
											href="{{route('dashboard.trainings.edit', $training->id)}}">
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