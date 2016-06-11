<!DOCTYPE html>
<html>
<head>
   @include('back.layouts._css')

   @yield('head')
</head>

<body class="skin-blue">

   <div class="wrapper">

    <!-- header logo: style can be found in header.less -->
    <header class="main-header">
        <a href="{{ route('admin.index') }}" class="logo">
            {{ $settings['site_name']->to_string }}
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="user user-menu">
                        <a href="{{ url('/') }}" target="_blank" class="dropdown-toggle">
                            <i class="fa fa-laptop"></i>
                            <span>Voir le site</span>
                        </a>
                    </li>
                    <li class="user user-menu">
                        <a href="{{-- route('auth.logout') --}}" class="dropdown-toggle">
                            <i class="fa fa-user"></i>
                            <span>Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        @include('back.layouts.sidebar')
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('content-header')
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section><!-- /.content -->
    </aside><!-- /.right-side -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs"><b>Version</b> 1.0</div>
        <strong>Copyright &copy; 2015 <a href="http://www.mgsd-dz.com" target="_blank">MGSD</a>.</strong> Tous droits réservés.
    </footer>
</div><!-- ./wrapper -->

@include('back.layouts._js')

@include('back.layouts._modal_delete')

@yield('javascript')
</body>
</html>