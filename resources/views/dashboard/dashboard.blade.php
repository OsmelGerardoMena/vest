@extends('layout')

@section('title')
	@lang('auth.login_title')
@stop

@section('content')

<body class="fixed-left">
@include('partials/modal')
<!-- Begin page -->
<div id="wrapper">
	@include('partials/topbar')
	@include('partials/sidebar')

	<!-- Start right content -->
	<div class="content-page">

		<!-- Start Content here -->
		<div class="content">
			
			@include('content/home')

		</div>
		<!-- End content here -->
	
	</div>
	<!-- End right content -->

</div>
<!-- End of page -->
@endsection