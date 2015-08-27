{!! Form::open(['route' => ['dashboard.users.destroy', $user], 'method' => 'DELETE']) !!}
  	<button type="submit" onclick="return confirm('Seguro que quieres eliminar?')" class="btn btn-danger">
  		<i class="fa fa-trash-o"></i>
  		@lang('dashboard.buttons.delete')
  	</button>
{!! Form::close() !!}