@extends('layout')

@section('title')
	@lang('dashboard.title_help')
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
        		<h1><i class='icon-help-circled-alt'></i> 
        			@lang('dashboard.title_help')
        		</h1>
            </div>
            <div class="col-sm-12">
	            <div class="widget yellow-1">
					<div class="widget-header">
						<h2><strong>
							@lang('messages.support')
							<i class="icon-arrow-curved"></i>
						</strong></h2>
						<div class="additional-btn">
							<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
						</div>
					</div>
					<div class="widget-content padding">
						<h3>
							* @lang('dashboard.table.email'):
						</h3>
						<h4>
							<i class="icon-mail-1"></i>
							<strong>soporte@back-office.info</strong>
						</h4>
						<br>
						<h3>
							* @lang('dashboard.telephone'):
						</h3>
						<h4>
							<i class="icon-phone"></i>
							<strong>+507 3999441</strong>
						</h4>				
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