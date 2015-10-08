@extends('layout')

@section('title')
	@lang('dashboard.title_home')
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
	    		<h1><i class='glyphicon glyphicon-stats'></i> 
	    			@lang('dashboard.title_company_sales')
	    		</h1>
            </div>
			@include('dashboard.companysales.sales')
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection