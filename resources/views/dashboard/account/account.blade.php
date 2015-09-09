@extends('layout')

@section('title')
	@lang('dashboard.title_account')
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
        		<h1><i class='fa fa-male'></i> 
        			@lang('dashboard.title_account')
        		</h1>
            </div>
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-content">
							<div class="data-table-toolbar">
								<div class="row">
									<div class="col-md-12">
										<h3><strong>{{ $user->name }}</strong></h3>
										<div class="toolbar-btn-action">
											<a href="{{route('dashboard.account.edit', $user->id)}}" 
														class="btn btn-primary">
												<i class="icon-edit"></i>
												@lang('dashboard.buttons.edit_data')
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>@lang('dashboard.table.email')</th>
											<th>@lang('dashboard.table.profile')</th>
											<th>@lang('dashboard.table.status')</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{{ $user->email }}</td>
											<td>{{ $user->type->name }}</td>
											<td><span class="label label-success">
												{{ $user->status->type }}
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

			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-content">
							<div class="data-table-toolbar">
								<div class="row">
									<div class="col-md-8">
										<h3><strong>@lang('dashboard.other_data')</strong></h3>
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>@lang('dashboard.table.identifier')</th>
											<th>@lang('dashboard.table.mobile')</th>
											<th>@lang('dashboard.table.phone')</th>
											<th>@lang('dashboard.table.address')</th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{{ $user->identifier }}</td>
											<td>{{ $user->mobile }}</td>
											<td>{{ $user->phone }}</td>
											<td>{{ $user->address }}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			@if(!empty($products))
				@include('dashboard.account.partials.info_products')
			@endif
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection