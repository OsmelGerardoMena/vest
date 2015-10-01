@extends('layout')

@section('title')
	@lang('dashboard.title_edit_sale')
@stop

@section('content')

@include('partials/modal')
@include('dashboard.sales.partials.modal')

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
        			@lang('dashboard.title_edit_sale')
        		</h1>
            </div>

            @include('dashboard.partials.messages')
            <div class="widget">
				<div class="widget-content padding">
					@include('partials.errors')

					{!! Form::model($sale, [
							'route' => ['dashboard.sales.update', $sale->id],
							'class' => 'form-horizontal',
							'role' => 'form',
							'method' => 'PUT'
						]) 
					!!}

				  		@include('dashboard.sales.partials.fields')

					  	<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">
									<i class="icon-edit"></i>
									@lang('dashboard.buttons.edit')
								</button>

								<a href="{{route('dashboard.sales.index')}}" class="btn btn-primary">
									<i class="icon-back"></i>
									@lang('dashboard.buttons.back')
								</a>
							</div>
						</div>
					{!! Form::close() !!}
					<button data-modal="delete-modal-{{$sale->id}}" class="btn btn-danger btn-sm md-trigger">
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