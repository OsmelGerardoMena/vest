@extends('layout')

@section('title')
	@lang('dashboard.title_edit_training')
@stop

@section('content')

@include('partials/modal')
@include('dashboard.trainings.partials.modal')

<!-- Begin page -->
<div id="wrapper">
	@include('partials/topbar')
	@include('partials/sidebar')

	<!-- Start right content -->
	<div class="content-page">

		<!-- Start Content here -->
		<div class="content">
			<div class="page-heading">
        		<h1><i class='icon-book-open-1'></i> 
        			@lang('dashboard.title_edit_training')
        		</h1>
            </div>

            @include('dashboard.partials.messages')

            <div class="widget">
				<div class="widget-content padding">
					@include('partials.errors')

					{!! Form::model($training, [
							'route' => ['dashboard.trainings.update', $training->id],
							'class' => 'form-horizontal',
							'role' => 'form',
							'method' => 'PUT'
						]) 
					!!}

				  		@include('dashboard.trainings.partials.fields')

					  	<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">
									<i class="icon-edit"></i>
									@lang('dashboard.buttons.edit')
								</button>

								<a href="{{route('dashboard.trainings.index')}}" class="btn btn-primary">
									<i class="icon-back"></i>
									@lang('dashboard.buttons.back')
								</a>
							</div>
						</div>
					{!! Form::close() !!}
					<button data-modal="delete-modal-{{$training->id}}" class="btn btn-danger btn-sm md-trigger">
						<i class="fa fa-trash-o"></i>
					  	@lang('dashboard.buttons.delete')
					</button>
				</div>
			</div>
			
		</div>
		<!-- End content here -->
	
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection