<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="{{ route('employee.index') }}" class="logo">
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
            <li class="side-nav-item">
                <a href="{{ route('employee.index') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                    <span class="menu-text"> {{ __('back.dashboard') }} </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('employee.reports.index') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-file-text"></i></span>
                    <span class="menu-text"> {{ __('back.my_reports') }} </span>
                </a>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>
</div>
