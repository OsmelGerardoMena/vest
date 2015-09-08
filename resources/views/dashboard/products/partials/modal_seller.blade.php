<!-- Modal Delete product -->
<div class="md-modal md-slide-stick-top" id="delete-modal-{{$seller->id}}">
	<div class="md-content">
		<h3>
			<strong>@lang('dashboard.sure_delete_seller')<br>
			{{$seller->name}}</strong>
		</h3>
		<div>
			<center>
				<p><button class="btn btn-primary md-close">
					@lang('dashboard.no_delete')
				</button></p>
				{!! Form::open(
						['route' => ['dashboard.product-sellers.destroy', $product->id], 
						'method' => 'DELETE'
					]) 
				!!}

					{!! Form::hidden('seller_id', $seller->id, ['class' => 'form-control']) !!}

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