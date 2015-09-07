<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-content">
				<div class="data-table-toolbar">
					<div class="row">
						<div class="col-md-8">
							<h3>
								<i class='icon-docs'></i> 
								<strong>
									@lang('dashboard.title_contracts')
								</strong>
							</h3>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead>
							<tr>
								<th>@lang('dashboard.table.name')</th>
								<th>@lang('dashboard.table.url')</th>
								<th>@lang('dashboard.table.actions')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($product->contracts as $contract)
							<tr>
								<td>{{$contract->name}}</td>
								<td>{{$contract->url}}</td>
								<td>
									<div class="btn-group btn-group-xs">
										<a data-toggle="tooltip" title="@lang('dashboard.buttons.off')" class="btn btn-default">
											<i class="fa fa-power-off"></i>
										</a>

										<a title="@lang('dashboard.buttons.delete')" data-modal="delete-modal-{{$contract->id}}" class="btn btn-danger md-trigger ">
											<i class="fa fa-trash-o"></i>
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