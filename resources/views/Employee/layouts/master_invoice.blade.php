<!DOCTYPE html>
<html lang="en">
    @include('Student.layouts.head')

    <body data-layout="horizontal" data-topbar="light" >

        <div id="wrapper">
            <div class="content-page" style="padding-top: 10px">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">

                        @yield('content')

                    </div> <!-- container-fluid -->
                </div> <!-- content -->
            </div>
        </div>

        @include('Student.layouts.script')
    </body>
</html>
