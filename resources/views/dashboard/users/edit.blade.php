@extends('layout')

@section('title')
	@lang('dashboard.title_edit')
@stop

@section('content')

@include('partials/modal')
@include('dashboard.users.partials.modal')

<!-- Begin page -->
<div id="wrapper">
	@include('partials/topbar')
	@include('partials/sidebar')

	<!-- Start right content -->
	<div class="content-page">

		<!-- Start Content here -->
		<div class="content">
			<div class="page-heading">
        		<h1><i class='icon-edit'></i> 
        			@lang('dashboard.title_edit')
        		</h1>
            </div>

            @include('dashboard.partials.messages')

            <div class="widget">
				<div class="widget-content padding">
					@include('partials.errors')

					{!! Form::model($user, [
							'route' => ['dashboard.users.update', $user->id],
							'class' => 'form-horizontal',
							'role' => 'form',
							'method' => 'PUT',
							'files' => 'true'
						]) 
					!!}

				  		@include('dashboard.users.partials.fields')

					  	<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">
									<i class="icon-edit"></i>
									@lang('dashboard.buttons.edit')
								</button>

								<a href="{{route('dashboard.users.index')}}" class="btn btn-primary">
									<i class="icon-back"></i>
									@lang('dashboard.buttons.back')
								</a>
							</div>
						</div>
					{!! Form::close() !!}
					<button data-modal="delete-modal-{{$user->id}}" class="btn btn-danger btn-sm md-trigger">
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