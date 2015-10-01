@extends('layout')

@section('title')
	@lang('dashboard.title_info_customer') | {{ $customer->name }}
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
        		<h1><i class='icon-smiley-circled'></i> 
        			@lang('dashboard.title_customer_info')
        		</h1>
            </div><br>
			<div class="row">
				<div class="col-sm-3">
					<!-- Begin user profile -->
					<div class="text-center user-profile-2">
						<h4>
							<strong>{{ $customer->name }}</strong>
						</h4>
						<!-- User button -->
						<div class="user-button">
							<div class="row">
								<div class="col-lg-6">
									<a href="{{route('dashboard.customers.edit', $customer->id)}}" 
											class="btn btn-warning btn-sm btn-block">
										<i class="icon-edit"></i>
										@lang('dashboard.buttons.edit_data')
									</a>
								</div>
								<div class="col-lg-6">
									<a href="{{route('dashboard.customers.index')}}" 
											class="btn btn-primary btn-sm btn-block">
										<i class="icon-back"></i>
										@lang('dashboard.buttons.back')
									</a>
								</div>
							</div>
						</div><!-- End div .user-button -->
					</div><!-- End div .text-center user-profile-2 -->
					<!-- End user profile -->
				</div><!-- End div .col-sm-3 -->
				<div class="col-sm-9">
					<div class="widget widget-tabbed">
						<!-- Nav tab -->
						<ul class="nav nav-tabs nav-justified">
							<li class="active">
								<a href="#about" data-toggle="tab" aria-expanded="true">
									<i class="icon-info-circled"></i>
									@lang('dashboard.buttons.info')
								</a>
							</li>
							<li class="">
								<a href="#sales" data-toggle="tab" aria-expanded="false">
									<i class="icon-layers"></i>
									@lang('dashboard.buttons.related_sales')
								</a>
							</li>
						</ul><!-- End nav tab -->
						<!-- Tab panes -->
						<div class="tab-content">
							<!-- Tab about -->
							<div class="tab-pane animated fadeInRight active" id="about">
								<div class="user-profile-content">
									<div class="row">
										<div class="col-sm-6">
											<h5><strong>
												{{strtoupper(trans('dashboard.table.status'))}}:
											</strong></h5>
											<span class="{{ ($customer->getStatus()) ? 'label label-success' : 'label label-danger'}}">
												@lang('dashboard.link_status.'.$customer->getStatus())
											</span>

											<h5><strong>
												{{strtoupper(trans('dashboard.table.address'))}}:
											</strong></h5>
											<p>
												<i class="icon-address"></i>
												{{ $customer->address }}
											</p>

											<h5><strong>
												{{strtoupper(trans('dashboard.table.identifier'))}}:
											</strong></h5>
											<p>
												<i class="icon-barcode"></i>
												{{ $customer->identifier }}
											</p>
										</div>

										<div class="col-sm-6">
											<h5><strong>
												{{strtoupper(trans('dashboard.table.city'))}}:
											</strong></h5>
											<p>
												<i class="icon-location-1"></i>
												{{ $customer->city }}
											</p>

											<h5><strong>
												{{strtoupper(trans('dashboard.table.state'))}}:
											</strong></h5>
											<p>
												<i class="icon-location-1"></i>
												{{ $customer->state }}
											</p>
										</div>
									</div><!-- End div .row -->
								</div><!-- End div .user-profile-content -->
							</div><!-- End div .tab-pane -->
							<!-- End Tab about -->
							<!-- Tab timeline -->
							<div class="tab-pane animated fadeInRight" id="sales">
								<div class="user-profile-content">
									@if($customer->sales()->exists())
										@include('dashboard.customers.partials.sales')
									@else
										<center>
											<h5><strong>
												@lang('messages.no_sales')
											</strong></h5>
	 									</center>
									@endif
								</div><!-- End div .user-profile-content -->
							</div><!-- End div .tab-pane -->
							<!-- End Tab timeline -->
						</div><!-- End div .tab-content -->
					</div><!-- End div .widget widget-tabbed -->
				</div><!-- End div .col-sm-9 -->
			</div><!-- End div .row -->
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection