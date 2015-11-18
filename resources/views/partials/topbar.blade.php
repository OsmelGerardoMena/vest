<!-- Top Bar Start -->
<div class="topbar">
    <div class="topbar-left">
        <div class="logo">
            <h1><a href="#"><img src="{{asset('assets/img/logo.png')}}" alt="Logo Vest"></a></h1>
        </div>
        <button class="button-menu-mobile open-left">
        <i class="fa fa-bars"></i>
        </button>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-collapse2">
                <ul class="nav navbar-nav navbar-right top-navbar">
                    @can('seller')
                    <li class="dropdown iconify hide-phone">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" title="@lang('dashboard.buttons.notifications')">
                            <i class="icon-bell-1"></i><span class="label label-danger absolute" id='noti-count'>0</span></a>
                        <ul class="dropdown-menu dropdown-message">
                            <li class="dropdown-header notif-header"><i class="icon-bell-2"></i> @lang('dashboard.buttons.new_notifications')</li>
                            <li class="unread">
                                <!-- aqui se ingresan las notifiaciones a traves de ajax, si no hay aparece el mensaje -->
                                <a href="#"><p><strong>@lang('messages.no_new_noti')</strong></p></a>
                            </li>
                            <li class="dropdown-footer">
                                <div class="">
                                    <a href="{{route('dashboard.notifications.index')}}" class="btn btn-sm btn-block btn-warning"><i class="fa fa-share"></i> @lang('dashboard.buttons.seeall_notifications')</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    <li class="dropdown topbar-profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="rounded-image topbar-profile-image">
                                @if(Auth::user()->hasFile())
                                    <img src="{{asset('assets/photos/'.Auth::user()->photo)}}">
                                @endif
                            </span>
                            <strong>{{Auth::user()->name}}</strong> 
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('dashboard.account.index')}}">@lang('dashboard.title_account')</a></li>
                            <li><a href="{{route('dashboard.account.edit', Auth::user()->id)}}">@lang('dashboard.change_password')</a></li>
                            <li class="divider"></li>
                            @can('seller')
                                <li>
                                    <a href="{{route('dashboard.notifications.index')}}">
                                        <i class="icon-bell-1"></i> 
                                        {{trans_choice('dashboard.title_notifications', 2)}}
                                    </a>
                                </li>
                            @endcan
                            <li><a href="{{route('dashboard.help.index')}}">
                                <i class="icon-help-2"></i> @lang('dashboard.help')</a>
                            </li>
                            <li><a class="md-trigger" data-modal="logout-modal">
                                <i class="icon-logout-1"></i> @lang('dashboard.logout')</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End -->