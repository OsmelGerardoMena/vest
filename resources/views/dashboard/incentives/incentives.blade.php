@extends('layout')

@section('title')
	@lang('dashboard.title_incentives')
@stop

@section('content')

@include('partials/modal')

@can('admin')
	@foreach($incentives as $incentive)
		@include('dashboard.incentives.partials.modal')
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
        		<h1><i class='icon-star-empty'></i> 
        			@lang('dashboard.title_incentives')
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
											<a class="btn btn-success" href="{{route('dashboard.incentives.create')}}">
												<i class="fa fa-plus-circle"></i>
												@lang('dashboard.buttons.new')
											</a>
										</div>
										@include('dashboard.incentives.partials.search')
									</div>
								</div>
							</div>
									
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>@lang('dashboard.table.incentive_type')</th>
											<th>@lang('dashboard.table.goal')</th>
											<th>@lang('dashboard.table.award')</th>
											<th>@lang('dashboard.table.img')</th>
											<th>@lang('dashboard.table.date_from')</th>
											<th>@lang('dashboard.table.date_to')</th>
											<th>@lang('dashboard.table.product')</th>
											@can('admin')
												<th>@lang('dashboard.table.company')</th>
											@endcan
											<th>@lang('dashboard.table.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($incentives as $incentive)
										<tr>
											<td>{{ $incentive->id }}</td>
											<td>{{ $incentive->type->name }}</td>
											<td>{{ $incentive->goal }}</td>
											<td>{{ $incentive->award }}</td>
											@if($incentive->hasFile())
												<td><a href="{{ asset('files/incentives') }}/{{ $incentive->img }}" target="_blank">
													@lang('dashboard.see_image')
												</a></td>
											@else
												<td>@lang('dashboard.image_not_found')</td>
											@endif
											<td>{{ $incentive->date_from }}</td>
											<td>{{ $incentive->date_to }}</td>
											<td>{{ $incentive->product->name }}</td>
											@can('admin')
												<td>{{ $incentive->product->company->name }}</td>
											@endcan
											<td>
												<div class="btn-group btn-group-xs">
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit')" class="btn btn-warning" 
														href="{{route('dashboard.incentives.edit', $incentive->id)}}">
														<i class="fa fa-edit"></i>
													</a>
													@can('admin')
														<a title="@lang('dashboard.buttons.delete')" data-modal="delete-modal-{{$incentive->id}}" class="btn btn-danger md-trigger ">
															<i class="fa fa-trash-o"></i>
														</a>
													@endcan
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $incentives->appends(Request::only(['award', 'product']))->render() !!}
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