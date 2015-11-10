@extends('layout')

@section('title')
	@lang('dashboard.title_sales')
@stop

@section('content')

@include('partials/modal')

@can('admin')
	@foreach($sales as $sale)
		@include('dashboard.sales.partials.modal')
	@endforeach
@endcan

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
        			@lang('dashboard.title_sales')
        		</h1>
            </div>
			@include('dashboard.partials.messages')
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-content">
							<div class="data-table-toolbar">
								<div class="row">
									<div class="col-md-12">
										<div class="toolbar-btn-action">
											<!-- si el usuario es admin o seller se muestra -->
											@cannot('company')
												<a class="btn btn-success" href="{{route('dashboard.sales.create')}}">
													<i class="fa fa-plus-circle"></i>
													@lang('dashboard.buttons.new')
												</a>
												<hr>
											@endcan
										</div>
										@include('dashboard.sales.partials.search')	
									</div>
								</div>
							</div>
								
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>@lang('dashboard.table.amount')</th>
											<th>@lang('dashboard.table.quantity')</th>
											<th>@lang('dashboard.table.total')</th>
											@can('admin')
												<th>@lang('dashboard.table.seller')</th>
											@endcan
											<th>@lang('dashboard.table.product')</th>
											<th>@lang('dashboard.table.customer')</th>
											<th>@lang('dashboard.table.invoice')</th>
											<th>@lang('dashboard.table.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($sales as $sale)
										<tr>
											<td>{{ $sale->id }}</td>
											<td>{{ $sale->amount }}</td>
											<td>{{ $sale->quantity }}</td>
											<td>{{ $sale->amount * $sale->quantity }}</td>
											@can('admin')
												<td>{{ $sale->seller->name }}</td>
											@endcan
											<td>{{ $sale->product->name }}</td>
											<td>{{ $sale->customer->name }}</td>
											<td>
												{{ (!is_null($sale->invoice)) ? '# '.$sale->invoice 
												: trans('dashboard.without_invoice') }}
											</td>
											<td>
												<div class="btn-group btn-group-xs">
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.info')" class="btn btn-info" 
														href="{{route('dashboard.sales.show', $sale->id)}}">
														<i class="fa fa-info-circle"></i>
													</a>
													<!-- si el usuario es admin o seller se muestra -->
													@cannot('company')
														<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit')" class="btn btn-warning" 
															href="{{route('dashboard.sales.edit', $sale->id)}}">
															<i class="fa fa-edit"></i>
														</a>
													@endcan

													@can('admin')
														<a title="@lang('dashboard.buttons.delete')" data-modal="delete-modal-{{$sale->id}}" class="btn btn-danger md-trigger ">
															<i class="fa fa-trash-o"></i>
														</a>
													@endcan

													@can('company')
														<a data-toggle="tooltip" title="@lang('dashboard.buttons.save_edit_invoice')" class="btn btn-warning" 
															href="{{ route('dashboard.sales.invoice', $sale->id) }}">
															<i class="fa fa-edit"></i>
														</a>
													@endcan
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $sales->appends(Request::only(['seller', 'product', 'customer']))->render() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection