@extends('layout')

@section('title')
	@lang('dashboard.title_notifications')
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
        			@lang('dashboard.title_notifications')
        		</h1>
            </div>

            <div class="panel-group" id="collapse">
			 	<div class="panel panel-red-1">
			    	<div class="panel-heading">
			      		<h4 class="panel-title">
				        	<a data-toggle="collapse" data-parent="#accordion" href="#rnotifications">
				          		<i class="icon-bell-2"></i>Incentives notifications
				          		<span class="label bg-darkblue-1 pull-right">4</span>
				        	</a>
			      		</h4>
			    	</div>
			   		<div id="rnotifications" class="panel-collapse collapse in">
			      		<div class="panel-body">
					      	<ul class="list-unstyled" id="notification-list">
					      		<li><a href="javascript:;"><span class="icon-wrapper"><i class="icon-video"></i></span> 1 Video Uploaded <span class="muted">12 minutes ago</span></a></li>
					      		<li><a href="javascript:;"><span class="icon-wrapper"><i class="icon-users-1"></i></span> 3 Users signed up <span class="muted">16 minutes ago</span></a></li>
					      		<li><a href="javascript:;"><span class="icon-wrapper"><i class="icon-picture-1"></i></span> 1 Video Uploaded <span class="muted">12 minutes ago</span></a></li>
					      		<li><a href="javascript:;"><span class="icon-wrapper"><i class="icon-hourglass-1"></i></span> Deadline for 1 project <span class="muted">12 minutes ago</span></a></li>
					      	</ul>
			      			<a class="btn btn-block btn-sm btn-warning">See all notifications</a>
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