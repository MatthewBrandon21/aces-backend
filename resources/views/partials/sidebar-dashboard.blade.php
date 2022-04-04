<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/dashboard">ACES</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/dashboard">ACES</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class={{ Request::is('dashboard') ? 'active' : '' }}><a class="nav-link" href="/dashboard"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li class={{ Request::is('tickets') ? 'active' : '' }}><a class="nav-link" href="/dashboard/tickets"><i class="fas fa-ticket-alt"></i> <span>Tickets</span></a></li>

            @can('admin')
                <li class="menu-header">Administrator</li>
                <li class="dropdown {{ Request::is('dashboard/general-configuration*', 'dashboard/gallery*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i><span>Website Settings</span></a>
                    <ul class="dropdown-menu">
                        <li class={{ Request::is('dashboard/general-configuration*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/general-configuration">General Configuration</a></li>
                        <li class={{ Request::is('dashboard/gallery*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/gallery">Gallery</a></li>
                    </ul>
                </li>
                <li class={{ Request::is('dashboard/users*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/users"><i class="fas fa-users"></i> <span>User Management</span></a></li>
                <li class={{ Request::is('admin-tickets') ? 'active' : '' }}><a class="nav-link" href="/dashboard/admin-tickets"><i class="fas fa-ticket-alt"></i> <span>Tickets Inbox</span></a></li>
                <li class="dropdown {{ Request::is('dashboard/posts*', 'dashboard/categories*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-paper-plane"></i><span>ACES Blog</span></a>
                    <ul class="dropdown-menu">
                        <li class={{ Request::is('dashboard/posts*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/posts">Blog Management</a></li>
                        <li class={{ Request::is('dashboard/categories*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/categories">Category Management</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ Request::is('dashboard/openproject*', 'dashboard/labs*', 'dashboard/labs-categories*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-flask"></i><span>ACES Labs</span></a>
                    <ul class="dropdown-menu">
                        <li class={{ Request::is('dashboard/openproject*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/openproject">ACES Open Project</a></li>
                        <li class={{ Request::is('dashboard/labs', 'dashboard/labs/*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/labs">Repository ACES Labs</a></li>
                        <li class={{ Request::is('dashboard/labs-categories*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/labs-categories">Category ACES Labs</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ Request::is('dashboard/aces-works*', 'dashboard/aces-works-gallery*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-briefcase"></i><span>Works</span></a>
                    <ul class="dropdown-menu">
                        <li class={{ Request::is('dashboard/aces-works*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/aces-works">Works Management</a></li>
                        <li class={{ Request::is('dashboard/aces-works-gallery*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/aces-works-gallery">Gallery</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ Request::is('dashboard/generations*', 'dashboard/frontliners*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-seedling"></i><span>ACES</span></a>
                    <ul class="dropdown-menu">
                        <li class={{ Request::is('dashboard/generations*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/generations">ACES Generation</a></li>
                        <li class={{ Request::is('dashboard/frontliners*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/frontliners">ACES Frontliners</a></li>
                    </ul>
                </li>
                <li class={{ Request::is('dashboard/lecturer*') ? 'active' : '' }}><a class="nav-link" href="/dashboard/lecturer"><i class="fas fa-star"></i> <span>CE Lecturer</span></a></li>
            @endcan
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="/dashboard/api-documentation" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> API Documentation
            </a>
        </div>
    </aside>
</div>