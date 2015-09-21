@extends('layout')

@section('title')
	@lang('dashboard.title_companies')
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
        		<h1><i class='icon-flag-circled'></i> 
        			@lang('dashboard.title_companies')
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
										@include('dashboard.companies.partials.search_company')
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
											<th>@lang('dashboard.table.phone')</th>
											<th>@lang('dashboard.table.status')</th>
											<th>@lang('dashboard.table.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($companies as $company)
										<tr>
											<td>{{ $company->id }}</td>
											<td>{{ $company->name }}</td>
											<td>{{ $company->email }}</td>
											<td>{{ $company->phone }}</td>
											<td><span class="{{ ($company->isActive()) ? 'label label-success' : 'label label-danger'}}">
												{{ trans('dashboard.status.'.$company->getStatusId()) }}
											</span></td>
											<td>
												<div class="btn-group btn-group-xs">
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.change_status')" class="btn btn-default" 
														href="{{route('dashboard.users.status', $company->id)}}">
														<i class="fa fa-power-off"></i>
													</a>
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.info_and_product')" class="btn btn-info" 
														href="{{route('dashboard.companies.show', $company->id)}}">
														<i class="fa fa-eye"></i>
													</a>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $companies->appends(Request::only('company'))->render() !!}
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