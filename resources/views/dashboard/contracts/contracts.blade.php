@extends('layout')

@section('title')
	@lang('dashboard.title_contracts')
@stop

@section('content')

@include('partials/modal')

@foreach($contracts as $contract)
	@include('dashboard.contracts.partials.modal')
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
        		<h1><i class='icon-docs'></i> 
        			@lang('dashboard.title_contracts')
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
											<a class="btn btn-success" href="{{route('dashboard.contracts.create')}}">
												<i class="fa fa-plus-circle"></i>
												@lang('dashboard.buttons.new')
											</a>
										</div>
										@include('dashboard.contracts.partials.search')
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>@lang('dashboard.table.name')</th>
											<th>@lang('dashboard.table.file')</th>
											<th>@lang('dashboard.table.product')</th>
											<th>@lang('dashboard.table.company')</th>
											<th>@lang('dashboard.table.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($contracts as $contract)
										<tr>
											<td>{{ $contract->id }}</td>
											<td>{{ $contract->name }}</td>
											@if($contract->fileExists())
												<td><a href="{{ asset('files/contracts') }}/{{ $contract->contract_file }}" target="_blank">
													@lang('dashboard.download_contract')
												</a></td>
											@else
												<td>@lang('dashboard.not_found')</td>
											@endif
											<td>{{ $contract->product->name }}</td>
											<td>{{ $contract->product->company->name }}</td>
											<td>
												<div class="btn-group btn-group-xs">
													<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit')" class="btn btn-warning" 
														href="{{route('dashboard.contracts.edit', $contract->id)}}">
														<i class="fa fa-edit"></i>
													</a>

													<a title="@lang('dashboard.buttons.delete')" data-modal="delete-modal-{{$contract->id}}" class="btn btn-danger md-trigger ">
														<i class="fa fa-trash-o"></i>
													</a>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $contracts->appends(Request::only(['name', 'product']))->render() !!}
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