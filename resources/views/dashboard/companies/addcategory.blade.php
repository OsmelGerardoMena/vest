@extends('layout')

@section('title')
	@lang('dashboard.title_add_category')
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
        		<h1><i class='glyphicon glyphicon-tag'></i> 
        			@lang('dashboard.title_add_category')
        		</h1>
            </div>

            @include('dashboard.partials.messages')

            <div class="widget">
				<div class="widget-content padding">
					@include('partials.errors')

					{!! Form::model($company, [
							'route' => ['dashboard.companies.update', $company->id],
							'class' => 'form-horizontal',
							'role' => 'form',
							'method' => 'PUT'
						]) 
					!!}

				  		@include('dashboard.companies.partials.field_category')

					  	<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-plus"></i>
									@lang('dashboard.buttons.add_category')
								</button>

								<a href="{{route('dashboard.companies.index')}}" class="btn btn-primary">
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