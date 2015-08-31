<!-- Modal Delete profile -->
<div class="md-modal md-fade-in-scale-up" id="delete-modal">
	<div class="md-content">
		<h3><strong>@lang('dashboard.sure_delete_profile')</strong></h3>
		<div>
			<center>
				<p><button class="btn btn-primary md-close">
					@lang('dashboard.no_delete')
				</button></p>
				{!! Form::open(['route' => ['dashboard.profiles.destroy', $profile], 'method' => 'DELETE']) !!}
  					<button type="submit" class="btn btn-danger">
  						@lang('dashboard.yes_delete')
  					</button>
				{!! Form::close() !!}
			</center>
		</div>
	</div>
</div>        
<!-- Modal End -->