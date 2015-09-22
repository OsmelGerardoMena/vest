@extends('layout')

@section('title')
	{{$seller->name}} @lang('dashboard.title_products')
@stop

@section('content')

@include('partials/modal')

@foreach($sellerProducts as $product)
	@include('dashboard.sellers.partials.modal')
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
        		<h1><i class='icon-suitcase'></i> 
        			{{$seller->name}}
        		</h1>
            </div>

            @include('dashboard.sellers.partials.seller_info')

			@include('dashboard.partials.messages')
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-header transparent">
							<h2>
								<i class='icon-layers'></i>
								<strong>@lang('dashboard.title_products')</strong>
							</h2>
							<div class="additional-btn">
								<a href="#" class="widget-toggle">
									<i class="icon-down-open-2"></i>
								</a>
							</div>
						</div>
						<div class="widget-content">
							<div class="data-table-toolbar">
								<div class="row">
									<div class="col-md-12">
										@include('dashboard.sellers.partials.search_seller_product')
									</div>
								</div>
							</div>
									
							<div class="table-responsive">
								<table data-sortable class="table table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>@lang('dashboard.table.name')</th>
											<th>@lang('dashboard.table.price')</th>
											<th>@lang('dashboard.table.url')</th>
											<th>@lang('dashboard.table.company')</th>
											<th>@lang('dashboard.table.link_status')</th>
											<th>@lang('dashboard.table.actions')</th>
										</tr>
									</thead>
									<tbody>
										@foreach($sellerProducts as $product)
										<tr>
											<td>{{ $product->id }}</td>
											<td>{{ $product->name }}</td>
											<td>{{ $product->price }}</td>
											<td><a href="{{ $product->url }}" target="_blank">{{ $product->url }}</a></td>
											<td>{{ $product->company->name }}</td>
											<td>
												<span class="{{ ($product->getLinkStatus()) ? 'label label-success' : 'label label-danger'}}">
													{{ trans('dashboard.link_status.'.$product->getLinkStatus()) }}
												</span>
											</td>
											<td>
												<div class="btn-group btn-group-xs">
													{!! Form::open([
														'route' => ['dashboard.sellers.link', $seller->id], 
														'method' => 'GET',
														'class' => 'btn-group btn-group-xs'
													])!!}
														<button type="submit" title="@lang('dashboard.buttons.change_status')" class="btn btn-default">
															<i class="fa fa-power-off"></i>
														</button>
														{!! Form::hidden('product_id', $product->id) !!}
													{!!Form::close()!!}
									
													<a title="@lang('dashboard.buttons.delete')" data-modal="delete-modal-{{$product->id}}" class="btn btn-danger md-trigger ">
														<i class="fa fa-trash-o"></i>
													</a>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
								{!! $sellerProducts->appends(Request::only('nameproduct'))->render() !!}
							</div>
						</div>
					</div>
					<a href="{{route('dashboard.sellers.index')}}" class="btn btn-primary">
						<i class="icon-back"></i>
						@lang('dashboard.buttons.back')
					</a>
				</div>
			</div>

		</div>
		<!-- End content here -->
	
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection