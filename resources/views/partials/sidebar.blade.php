<!-- Left Sidebar Start -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
           <!-- Search form -->
            <!--<form role="search" class="navbar-form">
                <div class="form-group">
                    <input type="text" placeholder="Search" class="form-control">
                    <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                </div>
            </form>-->
            <div class="clearfix"></div>
            <!--- Profile -->
            <div class="profile-info">
                <div class="col-xs-4">
                  <a href="profile.html" class="rounded-image profile-image">
                    <img src="{{asset('assets/images/users/user-100.jpg')}}">
                </a>
                </div>
                <div class="col-xs-8">
                    <div class="profile-text">@lang('dashboard.welcome') <b>Jane</b></div>
                    <div class="profile-buttons">
                      <!--<a href="javascript:;"><i class="fa fa-envelope-o pulse"></i></a>-->
                      <!--<a href="#connect" class="open-right"><i class="fa fa-comments"></i></a>-->
                        <a class="md-trigger" data-modal="logout-modal" title="Sign Out">
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
                        <a href='javascript:void(0);'>
                            <i class='icon-home-3'></i>
                            <span>@lang('dashboard.sidebar.dash')</span> 
                            <span class="pull-right">
                                <i class="fa fa-angle-down"></i>
                            </span>
                        </a>
                        <ul>
                            <li>
                                <a href='#' class='active'>
                                    <span>@lang('dashboard.sidebar.start')</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class='has_sub'>
                        <a href='javascript:void(0);'>
                            <i class='icon-layers'></i>
                            <span>@lang('dashboard.sidebar.users')</span>
                            <span class="pull-right">
                                <i class="fa fa-angle-down"></i>
                            </span>
                        </a>
                        <ul>
                            <li>
                                <a href='#'>
                                    <span>@lang('dashboard.sidebar.list')</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="clearfix"></div>

            <!--<div class="portlets">
                <div id="chat_groups" class="widget transparent nomargin">
                    <h2>Chat Groups</h2>
                    <div class="widget-content">
                        <ul class="list-unstyled">
                            <li><a href="javascript:;"><i class="fa fa-circle-o text-red-1"></i> Colleagues</a></li>
                            <li><a href="javascript:;"><i class="fa fa-circle-o text-blue-1"></i> Family</a></li>
                            <li><a href="javascript:;"><i class="fa fa-circle-o text-green-1"></i> Friends</a></li>
                        </ul>
                    </div>
                </div>

                <div id="recent_tickets" class="widget transparent nomargin">
                    <h2>Recent Tickets</h2>
                    <div class="widget-content">
                        <ul class="list-unstyled">
                            <li>
                                <a href="javascript:;">My wordpress blog is broken <span>I was trying to save my page and...</span></a>
                            </li>
                            <li>
                                <a href="javascript:;">Server down, need help!<span>My server is not responding for the last...</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div><br><br><br>-->
        </div>

        <!-- <div class="left-footer">
            <div class="progress progress-xs">
                <div class="progress-bar bg-green-1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="progress-precentage">80%</span>
                </div>
                <a data-toggle="tooltip" title="See task progress" class="btn btn-default md-trigger" data-modal="task-progress"><i class="fa fa-inbox"></i></a>
            </div>
        </div> -->
    </div>
<!-- Left Sidebar End -->