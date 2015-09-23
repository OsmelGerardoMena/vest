@extends('layout')

@section('title')
	@lang('dashboard.title_edit_contract')
@stop

@section('content')

@include('partials/modal')
@include('dashboard.contracts.partials.modal')

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
        			@lang('dashboard.title_edit_contract')
        		</h1>
            </div>

            @include('dashboard.partials.messages')

            <div class="widget">
				<div class="widget-content padding">
					@include('partials.errors')

					{!! Form::model($contract, [
							'route' => ['dashboard.contracts.update', $contract->id],
							'class' => 'form-horizontal',
							'role' => 'form',
							'method' => 'PUT',
							'files' => 'true'
						]) 
					!!}

				  		@include('dashboard.contracts.partials.fields')

					  	<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">
									<i class="icon-edit"></i>
									@lang('dashboard.buttons.edit')
								</button>

								<a href="{{route('dashboard.contracts.index')}}" class="btn btn-primary">
									<i class="icon-back"></i>
									@lang('dashboard.buttons.back')
								</a>
							</div>
						</div>
					{!! Form::close() !!}
					<button data-modal="delete-modal-{{$contract->id}}" class="btn btn-danger btn-sm md-trigger">
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