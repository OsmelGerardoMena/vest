@extends('layout')

@section('title')
	@lang('passwords.title_reset')
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
					@include('partials/errors')
					@include('partials.messages')
					{!! Form::open(['url' => '/password/email', 'method' => 'post', 'role' => 'form']) !!}

						<div class="form-group login-input">
							<i class="fa fa-envelope-o overlay"></i>
							{!! Form::email('email', null, ['class' => 'form-control text-input', 'placeholder' => trans('validation.attributes.email')])!!}
						</div>

						<div class="row">
							<div class="col-sm-12">
								{!! Form::submit(trans('passwords.send_link'), ['class' => 'btn btn-success btn-block']) !!}
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection