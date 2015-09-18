@extends('layout')

@section('title')
	@lang('dashboard.title_sellers')
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
        		<h1><i class='icon-suitcase'></i> 
        			@lang('dashboard.title_sellers')
        		</h1>
            </div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-content">
							<div class="data-table-toolbar">
								<div class="row">
									<div class="col-md-12">
										@include('dashboard.sellers.partials.search_seller')
									</div>
								</div>
							</div>
									
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>@lang('dashboard.table.name')</th>
											<th>@lang('dashboard.table.email')</th>
											<th>@lang('dashboard.table.status')</th>
											<th>@lang('dashboard.table.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($sellers as $seller)
										<tr>
											<td>{{ $seller->id }}</td>
											<td>{{ $seller->name }}</td>
											<td>{{ $seller->email }}</td>
											<td><span class="{{ ($seller->isActive()) ? 'label label-success' : 'label label-danger'}}">
												{{ trans('dashboard.status.'.$seller->getStatusId()) }}
											</span></td>
											<td>
												<div class="btn-group btn-group-xs">
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.change_status')" class="btn btn-default" 
														href="{{route('dashboard.users.status', $seller->id)}}">
														<i class="fa fa-power-off"></i>
													</a>
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.info_and_product')" class="btn btn-info" 
														href="{{route('dashboard.sellers.show', $seller->id)}}">
														<i class="fa fa-eye"></i>
													</a>
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.add_product')" class="btn btn-success" 
														href="{{route('dashboard.sellers.edit', $seller->id)}}">
														<i class="fa fa-plus"></i>
													</a>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $sellers->appends(Request::only('seller'))->render() !!}
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