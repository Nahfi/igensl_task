<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('user_page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="BIR it basic project" name="description" />
    <meta content="bir it" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('photo/settings/general') }}/{{ generalSettings()->favicon }}">
    @include('layouts.user.includes.css')

</head>

    <body data-topbar="dark">

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div >

           {{--  @include('layouts.user.includes.header')  --}}

            <!-- ========== Left Sidebar Start ========== -->
              {{--  @include('layouts.user.includes.left_sidebar')  --}}
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

                <div class="">

                    @yield('user_content')
                    <!-- End Page-content -->
                    {{--  @include('layouts.user.includes.footer')  --}}
                </div>

            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
          @include('layouts.user.includes.right_sidebar')
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        @include('layouts.user.includes.js')
    </body>
</html>
