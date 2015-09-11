@extends('layout')

@section('title')
	{{$company->name}} @lang('dashboard.title_products')
@stop

@section('content')

@include('partials/modal')

@foreach($companyProducts as $product)
	@include('dashboard.companies.partials.modal')
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
        		<h1><i class='icon-flag-circled'></i> 
        			{{$company->name}}
        		</h1>
			</div>

            @include('dashboard.companies.partials.company_info')

			@include('dashboard.partials.messages')
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-header transparent">
							<h2>
								<i class='icon-layers'></i>
								<strong>@lang('dashboard.title_products')</strong>
							</h2>
							<div class="additional-btn">
								<a href="#" class="widget-toggle">
									<i class="icon-down-open-2"></i>
								</a>
							</div>
						</div>
						<div class="widget-content">
							<div class="data-table-toolbar">
								<div class="row">
									<div class="col-md-12">
										@include('dashboard.companies.partials.search_company_product')
									</div>
								</div>
							</div>
									
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>@lang('dashboard.table.name')</th>
											<th>@lang('dashboard.table.url')</th>
											<th>@lang('dashboard.table.status')</th>
											<th>@lang('dashboard.table.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($companyProducts as $product)
										<tr>
											<td>{{ $product->id }}</td>
											<td>{{ $product->name }}</td>
											<td><a href="{{ $product->url }}" target="_blank">{{ $product->url }}</a></td>
											<td>
												<span class="{{ ($product->status->id == 1) ? 'label label-success' : 'label label-danger'}}">
													{{ trans('dashboard.status.'.$product->status->id) }}
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
								{!! $companyProducts->appends(Request::only('nameproduct'))->render() !!}
							</div>
						</div>
					</div>
					<a href="{{route('dashboard.companies.index')}}" class="btn btn-primary">
						<i class="icon-back"></i>
						@lang('dashboard.buttons.back')
					</a>
				</div>
			</div>
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection