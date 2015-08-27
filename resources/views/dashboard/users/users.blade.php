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
			@include('dashboard.users.partials.messages')
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-content">
							<div class="data-table-toolbar">
								<div class="row">
									<div class="col-md-12">
										<div class="toolbar-btn-action">
											<a class="btn btn-success" href="{{route('dashboard.users.create')}}">
												<i class="fa fa-plus-circle"></i>
												@lang('dashboard.buttons.new')
											</a>
											<!--<a class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
											<a class="btn btn-primary"><i class="fa fa-refresh"></i> Update</a>-->
										</div>
										@include('dashboard.users.partials.search')
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
											<th>@lang('dashboard.table.profile')</th>
											<th>@lang('dashboard.table.status')</th>
											<th>@lang('dashboard.table.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($users as $user)
										<tr data-id="{{ $user->id }}">
											<td>{{ $user->id }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->type->name }}</td>
											<td><span class="label label-success">{{ $user->status->type }}</span></td>
											<td>
												<div class="btn-group btn-group-xs">
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.off')" class="btn btn-default">
														<i class="fa fa-power-off"></i>
													</a>
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.info')" class="btn btn-info" 
														href="{{route('dashboard.users.show', $user->id)}}">
														<i class="icon-info"></i>
													</a>
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit')" class="btn btn-warning" 
														href="{{route('dashboard.users.edit', $user->id)}}">
														<i class="fa fa-edit"></i>
													</a>

													<!--<a data-toggle="tooltip" title="@lang('dashboard.buttons.delete')" class="btn btn-danger">
														<i class="fa fa-trash-o"></i>
													</a>-->

													<!--<a class="btn-delete"><i class="fa fa-trash-o"></i></a>-->
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $users->appends(Request::only(['namemail', 'type']))->render() !!}
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