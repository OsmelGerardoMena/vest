<div class="panel-group accordion-toggle" id="accordiondemo">
	<div class="panel panel-darkblue-2">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	  			<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion-product">
	      			<i class='icon-layers'></i>
	      			<strong>@lang('dashboard.title_product_info')</strong>
	    		</a>
	  		</h4>
		</div>
    	<div id="accordion-product" class="panel-collapse collapse">
      		<div class="panel-body">
	      		<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead>
							<tr>
								<th>@lang('dashboard.table.name')</th>
								<th>@lang('dashboard.table.price')</th>
								<th>@lang('dashboard.table.url')</th>
								<th>@lang('dashboard.table.company')</th>
								<th>@lang('dashboard.table.creator')</th>
								<th>@lang('dashboard.table.status')</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $sale->product->name }}</td>
								<td>{{ $sale->product->price }}</td>
								<td><a href="{{ $sale->product->url }}" target="_blank">
									{{ $sale->product->url }}
								</a></td>
								<td>{{ $sale->product->company->name }}</td>
								<td>{{ $sale->product->creator }}</td>
								<td><span class="{{ ($sale->product->isActive()) ? 'label label-success' : 'label label-danger'}}">
									{{ trans('dashboard.status.'.$sale->product->getStatusId()) }}
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
      		</div>
    	</div>
	</div>
</div>