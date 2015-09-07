@extends('layout')

@section('title')
	{{$seller->name}} @lang('dashboard.title_products')
@stop

@section('content')

@include('partials/modal')

@foreach($sellerProducts as $product)
	@include('dashboard.sellers.partials.modal')
@endforeach

<!-- Begin page -->
<div id="wrapper">
	@include('partials/topbar')
	@include('partials/sidebar')

	<!-- Start right content -->
	<div class="content-page">

		<!-- Start Content here -->
		<div class="content">
			<div class="page-heading">
        		<h1><i class='icon-layers'></i> 
        			{{$seller->name}}: @lang('dashboard.title_products')
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
											<a href="{{route('dashboard.sellers.index')}}" class="btn btn-primary">
												<i class="icon-back"></i>
												@lang('dashboard.buttons.back')
											</a>
										</div>
										@include('dashboard.sellers.partials.search_seller_product')
									</div>
								</div>
							</div>
									
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>@lang('dashboard.table.name')</th>
											<th>@lang('dashboard.table.company')</th>
											<th>@lang('dashboard.table.status')</th>
											<th>@lang('dashboard.table.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($sellerProducts as $product)
										<tr>
											<td>{{ $product->id }}</td>
											<td>{{ $product->name }}</td>
											<td>{{ $product->company->name }}</td>
											<td>
												<span class="{{ ($product->pivot->status) ? 'label label-success' : 'label label-danger'}}">
													{{ trans('dashboard.status.'.$product->pivot->status) }}
												</span>
											</td>
											<td>
												<div class="btn-group btn-group-xs">
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.off')" class="btn btn-default">
														<i class="fa fa-power-off"></i>
													</a>
									
													<a title="@lang('dashboard.buttons.delete')" data-modal="delete-modal-{{$product->id}}" class="btn btn-danger md-trigger ">
														<i class="fa fa-trash-o"></i>
													</a>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $sellerProducts->appends(Request::only('nameproduct'))->render() !!}
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