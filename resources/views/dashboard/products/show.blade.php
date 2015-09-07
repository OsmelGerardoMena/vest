@extends('layout')

@section('title')
	@lang('dashboard.title_info_product')
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
        			@lang('dashboard.title_info_product')
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
										
										<h3><strong>{{ $product->name }}</strong></h3>
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>Id</th>
											<th>@lang('dashboard.table.creator')</th>
											<th>@lang('dashboard.table.company')</th>
											<th>@lang('dashboard.table.status')</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{{ $product->id }}</td>
											<td>{{ $product->creator->name }}</td>
											<td>{{ $product->company->name }}</td>
											<td><span class="label label-success">
												{{ $product->status->type }}
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
			@include('dashboard.products.partials.info_contracts')
			@include('dashboard.products.partials.info_benefits')
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection