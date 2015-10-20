@extends('layout')

@section('title')
	@lang('dashboard.title_edit_incentive')
@stop

@section('content')

@include('partials/modal')

@can('admin')
	@include('dashboard.incentives.partials.modal')
@endcan

<!-- Begin page -->
<div id="wrapper">
	@include('partials/topbar')
	@include('partials/sidebar')

	<!-- Start right content -->
	<div class="content-page">

		<!-- Start Content here -->
		<div class="content">
			<div class="page-heading">
        		<h1><i class='glyphicon glyphicon-edit'></i> 
        			@lang('dashboard.title_edit_incentive')
        		</h1>
            </div>

            @include('dashboard.partials.messages')

            <div class="widget">
				<div class="widget-content padding">
					@include('partials.errors')

					{!! Form::model($incentive, [
							'route' => ['dashboard.incentives.update', $incentive->id],
							'class' => 'form-horizontal',
							'role' => 'form',
							'method' => 'PUT'
						]) 
					!!}

				  		@include('dashboard.incentives.partials.fields')

					  	<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">
									<i class="icon-edit"></i>
									@lang('dashboard.buttons.edit')
								</button>

								<a href="{{route('dashboard.incentives.index')}}" class="btn btn-primary">
									<i class="icon-back"></i>
									@lang('dashboard.buttons.back')
								</a>
							</div>
						</div>
					{!! Form::close() !!}
					@can('admin')
						<button data-modal="delete-modal-{{$incentive->id}}" class="btn btn-danger btn-sm md-trigger">
							<i class="fa fa-trash-o"></i>
						  	@lang('dashboard.buttons.delete')
						</button>
					@endcan
				</div>
			</div>
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection