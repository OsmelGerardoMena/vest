@if($seller->productExists($product['id']))
					{!! Form::checkbox($product['name'], $product['id'], true) !!}
				@else
					{!! Form::checkbox($product['name'], $product['id']) !!}
				@endif