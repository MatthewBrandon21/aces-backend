<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{  url('') }}/dashboard">
                <img src="{{ asset('') }}assets/img/Logo Aces Horizontal.png" alt="logo" width="100">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{  url('') }}/dashboard">ACES</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class={{ Request::is('dashboard') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li class={{ Request::is('dashboard/ticket*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/ticket"><i class="fas fa-ticket-alt"></i> <span>Tickets</span></a></li>
            @cannot('admin')
            <li class="dropdown {{ Request::is('dashboard/memberlabs*', 'dashboard/imagefolder*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-flask"></i><span>ACES Labs</span></a>
                <ul class="dropdown-menu">
                    <li class={{ Request::is('dashboard/memberlabs*', 'dashboard/memberlabs/*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/memberlabs">Repository ACES Labs</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class={{ Request::is('dashboard/imagefolder*', 'dashboard/imagefolder/*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/imagefolder">Image Folder</a></li>
                </ul>
            </li>
            @endcannot

            @can('admin')
                <li class="menu-header">Administrator</li>
                <li class="dropdown {{ Request::is('dashboard/websiteconfiguration*', 'dashboard/websitegallery*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i><span>Website Settings</span></a>
                    <ul class="dropdown-menu">
                        <li class={{ Request::is('dashboard/websiteconfiguration*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/websiteconfiguration">General Configuration</a></li>
                        <li class={{ Request::is('dashboard/websitegallery*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/websitegallery">Gallery</a></li>
                    </ul>
                </li>
                <li class={{ Request::is('dashboard/users*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/users"><i class="fas fa-users"></i> <span>User Management</span></a></li>
                <li class={{ Request::is('dashboard/admin-ticket*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/admin-ticket"><i class="fas fa-ticket-alt"></i> <span>Tickets Inbox</span></a></li>
                <li class={{ Request::is('dashboard/admin-contactus*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/admin-contactus"><i class="fas fa-envelope"></i> <span>Contact Us Inbox</span></a></li>
                <li class="dropdown {{ Request::is('dashboard/posts*', 'dashboard/categories*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-paper-plane"></i><span>ACES Blog</span></a>
                    <ul class="dropdown-menu">
                        <li class={{ Request::is('dashboard/posts*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/posts">Blog Management</a></li>
                        <li class={{ Request::is('dashboard/categories*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/categories">Category Management</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ Request::is('dashboard/openproject*', 'dashboard/labs*', 'dashboard/labs-categories*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-flask"></i><span>ACES Labs</span></a>
                    <ul class="dropdown-menu">
                        <li class={{ Request::is('dashboard/openproject*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/openproject">ACES Open Project</a></li>
                        <li class={{ Request::is('dashboard/labs', 'dashboard/labs/*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/labs">Repository ACES Labs</a></li>
                        <li class={{ Request::is('dashboard/labs-categories*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/labs-categories">Category ACES Labs</a></li>
                    </ul>
                </li>
                {{-- <li class="dropdown {{ Request::is('dashboard/aces-works*', 'dashboard/aces-works-gallery*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-briefcase"></i><span>Works</span></a>
                    <ul class="dropdown-menu">
                        <li class={{ Request::is('dashboard/aces-works*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/aces-works">Works Management</a></li>
                        <li class={{ Request::is('dashboard/aces-works-gallery*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/aces-works-gallery">Gallery</a></li>
                    </ul>
                </li> --}}
                <li class="dropdown {{ Request::is('dashboard/generations*', 'dashboard/frontliners*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-seedling"></i><span>ACES</span></a>
                    <ul class="dropdown-menu">
                        <li class={{ Request::is('dashboard/generations*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/generations">ACES Generation</a></li>
                        <li class={{ Request::is('dashboard/frontliners*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/frontliners">ACES Frontliners</a></li>
                    </ul>
                </li>
                <li class={{ Request::is('dashboard/lecturers*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/lecturers"><i class="fas fa-star"></i> <span>CE Lecturer</span></a></li>
                <li class={{ Request::is('dashboard/adminimagefolder*') ? 'active' : '' }}><a class="nav-link" href="{{  url('') }}/dashboard/adminimagefolder"><i class="fas fa-images"></i> <span>Image Folder</span></a></li>
            @endcan
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            @can('admin')
                <a href="https://github.com/MatthewBrandon21/aces-backend" target="_blank" class="btn btn-primary btn-lg btn-block btn-icon-split">
                    <i class="fas fa-rocket"></i> API Documentation
                </a>
            @endcan
        </div>
    </aside>
</div>