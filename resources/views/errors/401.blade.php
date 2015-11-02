@extends('layout')

@section('title')
	@lang('dashboard.title_401')
@stop

@section('content')

@include('partials/modal')

<!-- Begin page -->
<div class="container">
	<div class="full-content-center animated flipInX">
		<h1>401</h1>
		<h2>@lang('messages.401')</h2><br>
		<a class="btn btn-danger btn-sm" href="{{route('dashboard')}}">
		<i class="fa fa-angle-left"></i> @lang('dashboard.buttons.back_to_dashboard')</a>
	</div>
</div>
<!-- End of page -->
@endsection