<!DOCTYPE html>
<html lang="en" data-layout="">

@include('backend.layouts.head')

<style>
    body {
        background-image: url('{{ asset('bg.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

<body dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<!-- Begin page -->
<div class="wrapper">

    <!-- Menu -->
    <!-- Sidenav Menu Start -->
    @include('backend.layouts.sidenav')
    <!-- Sidenav Menu End -->

    <!-- Topbar Start -->
    @include('backend.layouts.topbar')
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
        @include('backend.layouts.footer')
        <!-- end Footer -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->


@include('backend.layouts.script')
@include('sweetalert::alert')

</body>

</html>
