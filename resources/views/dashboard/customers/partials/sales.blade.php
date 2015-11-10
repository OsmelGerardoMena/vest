<div class="table-responsive">
	<table data-sortable class="table table-hover table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>@lang('dashboard.table.amount')</th>
				<th>@lang('dashboard.table.quantity')</th>
				<th>@lang('dashboard.table.total')</th>
				<th>@lang('dashboard.table.seller')</th>
				<th>@lang('dashboard.table.product')</th>
			</tr>
		</thead>
		<tbody>
			@foreach($customer->sales as $sale)
				<tr>
					<td>{{ $sale->id }}</td>
					<td>{{ $sale->amount }}</td>
					<td>{{ $sale->quantity }}</td>
					<td>{{ $sale->amount * $sale->quantity }}</td>
					<td>{{ $sale->seller->name }}</td>
					<td>{{ $sale->product->name }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>