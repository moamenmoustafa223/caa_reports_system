<!DOCTYPE html>
<html lang="en" data-layout="topnav">

@include('Employee.layouts.head')

<body dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<!-- Begin page -->
<div class="wrapper">

    <!-- Menu -->
    <!-- Sidenav Menu Start -->
    @include('Employee.layouts.topbar')
    @include('Employee.layouts.horizontal-nav')
    <!-- Sidenav Menu End -->

    <!-- Topbar Start -->
    <!-- Topbar End -->


    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <div class="page-content">
        <div class="page-container">
            @include('flash-message')
            @yield('content')

        </div>

        <!-- Footer Start -->
        @include('Employee.layouts.footer')
        <!-- end Footer -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->


@include('Employee.layouts.script')
@include('sweetalert::alert')

</body>

</html>
