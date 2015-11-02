@extends('layout')

@section('title')
	@lang('dashboard.title_404')
@stop

@section('content')

@include('partials/modal')

<!-- Begin page -->
<div class="container">
	<div class="full-content-center animated flipInX">
		<h1>404</h1>
		<h2>@lang('messages.404')</h2><br>
		<a class="btn btn-danger btn-sm" href="{{route('dashboard')}}">
		<i class="fa fa-angle-left"></i> @lang('dashboard.buttons.back_to_dashboard')</a>
	</div>
</div>
<!-- End of page -->
@endsection
