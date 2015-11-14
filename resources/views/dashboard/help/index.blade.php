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
			<h2>Falta la información</h2>
		</div>
		<!-- End content here -->
	
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection