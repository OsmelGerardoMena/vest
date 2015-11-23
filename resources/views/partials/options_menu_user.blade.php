<li class='has_sub'>
    <a href='' id='my-product'>
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
        @can('company')
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
        @endcan
    </ul>
</li>

@can('seller')
     <li class='has_sub'>
        <a href='' id='product'>
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
                <a href="{{asset('/dashboard/categories-and-companies')}}">
                    <span>@lang('dashboard.sidebar.list_categories')</span>
                </a>
            </li>
            <li>
                <a href="{{asset('/dashboard/companies')}}">
                    <span>@lang('dashboard.sidebar.list_companies')</span>
                </a>
            </li>
        </ul>
    </li>

    <li class='has_sub'>
        <a href='' id='customer'>
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
        <a href='' id='sale'>
            <i class='glyphicon glyphicon-stats'></i>
            <span>@lang('dashboard.sidebar.my_sales')</span> 
            <span class="pull-right">
                <i class="fa fa-angle-down"></i>
            </span>
        </a>
        <ul>
            <li>
                <a href="{{route('dashboard.sales.index')}}">
                    <span>@lang('dashboard.sidebar.my_sales')</span>
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('company')
    <li class='has_sub'>
        <a href='' id='sale'>
            <i class='glyphicon glyphicon-stats'></i>
            <span>@lang('dashboard.sidebar.sales')</span> 
            <span class="pull-right">
                <i class="fa fa-angle-down"></i>
            </span>
        </a>
        <ul>
            <li>
                <a href="{{route('dashboard.sales.index')}}">
                    <span>@lang('dashboard.sidebar.list_sales')</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.companysales.index')}}">
                    <span>@lang('dashboard.sidebar.counting_sales')</span>
                </a>
            </li>
        </ul>
    </li>
@endcan