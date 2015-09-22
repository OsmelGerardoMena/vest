@extends('layout')

@section('title')
	@lang('dashboard.title_info')
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
        		<h1><i class='icon-user'></i> 
        			@lang('dashboard.title_info')
        		</h1>
            </div>
			
			<div class="row">
				<div class="col-sm-3">
					<!-- Begin user profile -->
					<div class="text-center user-profile-2">
						<h4>
							<strong>{{ $user->name }}</strong>
						</h4>
						<h5>{{$user->type->name}}</h5>

						<!-- User button -->
						<div class="user-button">
							<div class="row">
								<div class="col-lg-6">
									<a href="{{route('dashboard.users.edit', $user->id)}}" 
											class="btn btn-warning btn-sm btn-block">
										<i class="icon-edit"></i>
										@lang('dashboard.buttons.edit_data')
									</a>
								</div>
								<div class="col-lg-6">
									<a href="{{route('dashboard.users.index')}}" 
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
							@if(!$user->isAdmin())
								<li class="">
									<a href="#products" data-toggle="tab" aria-expanded="false">
										<i class="icon-layers"></i>
										@lang('dashboard.buttons.products')
									</a>
								</li>
							@endif
						</ul><!-- End nav tab -->

						<!-- Tab panes -->
						<div class="tab-content">
							<!-- Tab about -->
							<div class="tab-pane animated fadeInRight active" id="about">
								<div class="user-profile-content">
									<center>
										<img src="{{asset('assets/images/users/user-256.jpg')}}" class="img-circle profile-image">
									</center><hr>
									<div class="row">
										<div class="col-sm-6">
											<h5><strong>
												{{strtoupper(trans('dashboard.table.status'))}}:
											</strong></h5>
											<span class="{{ ($user->isActive()) ? 'label label-success' : 'label label-danger'}}">
												@lang('dashboard.status.'.$user->getStatusId())
											</span>

											<h5><strong>
												{{strtoupper(trans('dashboard.table.email'))}}:
											</strong></h5>
											<p>
												<i class="icon-mail-1"></i>
												{{ $user->email }}
											</p>

											<h5><strong>
												{{strtoupper(trans('dashboard.table.identifier'))}}:
											</strong></h5>
											<p>
												<i class="icon-barcode"></i>
												{{ $user->identifier }}
											</p>
										</div>

										<div class="col-sm-6">
											<h5><strong>
												{{strtoupper(trans('dashboard.table.mobile'))}}:
											</strong></h5>
											<p>
												<i class="glyphicon glyphicon-phone"></i>
												{{ $user->mobile }}
											</p>

											<h5><strong>
												{{strtoupper(trans('dashboard.table.phone'))}}:
											</strong></h5>
											<p>
												<i class="icon-phone"></i>
												{{ $user->phone }}
											</p>

											<h5><strong>
												{{strtoupper(trans('dashboard.table.address'))}}:
											</strong></h5>
											<p>
												<i class="icon-address"></i>
												{{ $user->address }}
											</p>
										</div>
									</div><!-- End div .row -->
								</div><!-- End div .user-profile-content -->
							</div><!-- End div .tab-pane -->
							<!-- End Tab about -->
							@if(!$user->isAdmin())
								<!-- Tab timeline -->
								<div class="tab-pane animated fadeInRight" id="products">
									<div class="user-profile-content">
										@if(!empty($products))
											<h5><strong>
												{{strtoupper(trans('dashboard.title_products'))}}:
											</strong></h5>
											@include('dashboard.account.partials.info_products')
										@else
											<center>
												<h5><strong>
													@lang('messages.no_products')
												</strong></h5>
		 									</center>
										@endif
									</div><!-- End div .user-profile-content -->
								</div><!-- End div .tab-pane -->
								<!-- End Tab timeline -->
							@endif
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