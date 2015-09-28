@extends('layout')

@section('title')
	@lang('dashboard.title_training_info') | {{$training->product->name}}
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
	    		<h1><i class='fa fa-book'></i> 
	    			@lang('dashboard.title_training_info') - {{$training->product->name}}
	    		</h1>
            </div>
            <div class="widget">
				<div class="widget-content padding">
					@if(Auth::user()->isAdmin())
						<a href="{{route('dashboard.trainings.index')}}" class="btn btn-primary">
							<i class="icon-back"></i>
							@lang('dashboard.buttons.back')
						</a>
					@else
						<a href="{{route('dashboard.myproducts.show', $training->product->id)}}" class="btn btn-primary">
							<i class="icon-back"></i>
							@lang('dashboard.buttons.back')
						</a>
					@endif
					<br><br>
					{!! html_entity_decode($training->content) !!}
				</div>
			</div>
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection