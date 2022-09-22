<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @if (Auth::guard('admin')->user()->can('dashboard.index'))
                    <li class="@yield('home_active')">
                        <a href="{{ route('admin.home') }}">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>
                @endif

                @if (Auth::guard('admin')->User()->can('user.index'))
                    <li class="@yield('user_active')">
                        <a href="{{ route('admin.user.index') }}">
                            <i data-feather="users"></i>
                            <span data-key="t-dashboard">User</span>
                        </a>
                    </li>
                @endif

                @if (Auth::guard('admin')->User()->can('user.index'))
                <li class="@yield('user_role_active')">
                    <a href="{{route('admin.user.role.index')}}">
                        <i data-feather="box"></i>
                        <span data-key="t-dashboard">User role</span>
                    </a>
                </li>
                @endif


                @if (Auth::guard('admin')->user()->can('admin.index') || Auth::guard('admin')->user()->can('role.index'))
                    <li class="@yield('admin_active')">
                        <a href="javascript: void(0);" class="has-arrow" >
                            <i data-feather="users"></i>
                            <span data-key="t-ecommerce">Admin Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (Auth::guard('admin')->user()->can('admin.index'))

                            <li><a class="@yield('admin_admin_active')" href="{{ route('admin.admin.index') }}" key="t-products"><i data-feather="user"></i>Admins</a></li>
                            @endif
                            @if (Auth::guard('admin')->user()->can('role.index'))

                            <li><a class="@yield('admin_roles_active')" href="{{ route('admin.roles.index') }}" data-key="t-product-detail"><i data-feather="user"></i>Roles</a></li>
                            @endif

                        </ul>
                    </li>
               @endif

               @if (Auth::guard('admin')->user()->can('user.index') || Auth::guard('admin')->user()->can('role.index'))
                    <li class="@yield('application_active')">
                        <a href="javascript: void(0);" class="has-arrow" >
                            <i data-feather="users"></i>
                            <span data-key="t-ecommerce">Applications</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (Auth::guard('admin')->User()->can('user.index'))
                                <li class="@yield('application_form_active')">
                                    <a href="{{route('admin.application.index')}}">
                                        <i data-feather="aperture"></i>
                                        <span data-key="t-dashboard">All Applications</span>
                                    </a>
                                </li>
                           @endif
                            @if (Auth::guard('admin')->User()->can('user.index'))
                                <li class="@yield('application_form_create_active')">
                                    <a href="{{ route('admin.application.form.index')}}">
                                        <i data-feather="aperture"></i>
                                        <span data-key="t-dashboard"> Form Element</span>
                                    </a>
                                </li>
                           @endif
                        </ul>
                    </li>
               @endif

                @if (Auth::guard('admin')->user()->can('generalSettings.index') || Auth::guard('admin')->user()->can('configSettings.index'))
                    <li class="@yield('settings_active')">
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="settings"></i>
                            <span data-key="t-">Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="ecommercefalse">
                            @if (Auth::guard('admin')->user()->can('generalSettings.index'))

                            <li><a class="@yield('settings_general_active')" href="{{ route('admin.settings.general') }}"> <i data-feather="corner-down-right"></i>General</a></li>
                            @endif
                            @if (Auth::guard('admin')->user()->can('configSettings.index'))
                            <li><a class="@yield('settings_config_active')" href="{{ route('admin.settings.config') }}"> <i data-feather="corner-down-right"></i>Config</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
