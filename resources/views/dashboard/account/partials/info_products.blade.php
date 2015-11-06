<div class="table-responsive">
	<table data-sortable class="table table-hover table-striped">
		<thead>
			<tr>
				<th>@lang('dashboard.table.name')</th>
				<th>@lang('dashboard.table.presentation')</th>
				<th>@lang('dashboard.table.price')</th>
				<th>@lang('dashboard.table.company')</th>
				<th>@lang('dashboard.table.creator')</th>
				@if($user->isSeller())
	                <th>@lang('dashboard.table.link_status')</th>
	            @elseif($user->isCompany())
	                <th>@lang('dashboard.table.status')</th>
	            @endif
			</tr>
		</thead>
		<tbody>
			@foreach($products as $product)
			<tr>
				<td>{{ $product->name }}</td>
				<td>{{ $product->presentation }}</td>
				<td>{{ $product->price }}</td>
				<td>{{ $product->company->name }}</td>
				<td>{{ $product->creator }}</td>
				@if($user->isSeller())
					<td>
						<span class="{{ ($product->getLinkStatus()) ? 'label label-success' : 'label label-danger'}}">
							{{ trans('dashboard.link_status.'.$product->getLinkStatus()) }}
						</span>
					</td>
				@elseif($user->isCompany())
					<td>
						<span class="{{ ($product->isActive()) ? 'label label-success' : 'label label-danger'}}">
                    		@lang('dashboard.status.'.$product->getStatusId())
                    	</span>
                    </td>
				@endif
			</tr>
			@endforeach
		</tbody>
	</table>
</div>