<div class="panel-group accordion-toggle" id="accordiondemo">
	<div class="panel panel-green-1">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	  			<a data-toggle="collapse" data-parent="#accordiondemo" href="#accordion-products">
	      			<i class='icon-layers'></i>
	      			<strong>@lang('dashboard.title_products')</strong>
	    		</a>
	  		</h4>
		</div>
    	<div id="accordion-products" class="panel-collapse collapse">
      		<div class="panel-body">
	      		<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead>
							<tr>
								<th>@lang('dashboard.table.name')</th>
								<th>@lang('dashboard.table.company')</th>
								<th>@lang('dashboard.table.creator')</th>
								<th>@lang('dashboard.table.status')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $product)
							<tr>
								<td>{{ $product->name }}</td>
								<td>{{ $product->company->name }}</td>
								<td>{{ $product->creator->name }}</td>
								<td>
									<span class="label label-success">
										{{ $product->status->type }}
									</span>
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