@extends('layout')

@section('title')
	@lang('dashboard.title_categories_companies')
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
        		<h1><i class='icon-tags'></i>
        			@lang('dashboard.title_categories_companies')
        		</h1>
            </div>
			<div class="widget">
				<div class="widget-header">
					<h2>@lang('dashboard.categories_companies')</h2>
					<div class="additional-btn">
						<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
					</div>
				</div>
				<div class="widget-content padding">
					<ul id="cat" class="nav nav-tabs">
						@foreach ($categories as $category)
							<li class="{{($category->id == 1) ? 'active' : ''}}" id="tab-{{$category->id}}">
								<a href="#cat-{{$category->id}}" data-toggle="tab">{{$category->name}} 
								<span class="label label-danger">
									{{($category->id == 1) ? $category->companies->count()-1 : $category->companies->count()}}
								</span></a>
							</li>
						@endforeach
					</ul>
					<div class="tab-content">
						@foreach ($categories as $category)
							<div class="{{($category->id == 1) ? 'tab-pane fade active in' : 'tab-pane fade'}}" id="cat-{{$category->id}}">
								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped">
										<thead>
											<tr>
												<th>@lang('dashboard.table.name')</th>
												<th>@lang('dashboard.table.email')</th>
												<th>@lang('dashboard.table.phone')</th>
												<th>@lang('dashboard.table.address')</th>
												<th>@lang('dashboard.table.status')</th>
											</tr>
										</thead>
										<tbody>
											@foreach($category->companies as $company)
												@if($company->id != 2)
													<tr>
														<td>{{ $company->name }}</td>
														<td>{{ $company->email }}</td>
														<td>{{ $company->phone }}</td>
														<td>{{ $company->address }}</td>
														<td><span class="{{ ($company->isActive()) ? 'label label-success' : 'label label-danger'}}">
															{{ trans('dashboard.status.'.$company->getStatusId()) }}
														</span></td>
													</tr>
												@endif
											@endforeach
										</tbody>
									</table>
								</div>
							</div> <!-- / .tab-pane -->
						@endforeach
					</div> <!-- / .tab-content -->
				</div>
			</div>
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection