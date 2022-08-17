<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Butterfly Message | @yield('title')</title>
    <!-- GLOBAL MAINLY STYLES-->
    @include('layouts.stylesheet')
    <!-- PAGE LEVEL STYLES-->
</head>
<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand" style="background-color: #1600a1;">
                <a class="link" href="/">
                    <span class="brand">
                        <span class="brand-tip">Butterfly Message</span>
                    </span>
                    <span class="brand-mini">BM</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <li class="dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                        <img src="{{asset('assets/img/admin-avatar.png')}}" />
                        <span></span>{{ Session::get('user')->nama }}<i class="fa fa-angle-down m-l-5"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a>
                        <a class="dropdown-item" href="profile.html"><i class="fa fa-cog"></i>Settings</a> -->
                        <a class="dropdown-item" href="/laporan/r"><i class="fa fa-support"></i>....</a>
                        <li class="dropdown-divider"></li>
                        <form method="post" action="/logout">
                            @csrf
                            <button class="dropdown-item">
                        </form>
                        <i class="fa fa-power-off"></i>Logout</a>
                    </ul>
                </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->

        @include('layouts.sidebar')
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->

            @yield('content')

            <!-- END PAGE CONTENT-->

            @include('layouts.footer')
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->

    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <!-- <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div> -->
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->

    @include('layouts.javascript')
    @yield('extra_javascript')
</body>

</html>