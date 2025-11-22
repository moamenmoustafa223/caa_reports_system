<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="logo">
        <span class="logo-lg"><img src="{{ asset(App\Models\Setting::first()->logo) }}" style="height: 65px"
                alt="logo"></span>
        <span class="logo-sm"><img src="{{ asset(App\Models\Setting::first()->logo) }}" alt="small logo"></span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ri-circle-line align-middle"></i>
    </button>

    <!-- Sidebar Menu Toggle Button -->
    <button class="sidenav-toggle-button">
        <i class="ri-menu-5-line fs-20"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div data-simplebar>
        <!--- SidenavSidenav Menu -->
        <ul class="side-nav">
            {{-- Dashboard --}}
            @can('dashboard')
                <li class="side-nav-item">
                    <a href="{{ route('dashboard.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-layout-dashboard"></i></span>
                        <span class="menu-text">{{ __('back.dashboard') }}</span>
                    </a>
                </li>
            @endcan

            {{-- Employee Categories --}}
            @can('CategoryEmployees')
                <li class="side-nav-item">
                    <a href="{{ route('CategoryEmployees.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-users-group"></i></span>
                        <span class="menu-text">{{ __('back.employee_categories') }}</span>
                    </a>
                </li>
            @endcan

            {{-- Employees --}}
            @can('Employees')
                <li class="side-nav-item">
                    <a href="{{ route('Employees.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-users"></i></span>
                        <span class="menu-text">{{ __('back.employees') }}</span>
                    </a>
                </li>
            @endcan





            {{-- Reports --}}
            @can('reports')
                <li class="side-nav-item">
                    <a href="{{ route('reports.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-file-report"></i></span>
                        <span class="menu-text">{{ __('back.reports') }}</span>
                    </a>
                </li>
            @endcan

            {{-- Locations --}}
            @can('locations')
                <li class="side-nav-item">
                    <a href="{{ route('locations.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-map-pin"></i></span>
                        <span class="menu-text">{{ __('back.locations') }}</span>
                    </a>
                </li>
            @endcan

            {{-- Severity Levels --}}
            @can('severity_levels')
                <li class="side-nav-item">
                    <a href="{{ route('severity_levels.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-alert-triangle"></i></span>
                        <span class="menu-text">{{ __('back.severity_levels') }}</span>
                    </a>
                </li>
            @endcan

            {{-- Report Statuses --}}
            @can('report_statuses')
                <li class="side-nav-item">
                    <a href="{{ route('report_statuses.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-list-check"></i></span>
                        <span class="menu-text">{{ __('back.report_statuses') }}</span>
                    </a>
                </li>
            @endcan

            {{-- Safety Tips --}}
            @can('safety_tips')
                <li class="side-nav-item">
                    <a href="{{ route('safety_tips.index') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-shield-check"></i></span>
                        <span class="menu-text">{{ __('back.safety_tips') }}</span>
                    </a>
                </li>
            @endcan
            
            {{-- ⚙️ System Settings --}}
            @canany(['users', 'roles', 'Setting'])
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarsetting" aria-expanded="false"
                        aria-controls="sidebarsetting" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-settings"></i></span>
                        <span class="menu-text">{{ __('back.system_setting') }}</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarsetting">
                        <ul class="sub-menu">
                            @can('users')
                                <li class="side-nav-item">
                                    <a href="{{ route('users.index') }}" class="side-nav-link">
                                        <span class="menu-text">{{ __('users.users') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('roles')
                                <li class="side-nav-item">
                                    <a href="{{ route('roles.index') }}" class="side-nav-link">
                                        <span class="menu-text">{{ __('back.roles') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('Setting')
                                <li class="side-nav-item">
                                    <a href="{{ route('Setting.index') }}" class="side-nav-link">
                                        <span class="menu-text">{{ __('back.Setting') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
