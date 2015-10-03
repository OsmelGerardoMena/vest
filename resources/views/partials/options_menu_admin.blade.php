<li class='has_sub'>
    <a href=''>
        <i class='icon-users'></i>
        <span>@lang('dashboard.sidebar.users')</span> 
        <span class="pull-right">
            <i class="fa fa-angle-down"></i>
        </span>
    </a>
    <ul>
        <li>
            <a href="{{asset('/dashboard/users')}}">
                <span>@lang('dashboard.sidebar.list_users')</span>
            </a>
        </li>
        <li>
            <a href="{{asset('/dashboard/users/create')}}">
                <span>@lang('dashboard.sidebar.add_user')</span>
            </a>
        </li>
        <li>
            <a href="{{asset('/dashboard/companies')}}">
                <span>@lang('dashboard.sidebar.list_companies')</span>
            </a>
        </li>
        <li>
            <a href="{{asset('/dashboard/sellers')}}">
                <span>@lang('dashboard.sidebar.list_sellers')</span>
            </a>
        </li>
    </ul>
</li>

<li class='has_sub'>
    <a href=''>
        <i class='icon-layers'></i>
        <span>@lang('dashboard.sidebar.products')</span> 
        <span class="pull-right">
            <i class="fa fa-angle-down"></i>
        </span>
    </a>
    <ul>
        <li>
            <a href="{{asset('/dashboard/products')}}">
                <span>@lang('dashboard.sidebar.list_products')</span>
            </a>
        </li>
        <li>
            <a href="{{asset('/dashboard/products/create')}}">
                <span>@lang('dashboard.sidebar.add_product')</span>
            </a>
        </li>
        <li>
            <a href="{{asset('/dashboard/contracts')}}">
                <span>@lang('dashboard.sidebar.contracts')</span>
            </a>
        </li>
        <li>
            <a href="{{asset('/dashboard/benefits')}}">
                <span>@lang('dashboard.sidebar.benefits')</span>
            </a>
        </li>
        <li>
            <a href="{{asset('/dashboard/incentives')}}">
                <span>@lang('dashboard.sidebar.incentives')</span>
            </a>
        </li>
        <li>
            <a href="{{asset('/dashboard/trainings')}}">
                <span>@lang('dashboard.sidebar.trainings')</span>
            </a>
        </li>
    </ul>
</li>

<li class='has_sub'>
    <a href=''>
        <i class='icon-smiley'></i>
        <span>@lang('dashboard.sidebar.customers')</span> 
        <span class="pull-right">
            <i class="fa fa-angle-down"></i>
        </span>
    </a>
    <ul>
        <li>
            <a href="{{asset('/dashboard/customers')}}">
                <span>@lang('dashboard.sidebar.list_customers')</span>
            </a>
        </li>
    </ul>
</li>

<li class='has_sub'>
    <a href=''>
        <i class='glyphicon glyphicon-stats'></i>
        <span>@lang('dashboard.sidebar.sales')</span> 
        <span class="pull-right">
            <i class="fa fa-angle-down"></i>
        </span>
    </a>
    <ul>
        <li>
            <a href="{{asset('/dashboard/sales')}}">
                <span>@lang('dashboard.sidebar.list_sales')</span>
            </a>
        </li>
    </ul>
</li>