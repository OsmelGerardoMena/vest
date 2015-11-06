@extends('layout')

@section('title')
	@lang('dashboard.title_products')
@stop

@section('content')

@include('partials/modal')

@can('admin')
	@foreach($products as $product)
		@include('dashboard.products.partials.modal')
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
        		<h1><i class='icon-layers'></i>
        			@lang('dashboard.title_products')
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
												<a class="btn btn-success" href="{{route('dashboard.products.create')}}">
													<i class="fa fa-plus-circle"></i>
													@lang('dashboard.buttons.new')
												</a>
												<hr>
											@endcan
										</div>
										@include('dashboard.products.partials.search')
									</div>
								</div>
							</div>
									
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>@lang('dashboard.table.name')</th>
											<th>@lang('dashboard.table.presentation')</th>
											<th>@lang('dashboard.table.price')</th>
											<th>@lang('dashboard.table.url')</th>
											<th>@lang('dashboard.table.company')</th>
											<th>@lang('dashboard.table.company_category')</th>
											<th>@lang('dashboard.table.status')</th>
											<th>@lang('dashboard.table.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($products as $product)
										<tr>
											<td>{{ $product->id }}</td>
											<td>{{ $product->name }}</td>
											<td>{{ $product->presentation }}</td>
											<td>{{ $product->price }}</td>
											@if(empty($product->url))
												<td>@lang('dashboard.without_url')</td>
											@else
												<td><a href="{{ $product->url }}" target="_blank">{{ $product->url }}</a></td>
											@endif
											<td>{{ $product->company->name }}</td>
											<td>{{ $product->company->category->name }}</td>
											<td><span class="{{ ($product->isActive()) ? 'label label-success' : 'label label-danger'}}">
												{{ trans('dashboard.status.'.$product->getStatusId()) }}
											</span></td>
											<td>
												<div class="btn-group btn-group-xs">
													@can('admin')
														<a data-toggle="tooltip" title="@lang('dashboard.buttons.change_status')" class="btn btn-default" 
															href="{{route('dashboard.products.status', $product->id)}}">
															<i class="fa fa-power-off"></i>
														</a>

														<a data-toggle="tooltip" title="@lang('dashboard.buttons.info')" class="btn btn-info" 
															href="{{route('dashboard.products.show', $product->id)}}">
															<i class="fa fa-info-circle"></i>
														</a>
														
														<a data-toggle="tooltip" title="@lang('dashboard.buttons.edit')" class="btn btn-warning" 
															href="{{route('dashboard.products.edit', $product->id)}}">
															<i class="fa fa-edit"></i>
														</a>

														<a title="@lang('dashboard.buttons.delete')" data-modal="delete-modal-{{$product->id}}" class="btn btn-danger md-trigger ">
															<i class="fa fa-trash-o"></i>
														</a>
													@endcan

													@can('seller')
														<a data-toggle="tooltip" title="@lang('dashboard.buttons.info')" class="btn btn-info" 
															href="{{route('dashboard.products.show', $product->id)}}">
															<i class="fa fa-info-circle"></i>
														</a>
													@endcan
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $products->appends(Request::only(['name', 'company', 'category']))->render() !!}
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