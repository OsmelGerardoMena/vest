<!-- Left Sidebar Start -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="clearfix"></div>
        <!--- Profile -->
        <div class="profile-info">
            <div class="col-xs-4">
                <a href="{{route('dashboard.account.index')}}" class="rounded-image profile-image">
                    @if(Auth::user()->hasFile())
                        <img src="{{asset('assets/photos/'.Auth::user()->photo)}}">
                    @endif
                </a>
            </div>
            <div class="col-xs-8">
                <div class="profile-text">
                    @lang('dashboard.welcome') 
                    <b>{{ Auth::user()->name }}</b>
                </div>
                <div class="profile-buttons">
                    <a href="{{route('dashboard.notifications.index')}}" title="@lang('dashboard.buttons.notifications')">
                        <i class="fa fa-bell-o"></i>
                    </a>
                    <a class="md-trigger" data-modal="logout-modal" title="@lang('dashboard.logout')">
                        <i class="fa fa-power-off text-red-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <!--- Divider -->
        <div class="clearfix"></div>
        <hr class="divider" />
        <div class="clearfix"></div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li class='has_sub'>
                    <a href='' id='start-link'>
                        <i class='icon-home-3'></i>
                        <span>@lang('dashboard.sidebar.dash')</span> 
                        <span class="pull-right">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        <li>
                            <!-- con class='active' aparece desglosado el menu -->
                            <a href="{{route('dashboard')}}" >
                                <span>@lang('dashboard.sidebar.start')</span>
                            </a>
                        </li>
                        @can('seller')
                            <li>
                                <a href="http://cloud.8ssi.com/~softwar3/crm/app/index.php/zurmo/api/login?username={{Auth::user()->email}}&password=1234567" >
                                    <span>@lang('dashboard.sidebar.crm')</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('admin')
                    @include('partials.options_menu_admin')
                @else
                    @include('partials.options_menu_user')
                @endcan
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->