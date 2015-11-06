@extends('layout')

@section('title')
	@lang('dashboard.title_info_sale')
@stop

@section('content')

@include('partials/modal')

<!-- Begin page -->
<div id="wrapper">
	@include('partials/topbar')
	@include('partials/sidebar')
	<!-- Start right content -->
	<div class="content-page">
		<!-- Start Content here -->
		<div class="content">
			<div class="page-heading">
        		<h1><i class='glyphicon glyphicon-stats'></i> 
        			@lang('dashboard.title_info_sale')
        		</h1>
            </div>

        	<a href="{{route('dashboard.sales.index')}}" class="btn btn-primary">
				<i class="icon-back"></i>
				@lang('dashboard.buttons.back')
			</a><br><br>

			<div class="widget">
				<div class="widget-content padding">

					<div class="table-responsive">
						<table data-sortable class="table table-hover table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>@lang('dashboard.table.amount')</th>
									<th>@lang('dashboard.table.quantity')</th>
									<th>@lang('dashboard.table.total')</th>
									<th>@lang('dashboard.table.invoice')</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ $sale->id }}</td>
									<td>{{ $sale->amount }}</td>
									<td>{{ $sale->quantity }}</td>
									<td>{{ $sale->amount * $sale->quantity }}</td>
									<td>
										{{ (!is_null($sale->invoice)) ? '# '.$sale->invoice 
										: trans('dashboard.without_invoice') }}
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<hr>

					@cannot('seller')
		            	@include('dashboard.sales.partials.seller_info')
		            @endcan
		            @include('dashboard.sales.partials.product_info')
		            @include('dashboard.sales.partials.customer_info')
		        </div>
		    </div>
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection