<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ asset('back/img/avatar5.png') }}" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Bonjour</p>

            <a href="#"><i class="fa fa-circle text-success"></i> En ligne</a>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="treeview {{ Active::route('admin.index') }}">
            <a href="{{ route('admin.index') }}">
                <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
            </a>
        </li>
        <li class="treeview {{ Active::routePattern('admin.users.*') }}">
            <a href="{{ route('admin.users.index') }}">
                <i class="fa fa-users"></i> <span>Utilisateurs</span>
            </a>
        </li>
        <li class="treeview {{ Active::routePattern('admin.pages.*') }}">
            <a href="{{ route('admin.pages.index') }}">
                <i class="fa fa-file"></i> <span>Pages</span>
            </a>
        </li>

        <li class="treeview {{ Active::route('admin.settings.index') }}">
            <a href="{{ route('admin.settings.index') }}">
                <i class="fa fa-cog"></i> <span>Configuration</span>
            </a>
        </li>
    </ul>
</section>