@extends('layout')

@section('title')
	@lang('dashboard.title_save_edit_invoice')
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
        		<h1><i class='glyphicon glyphicon-barcode'></i> 
        			@lang('dashboard.title_save_edit_invoice')
        		</h1>
            </div>

            <div class="widget">
				<div class="widget-content padding">
					@include('partials.errors')
					@include('dashboard.partials.messages')

					<div class="table-responsive">
						<table data-sortable class="table table-hover table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>@lang('dashboard.table.amount')</th>
									<th>@lang('dashboard.table.quantity')</th>
									<th>@lang('dashboard.table.total')</th>
									<th>@lang('dashboard.table.seller')</th>
									<th>@lang('dashboard.table.product')</th>
									<th>@lang('dashboard.table.customer')</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ $sale->id }}</td>
									<td>{{ $sale->amount }}</td>
									<td>{{ $sale->quantity }}</td>
									<td>{{ $sale->amount * $sale->quantity }}</td>
									<td>{{ $sale->seller->name }}</td>
									<td>{{ $sale->product->name }}</td>
									<td>{{ $sale->customer->name }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<hr>
					<h3 class='text-center'>@lang('dashboard.enter_invoice')</h3>
					{!! Form::model($sale, [
							'route' => ['dashboard.sales.saveinvoice', $sale->id],
							'class' => 'form-horizontal',
							'role' => 'form',
							'method' => 'PUT'
						]) 
					!!}

				  		<div class="form-group">
							{!! Form::label('invoice', trans('validation.attributes.invoice'), ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								{!! Form::text('invoice', null, ['class' => 'form-control', 'placeholder' => trans('dashboard.ph.invoice_number')]) !!}
							</div>
						</div>

					  	<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">
									<i class="icon-edit"></i>
									@lang('dashboard.buttons.save')
								</button>

								<a href="{{route('dashboard.sales.index')}}" class="btn btn-primary">
									<i class="icon-back"></i>
									@lang('dashboard.buttons.back')
								</a>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<!-- End content here -->
	</div>
	<!-- End right content -->
</div>
<!-- End of page -->
@endsection