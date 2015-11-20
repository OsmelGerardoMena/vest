<!-- Modal Delete customer -->
<div class="md-modal md-slide-stick-top" id="delete-modal-{{$customer->id}}">
	<div class="md-content">
		<h3><strong>
			@lang('dashboard.sure_delete_customer')<br>
			@lang('dashboard.delete_sales')
		</strong></h3>
		<div>
			<center>
				<p><button class="btn btn-primary md-close">
					@lang('dashboard.no_delete')
				</button></p>
				{!! Form::open(
						['route' => ['dashboard.customers.destroy', $customer], 
						'method' => 'DELETE'
					]) 
				!!}
  					<button type="submit" class="btn btn-danger">
  						<i class="fa fa-trash-o"></i>
  						@lang('dashboard.yes_delete')
  					</button>
				{!! Form::close() !!}
			</center>
		</div>
	</div>
</div>
<!-- Modal End -->