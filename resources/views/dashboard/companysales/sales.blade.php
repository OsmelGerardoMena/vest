<h4><strong>@lang('dashboard.per_product'):</strong></h4>
<div class="row top-summary">
	@foreach($products as $product)
		<div class="col-lg-3 col-md-3">
			<div class="widget green-3 animated fadeInDown">
				<div class="widget-content padding">
					<div class="widget-icon"></div>
					<div class="text-box">
						<p class="maindata"><b>{{$product['product_name']}}</b></p>
						<h2><span class="animate-number" data-value="{{$product['count']}}" data-duration="3000">0</span></h2>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="widget-footer">
					<div class="row">
						<div class="col-sm-12">
							<i class="glyphicon glyphicon-saved"></i>
							@lang('dashboard.total_sales')
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	@endforeach
</div>

<h4><strong>@lang('dashboard.per_seller'):</strong></h4>
<div class="row top-summary">
	@foreach($sellers as $seller)
		<div class="col-lg-3 col-md-3">
			<div class="widget orange-2 animated fadeInDown">
				<div class="widget-content padding">
					<div class="widget-icon"></div>
					<div class="text-box">
						<p class="maindata"><b>{{$seller['seller_name']}}</b></p>
						<h2><span class="animate-number" data-value="{{$seller['count']}}" data-duration="3000">0</span></h2>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="widget-footer">
					<div class="row">
						<div class="col-sm-12">
							<i class="glyphicon glyphicon-saved"></i>
							@lang('dashboard.total_sales')
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	@endforeach
</div>

<!--<div class="row">
	<div class="widget">
		<div class="widget-header ">
			<h2>Ventas por productos</h2>
			<div class="additional-btn">
				<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
			</div>
		</div>
		<div class="widget-content padding">
			<span 
				class="sparkline" 
				sparkType="bar" 
				values="8, 5, 3, 6" 
				sparkHeight="250px" 
				sparkWidth="100%" 
				sparkbarColor="#FC5B3F" 
				sparkbarWidth="50"></span>
		</div>
	</div>
</div>
<span class="sparkline" sparktype="pie" values="3,5,6" sparkheight="250px">
	<canvas width="250" height="250" style="display: inline-block; width: 250px; height: 250px; vertical-align: top;"></canvas>
</span>-->