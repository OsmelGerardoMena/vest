@extends('layout')

@section('title')
	@lang('dashboard.title_info_sale')
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
        			@lang('dashboard.title_info_sale')
        		</h1>
            </div>

        	<a href="{{route('dashboard.sales.index')}}" class="btn btn-primary">
				<i class="icon-back"></i>
				@lang('dashboard.buttons.back')
			</a><br><br>

			@cannot('seller')
            	@include('dashboard.sales.partials.seller_info')
            @endcan
            @include('dashboard.sales.partials.product_info')
            @include('dashboard.sales.partials.customer_info')
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection