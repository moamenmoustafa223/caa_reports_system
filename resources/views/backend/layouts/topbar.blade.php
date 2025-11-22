<header class="app-topbar" id="header">
    <div class="page-container topbar-menu">
        <div class="d-flex align-items-center gap-2">

            <!-- Brand Logo -->
            <a href="{{ route('dashboard.index') }}" class="logo">
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

            <!-- Search for small devices -->
            <div class="topbar-item d-flex d-xl-none">
                <button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">
                    <i class="ri-search-line fs-22"></i>
                </button>
            </div>


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
            {{-- @include('vendor.notification', ['guard' => 'web']) --}}



            {{-- الإشعارات --}}
            <div class="topbar-item me-3">
                <div class="dropdown">
                    @php
                        $unreadCount = auth()->user()->unreadNotifications->count();
                        $totalNotifications = $unreadCount ;
                    @endphp
                    <a class="topbar-link drop-arrow-none d-flex" data-bs-toggle="dropdown" data-bs-offset="0,25"
                        type="button" data-bs-auto-close="outside" aria-haspopup="false" aria-expanded="false">
                        <i class="fa fa-bell animate-ring fs-22"></i>
                        <span class="notification-count text-danger" style="font-size: 11px">
                            {{ $totalNotifications > 10 ? '10+' : ($totalNotifications > 0 ? $totalNotifications : 0) }}
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
                                    (<span class="notification-count">{{ $totalNotifications }}
                                    </span>)
                                </div>
                            </div>
                        </div>

                        <div class="position-relative rounded-0" style="max-height: 300px;" data-simplebar>
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <div
                                    class="dropdown-item notification-item py-2 text-wrap {{ $notification->read_at ? '' : 'active' }} notification-{{ $notification->id }}">
                                    <span class="d-flex align-items-center">
                                        <span class="me-3 position-relative flex-shrink-0">
                                            <i class="ri-notification-snooze-line fs-20"></i> {{-- أيقونة الإشعار --}}
                                        </span>
                                        @if($notification->data['report_id'] ?? null)
                                            @can('reports')
                                                <a href="{{ route('reports.show', $notification->data['report_id']) }}" class="flex-grow-1 text-muted">
                                            @else
                                                <span class="flex-grow-1 text-muted">
                                            @endcan
                                        @else
                                            <span class="flex-grow-1 text-muted">
                                        @endif
                                            <span
                                                class="fw-medium text-body">{{ $notification->data['title'] ?? 'إشعار جديد' }}</span>
                                            <br />
                                            <span
                                                class="fs-12">{{ $notification->created_at->diffForHumans() }}</span>
                                        @if($notification->data['report_id'] ?? null)
                                            @can('reports')
                                                </a>
                                            @else
                                                </span>
                                            @endcan
                                        @else
                                            </span>
                                        @endif
                                        <span class="notification-item-close">
                                            <a href="{{ route('markAsRead', $notification->id) }}"
                                                class="dropdown-item" title="{{ trans('back.mark_as_read') }}">
                                                <i class="fa fa-check text-success"></i>
                                            </a>
                                        </span>
                                    </span>
                                </div>
                            @empty
                                <p class="dropdown-item text-center text-primary notify-item notify-all">
                                    {{ trans('back.not_found_notification') }}
                                </p>
                            @endforelse

                        
                        </div>

                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <a href="{{ route('markAsRead_all') }}"
                                class="dropdown-item text-center text-primary notify-item notify-all p-2">
                                {{ trans('dashboard.Clear_all') }}
                                <i class="fi-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                        data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset(auth()->user()->image ?? 'avatar.png') }}" width="32"
                            class="rounded-circle me-lg-2 d-flex" alt="user-image">
                        <span class="d-lg-flex flex-column gap-1 d-none">
                            <h5 class="my-0">{{ auth()->user()->name }}</h5>
                        </span>
                        <i class="ri-arrow-down-s-line d-none d-lg-block align-middle ms-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <form method="POST" action="{{ route('logout') }}">
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
