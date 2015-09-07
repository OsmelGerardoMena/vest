@extends('layout')

@section('title')
	@lang('auth.login_title')
@stop

@section('content')

<body class="fixed-left login-page">
@include('partials/modal')
<!-- Begin page -->
	<div class="container">
		<div class="full-content-center">
			<p class="text-center"><a href="#"><img src="{{asset('assets/img/login-logo.png')}}" alt="Logo"></a></p>
			<div class="login-wrap animated flipInX">
				<div class="login-block">
					<img src="{{asset('assets/images/users/default-user.png')}}" class="img-circle not-logged-avatar">
					@include('partials/errors')
					<!-- <form role="form" method="POST" action="{{ asset('/login') }}"> -->
					{!! Form::open(['url' => '/login', 'method' => 'post', 'role' => 'form']) !!}

						<div class="form-group login-input">
							<i class="fa fa-user overlay"></i>
							{!! Form::email('email', null, ['class' => 'form-control text-input', 'placeholder' => trans('validation.attributes.email')])!!}
						</div>

						<div class="form-group login-input">
							<i class="fa fa-key overlay"></i>
							{!! Form::password('password', ['class' => 'form-control text-input', 'placeholder' => '********']) !!}
						</div>

						<div class="from-group login-input">
        					{!! Form::checkbox('remember', null) !!}@lang('validation.attributes.remember')
    					</div>

						<div class="row">
							<div class="col-sm-6">
								{!! Form::submit(trans('auth.login_button'), ['class' => 'btn btn-success btn-block']) !!}
							</div>
						</div>
						<a href="/password/email">@lang('auth.forgot_passwd')</a>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection