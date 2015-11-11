@extends('layout')

@section('title')
	@lang('dashboard.title_product_info')
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
        		<h1><i class='icon-info-circled-alt'></i> 
        			@lang('dashboard.title_product_info')
        		</h1>
            </div>
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-content">
							<div class="data-table-toolbar">
								<div class="row">
									<div class="col-md-12">
										<a href="{{route('dashboard.products.index')}}" class="btn btn-primary">
											<i class="icon-back"></i>
											@lang('dashboard.buttons.back')
										</a>
										@can('admin')
											<a href="{{route('dashboard.linkedsellers.product', $product->id)}}" class="btn btn-success">
												<i class="icon-suitcase"></i>
												@lang('dashboard.buttons.sellers')
											</a>
										@endcan
										<h3>
											<strong>
												{{ $product->name }}
											</strong>
										</h3>
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>@lang('dashboard.table.presentation')</th>
											<th>@lang('dashboard.table.price')</th>
											<th>@lang('dashboard.table.url')</th>
											<th>@lang('dashboard.table.company')</th>
											<th>@lang('dashboard.table.company_category')</th>
											<th>@lang('dashboard.table.creator')</th>
											<th>@lang('dashboard.table.status')</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{{ $product->presentation }}</td>
											<td>{{ $product->price }}</td>
											@if(empty($product->url))
												<td>@lang('dashboard.without_url')</td>
											@else
												<td><a href="{{ $product->url }}" target="_blank">{{ $product->url }}</a></td>
											@endif
											<td>{{ $product->company->name }}</td>
											<td>{{ $product->company->category->name }}</td>
											<td>{{ $product->creator }}</td>
											<td><span class="{{ ($product->isActive()) ? 'label label-success' : 'label label-danger' }}">
												@lang('dashboard.status.'.$product->getStatusId())
											</span></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			@include('dashboard.products.partials.info_contracts')
			@include('dashboard.products.partials.info_benefits')
			@include('dashboard.products.partials.info_incentives')
			@include('dashboard.products.partials.info_trainings')
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection