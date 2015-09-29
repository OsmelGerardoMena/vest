@extends('layout')

@section('title')
	@lang('dashboard.title_customers')
@stop

@section('content')

@include('partials/modal')

@foreach($customers as $customer)
	@include('dashboard.customers.partials.modal')
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
        		<h1><i class='icon-smiley-circled'></i>
        			@lang('dashboard.title_customers')
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
										<div class="toolbar-btn-action">
											<a class="btn btn-success" href="{{route('dashboard.customers.create')}}">
												<i class="fa fa-plus-circle"></i>
												@lang('dashboard.buttons.new')
											</a>
										</div>
										@include('dashboard.customers.partials.search')
									</div>
								</div>
							</div>
									
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>@lang('dashboard.table.name')</th>
											<th>@lang('dashboard.table.identifier')</th>
											<th>@lang('dashboard.table.status')</th>
											<th>@lang('dashboard.table.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($customers as $customer)
										<tr>
											<td>{{ $customer->id }}</td>
											<td>{{ $customer->name }}</td>
											<td>{{ $customer->identifier }}</td>
											<td><span class="{{ ($customer->getStatus()) ? 'label label-success' : 'label label-danger'}}">
												{{ trans('dashboard.link_status.'.$customer->getStatus()) }}
											</span></td>
											<td>
												<div class="btn-group btn-group-xs">
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.change_status')" class="btn btn-default" 
														href="{{route('dashboard.customers.status', $customer->id)}}">
														<i class="fa fa-power-off"></i>
													</a>
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.info')" class="btn btn-info" 
														href="{{route('dashboard.customers.show', $customer->id)}}">
														<i class="fa fa-info-circle"></i>
													</a>
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit')" class="btn btn-warning" 
														href="{{route('dashboard.customers.edit', $customer->id)}}">
														<i class="fa fa-edit"></i>
													</a>
													<a title="@lang('dashboard.buttons.delete')" data-modal="delete-modal-{{$customer->id}}" class="btn btn-danger md-trigger ">
														<i class="fa fa-trash-o"></i>
													</a>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $customers->appends(Request::only('name'))->render() !!}
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