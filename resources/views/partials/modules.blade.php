                    <!--- Se injecta las opciones del menu -->
                    @inject('menu', 'Vest\Services\OptionsMenu')
                    @foreach($menu->options() as $module)
                        <li class='has_sub'>
                            <a href=''>
                                <i class="{{ $module['icon'] }}"></i>
                                <span>
                                    @lang('dashboard.sidebar.'.
                                            $module['description'])
                                </span>
                                <span class="pull-right">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                            <ul>
                                @foreach($module['submodule'] as $submodule)
                                    <li>
                                        <a href="{{ $submodule['url'] }}">
                                            <span>
                                                @lang('dashboard.sidebar.'.
                                                        $submodule['description'])
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach