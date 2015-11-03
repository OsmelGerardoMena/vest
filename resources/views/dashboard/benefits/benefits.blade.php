@extends('layout')

@section('title')
	@lang('dashboard.title_benefits')
@stop

@section('content')

@include('partials/modal')

@can('admin')
	@foreach($benefits as $benefit)
		@include('dashboard.benefits.partials.modal')
	@endforeach
@endcan

<!-- Begin page -->
<div id="wrapper">
	@include('partials/topbar')
	@include('partials/sidebar')

	<!-- Start right content -->
	<div class="content-page">

		<!-- Start Content here -->
		<div class="content">
			<div class="page-heading">
        		<h1><i class='fa fa-thumbs-o-up'></i>
        			@lang('dashboard.title_benefits')
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
											@can('admin')
												<a class="btn btn-success" href="{{route('dashboard.benefits.create')}}">
													<i class="fa fa-plus-circle"></i>
													@lang('dashboard.buttons.new')
												</a>
											@endcan
										</div>
										@include('dashboard.benefits.partials.search')
									</div>
								</div>
							</div>
									
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>@lang('dashboard.table.product')</th>
											<th>@lang('dashboard.table.benefit_type')</th>
											<th>@lang('dashboard.table.amount')</th>
											@can('admin')
												<th>@lang('dashboard.table.admin_amount')</th>
												<th>@lang('dashboard.table.company')</th>
												<th>@lang('dashboard.table.actions')</th>
											@endcan
										</tr>
									</thead>
									<tbody>
										@foreach($benefits as $benefit)
										<tr>
											<td>{{ $benefit->id }}</td>
											<td>{{ $benefit->product->name }}</td>
											<td>{{ $benefit->type->name }}</td>
											@can('admin')
												<td>{{ $benefit->amount }}</td>
												<td>{{ $benefit->admin_amount }}</td>
												<td>{{ $benefit->product->company->name }}</td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit')" class="btn btn-warning" 
															href="{{route('dashboard.benefits.edit', $benefit->id)}}">
															<i class="fa fa-edit"></i>
														</a>
														<a title="@lang('dashboard.buttons.delete')" data-modal="delete-modal-{{$benefit->id}}" class="btn btn-danger md-trigger ">
															<i class="fa fa-trash-o"></i>
														</a>
													</div>
												</td>
											@else
												<td>{{ $benefit->amount + $benefit->admin_amount }}</td>
											@endcan
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $benefits->appends(Request::only('product'))->render() !!}
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