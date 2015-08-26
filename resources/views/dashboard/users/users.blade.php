@extends('layout')

@section('title')
	@lang('dashboard.title_users')
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
            		<h1><i class='icon-users'></i> 
            			@lang('dashboard.title_users')
            		</h1>
            </div>
	
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-content">
							<div class="data-table-toolbar">
								<div class="row">
									<div class="col-md-4">
										<form role="form">
										<input name="name" type="text" class="form-control" placeholder="Search...">
										</form>
									</div>
									<div class="col-md-8">
										<div class="toolbar-btn-action">
											<a class="btn btn-success" href="{{route('dashboard.users.create')}}">
												<i class="fa fa-plus-circle"></i>
												Add new
											</a>
											<!--<a class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
											<a class="btn btn-primary"><i class="fa fa-refresh"></i> Update</a>-->
										</div>
									</div>
								</div>
							</div>
									
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Email</th>
											<th>Profile</th>
											<th>Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach($users as $user)
										<tr>
											<td>{{ $user->id }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->type->name }}</td>
											<td><span class="label label-success">{{ $user->status->type }}</span></td>
											<td>
												<div class="btn-group btn-group-xs">
													<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
													<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								{!! $users->render() !!}
							</div>
							<!--<div class="data-table-toolbar">
								paginate
							</div>-->
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