{!! Form::model(Request::all(),
		[	'route' => ['dashboard.myproducts.index'],
			'method' => 'GET',
			'class' => 'form-inline',
			'rol' => 'search'
		])
!!}
<div class="form-group">
    <a class="btn btn-info" href="{{route('dashboard.myproducts.index')}}">
        <i class="icon-eye-1"></i>
        @lang('dashboard.buttons.seeall')
    </a>
</div>

<div class="form-group">
    {!! Form::text('nameproduct', null, ['class' => 'form-control', 'id' => 'my-text', 'placeholder' => trans('dashboard.ph.search_product')]) !!}
</div>

<button type="submit" class="btn btn-info">
    <i class="icon-search-1"></i>
    @lang('dashboard.buttons.search')
</button>
{!! Form::close() !!}