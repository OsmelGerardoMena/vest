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
				<div class="widget-header ">
					<h2><strong>@lang('dashboard.training_file')</strong></h2>
					<div class="additional-btn">
						<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
					</div>
				</div>
				<div class="widget-content padding">
					@if($training->fileExists())
						<a href="{{ asset('files/trainings') }}/{{ $training->training_file }}" target="_blank">
							@lang('dashboard.download_training')
						</a>
					@else
						<h4>@lang('dashboard.not_found')</h4>
					@endif
				</div>
			</div>

            <div class="widget">
				<div class="widget-content padding">
					@can('admin')
						<a href="{{route('dashboard.trainings.index')}}" class="btn btn-primary">
							<i class="icon-back"></i>
							@lang('dashboard.buttons.back')
						</a>
					@else
						<a href="{{route('dashboard.myproducts.show', $training->product->id)}}" class="btn btn-primary">
							<i class="icon-back"></i>
							@lang('dashboard.buttons.back')
						</a>
					@endcan
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