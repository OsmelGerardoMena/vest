@extends('layout')

@section('title')
	@lang('dashboard.title_profiles')
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
        		<h1><i class='fa fa-group'></i> 
        			@lang('dashboard.title_profiles')
        		</h1>
            </div>
			@include('dashboard.profiles.partials.messages')
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-content">
							<div class="data-table-toolbar">
								<div class="row">
									<div class="col-md-12">
										<div class="toolbar-btn-action">
											<a class="btn btn-success" href="{{route('dashboard.profiles.create')}}">
												<i class="fa fa-plus-circle"></i>
												@lang('dashboard.buttons.new')
											</a>
											<!--<a class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
											<a class="btn btn-primary"><i class="fa fa-refresh"></i> Update</a>-->
										</div>
										@include('dashboard.profiles.partials.search')
									</div>
								</div>
							</div>
									
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>@lang('dashboard.tableProfile.type')</th>
											<th>@lang('dashboard.tableProfile.status')</th>
											<th>@lang('dashboard.tableProfile.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($profiles as $profile)
										<tr data-id="{{ $profile->id }}">
											<td>{{ $profile->id }}</td>
											<td>{{ $profile->name }}</td>
											<td><span class="label label-success">{{ $profile->status->type }}</span></td>
											<td>
												<div class="btn-group btn-group-xs">
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.off')" class="btn btn-default">
														<i class="fa fa-power-off"></i>
													</a>
													
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit')" class="btn btn-warning" 
														href="{{route('dashboard.profiles.edit', $profile->id)}}">
														<i class="fa fa-edit"></i>
													</a>

													<a data-toggle="tooltip" title="@lang('dashboard.buttons.delete')" class="btn btn-danger">
														<i class="fa fa-trash-o"></i>
													</a>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $profiles->appends(Request::only('name'))->render() !!}
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