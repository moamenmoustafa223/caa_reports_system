<!-- Horizontal Menu Start -->
<header class="topnav">
    <nav class="navbar navbar-expand-lg">
        <nav class="page-container">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    {{-- Dashboard --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employee.index') }}">
                            <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                            <span class="menu-text"> {{ __('back.dashboard') }} </span>
                        </a>
                    </li>
                    {{-- My Reports --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employee.reports.index') }}">
                            <span class="menu-icon"><i class="ti ti-file-text"></i></span>
                            <span class="menu-text"> {{ __('back.my_reports') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </nav>
</header>
<!-- Horizontal Menu End -->
