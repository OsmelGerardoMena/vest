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
					<span class="{{ ($product->isActive()) ? 'label label-success' : 'label label-danger'}}">
						@lang('dashboard.status.'.$product->getStatusId())
					</span>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>