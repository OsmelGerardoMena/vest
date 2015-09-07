@extends('layout')

@section('title')
	@lang('dashboard.title_info')
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
        		<h1><i class='icon-user'></i> 
        			@lang('dashboard.title_info')
        		</h1>
            </div>
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-content">
							<div class="data-table-toolbar">
								<div class="row">
									<div class="col-md-12">
										<a href="{{route('dashboard.users.index')}}" class="btn btn-primary">
											<i class="icon-back"></i>
											@lang('dashboard.buttons.back')
										</a>
										
										<h3><strong>{{ $user->name }}</strong></h3>
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>Id</th>
											<th>@lang('dashboard.table.email')</th>
											<th>@lang('dashboard.table.profile')</th>
											<th>@lang('dashboard.table.status')</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{{ $user->id }}</td>
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
										<h3><strong>Other data</strong></h3>
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

		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->

<!-- {!! Form::open(['route' => ['dashboard.users.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}-->

@endsection