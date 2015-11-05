@extends('layout')

@section('title')
	{{trans_choice('dashboard.title_notifications', 1)}}
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
        		<h1><i class='icon-bell-1'></i>
        			{{trans_choice('dashboard.title_notifications', 1)}}
        		</h1>
            </div>

            <div class="panel-group" id="collapse">
			 	<div class="panel panel-red-1">
			    	<div class="panel-heading">
			      		<h4 class="panel-title">
				        	<a data-toggle="collapse" data-parent="#accordion" href="#rnotifications">
				          		<i class="fa fa-thumbs-up"></i> {{$notification->title}}
				          		<span class="label bg-darkblue-1 pull-right">
				          			{{ $notification->created_at->format('d/m/Y') }}
				          		</span>
				        	</a>
			      		</h4>
			    	</div>
			   		<div id="rnotifications" class="panel-collapse collapse in">
			      		<div class="panel-body">
					      	<h4>{{$notification->content}}</h4>
			      		</div>
			    	</div>

			  	</div>
			</div>
			<a href="{{route('dashboard.notifications.index')}}" class="btn btn-primary">
				<i class="icon-back"></i>
				@lang('dashboard.buttons.back')
			</a>
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection