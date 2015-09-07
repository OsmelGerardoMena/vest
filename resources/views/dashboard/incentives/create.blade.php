@extends('layout')

@section('title')
	@lang('dashboard.title_create_incentive')
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
            		<h1>
            			<i class='icon-star-half_empty'></i>
            			@lang('dashboard.title_create_incentive')
            		</h1>
            </div>

            <div class="widget">
				<div class="widget-content padding">
					@include('partials.errors')
					{!! Form::open([
							'route' => 'dashboard.incentives.store', 
							'method' => 'POST', 
							'class' => 'form-horizontal',
							'role' => 'form'
						]) 
					!!}
				  		@include('dashboard.incentives.partials.fields')

					  	<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-plus-circle"></i>
									@lang('dashboard.buttons.create')
								</button>

								<a href="{{route('dashboard.incentives.index')}}" class="btn btn-primary">
									<i class="icon-back"></i>
									@lang('dashboard.buttons.back')
								</a>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection