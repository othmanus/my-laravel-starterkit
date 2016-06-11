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
    {{--
    <ul class="sidebar-menu">
        <li class="treeview {{ Active::route('admin.index') }}">
            <a href="{{ route('admin.index') }}">
                <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
            </a>
        </li>
        <li class="treeview {{ Active::routePattern('admin.subscribers.*') }}">
            <a href="{{ route('admin.subscribers.index') }}">
                <i class="fa fa-users"></i> <span>Abonnés</span>
            </a>
        </li>
        <li class="treeview {{ Active::route('admin.pages.category', 'cital') }}">
            <a href="{{ route('admin.pages.category', 'cital') }}">
                <i class="fa fa-file"></i> <span>Pages - CITAL</span>
            </a>
        </li>
        <li class="treeview {{ Active::route('admin.pages.category', 'services') }}">
            <a href="{{ route('admin.pages.category', 'services') }}">
                <i class="fa fa-road"></i> <span>Pages - Produits & Services</span>
            </a>
        </li>
        <li class="treeview {{ Active::route('admin.pages.category', 'activites') }}">
            <a href="{{ route('admin.pages.category', 'activites') }}">
                <i class="fa fa-bar-chart-o"></i> <span>Pages - Activités</span>
            </a>
        </li>
        <li class="treeview {{ Active::route('admin.pages.category', 'pole') }}">
            <a href="{{ route('admin.pages.category', 'pole') }}">
                <i class="fa fa-train"></i> <span>Pages - Pôle férovière</span>
            </a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-newspaper-o"></i>
                <span>News & Events</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('admin.communiques.index') }}"><i class="fa fa-circle-o"></i> Communiqués de presse</a></li>
                <li><a href="{{ route('admin.revues.index') }}"><i class="fa fa-circle-o"></i> Couvertures médiatiques</a></li>
                <li><a href="{{ route('admin.evenements.index') }}"><i class="fa fa-circle-o"></i> Evènements</a></li>
                <li><a href="{{ route('admin.albums.index') }}"><i class="fa fa-circle-o"></i> Photothèque</a></li>
                <li><a href="{{ route('admin.videos.index') }}"><i class="fa fa-circle-o"></i> Vidéothèque</a></li>
            </ul>
        </li>
        <li class="treeview {{ Active::routePattern('admin.slides.*') }}">
            <a href="{{ route('admin.slides.index') }}">
                <i class="fa fa-picture-o"></i> <span>Slides</span>
            </a>
        </li>
        <li class="treeview {{ Active::routePattern('admin.partners.*') }}">
            <a href="{{ route('admin.partners.index') }}">
                <i class="fa fa-thumbs-o-up"></i> <span>Partenaires</span>
            </a>
        </li>
        <li class="treeview {{ Active::route('admin.settings.index') }}">
            <a href="{{ route('admin.settings.index') }}">
                <i class="fa fa-cog"></i> <span>Configuration</span>
            </a>
        </li>

    </ul>
     --}}
</section>