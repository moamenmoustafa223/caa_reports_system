<header class="app-topbar" id="header">
    <div class="page-container topbar-menu">
        <div class="d-flex align-items-center gap-2">

            <!-- Brand Logo -->
            <a href="{{ route('employee.index') }}" class="logo">
                <span class="logo-lg"><img src="{{ asset(App\Models\Setting::first()->logo) }}" alt="logo"></span>
                <span class="logo-sm"><img src="{{ asset(App\Models\Setting::first()->logo) }}" alt="small logo"></span>
            </a>

            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button px-2">
                <i class="ri-menu-5-line fs-24"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="ri-menu-5-line fs-24"></i>
            </button>

            <!-- Topbar Page Title -->
            <div class="topbar-item d-none d-md-flex px-2">

                <div>
                    <h4 class="page-title fs-20 fw-semibold mb-0">@yield('page_title')</h4>
                </div>
            </div>

        </div>

        <div class="d-flex align-items-center gap-2">

            <!-- Language Dropdown -->
            <div class="topbar-item">
                <div class="dropdown">
                    <button class="topbar-link" data-bs-toggle="dropdown" data-bs-offset="0,32" type="button"
                        aria-haspopup="false" aria-expanded="false">
                        {{ LaravelLocalization::getCurrentLocaleName() }}
                        <i class="mdi mdi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item"
                                hreflang="{{ $localeCode }}"href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                data-translator-lang="en">
                                @if ($properties['native'] == 'English')
                                @elseif($properties['native'] == 'العربية')
                                @endif
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Notification Dropdown -->
            <div class="topbar-item me-3">
                <div class="dropdown">
                    @php
                        $unreadCount = auth('employee')->user()->unreadNotifications->count();
                    @endphp
                    <a class="topbar-link drop-arrow-none d-flex" data-bs-toggle="dropdown" data-bs-offset="0,25"
                        type="button" data-bs-auto-close="outside" aria-haspopup="false" aria-expanded="false">
                        <i class="fa fa-bell animate-ring fs-22"></i>
                        <span class="notification-count text-danger" style="font-size: 11px">
                            {{ $unreadCount > 10 ? '10+' : ($unreadCount > 0 ? $unreadCount : 0) }}
                        </span>
                    </a>

                    <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg"
                        style="min-height: 300px; overflow-y: scroll">
                        <div class="p-2 border-bottom position-relative border-dashed">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold">{{ trans('back.notifications') }}</h6>
                                </div>
                                <div class="col-auto">
                                    (<span class="notification-count">{{ $unreadCount }}</span>)
                                </div>
                            </div>
                        </div>

                        <div class="position-relative rounded-0" style="max-height: 300px;" data-simplebar id="notifications-list">
                            @include('Employee.partials.notifications', ['notifications' => auth('employee')->user()->unreadNotifications])
                        </div>
                        <div class="p-2 border-top text-center">
                            <a href="javascript:void(0);" id="mark-all-read" class="btn btn-sm btn-success w-100">
                                <i class="fas fa-check-double"></i> {{ trans('back.mark_all_as_read') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                        data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset(auth()->user()->image ?? 'avatar.png') }}" width="32"
                            class="rounded-circle me-lg-2 d-flex" alt="user-image">
                        <span class="d-lg-flex flex-column gap-1 d-none">
                            <h5 class="my-0">{{ auth()->user()->name_ar }}</h5>
                        </span>
                        <i class="ri-arrow-down-s-line d-none d-lg-block align-middle ms-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <form method="POST" action="{{ route('employee_logout') }}">
                            @csrf
                            <a href="javascript:void(0);" class="dropdown-item active fw-semibold text-danger"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>
                                <span>{{ trans('back.logout') }} </span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
