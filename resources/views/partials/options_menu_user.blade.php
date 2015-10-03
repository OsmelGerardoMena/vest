<li class='has_sub'>
    <a href=''>
        <i class='glyphicon glyphicon-th-list'></i>
        <span>@lang('dashboard.sidebar.my_products')</span> 
        <span class="pull-right">
            <i class="fa fa-angle-down"></i>
        </span>
    </a>
    <ul>
        <li>
            <a href="{{asset('/dashboard/my-products')}}">
                <span>@lang('dashboard.sidebar.my_products_list')</span>
            </a>
        </li>
    </ul>
</li>

@if(Auth::user()->isSeller())
    <li class='has_sub'>
        <a href=''>
            <i class='fa fa-money'></i>
            <span>@lang('dashboard.sidebar.my_sales')</span> 
            <span class="pull-right">
                <i class="fa fa-angle-down"></i>
            </span>
        </a>
        <ul>
            <li>
                <a href="{{asset('/dashboard/algo')}}">
                    <span>@lang('dashboard.sidebar.my_sales')</span>
                </a>
            </li>
        </ul>
    </li>
@endif