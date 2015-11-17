@extends('layout')

@section('title')
	{{trans_choice('dashboard.title_notifications', 2)}}
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
        			{{trans_choice('dashboard.title_notifications', 2)}}
        		</h1>
            </div>

            <div class="panel-group" id="collapse">
			 	<div class="panel panel-red-1">
			    	<div class="panel-heading">
			      		<h4 class="panel-title">
				        	<a data-toggle="collapse" data-parent="#accordion" href="#rnotifications">
				          		<i class="icon-bell-2"></i> @lang('dashboard.incentives_notifications')
				          		<span class="label bg-darkblue-1 pull-right">{{$count}}</span>
				        	</a>
			      		</h4>
			    	</div>
			   		<div id="rnotifications" class="panel-collapse collapse in">
			      		<div class="panel-body">
					      	<ul class="list-unstyled" id="notification-list">
					      		@foreach($notifications as $notification)
						      		<li><a href="{{route('dashboard.notifications.show', $notification->id)}}">
						      			<span class="icon-wrapper"><i class="icon-star-3"></i></span> {{$notification->title}}
						      			<span class="{{ ($notification->read) ? 'label label-success  pull-right' : 'label label-warning  pull-right'}}">
						      				{{ ($notification->read) ? trans('messages.read') : trans('messages.unread')}}
										</span>
						      			<span class="muted">{{ $notification->created_at->format('d/m/Y') }}</span>
						      			</a>
						      		</li>
					      		@endforeach
					      	</ul>
			      			<!--<a class="btn btn-block btn-sm btn-warning">See all notifications</a>-->
			      		</div>
			    	</div>
			  	</div>
			</div>

		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection