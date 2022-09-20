<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="javascript:void(0);" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="javascript:void(0);" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="javascript:void(0);" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{asset('images/logo.png')}}" srcset="{{asset('images/logo2x.png 2x')}}" alt="logo">
                <img class="logo-dark logo-img" src="{{asset('images/logo-dark.png')}}" srcset="{{asset('images/logo-dark2x.png 2x')}}" alt="logo-dark">
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="{{ route('dashboard') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('users.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                            <span class="nk-menu-text">Users</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('categories.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                            <span class="nk-menu-text">Categories</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('products.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                            <span class="nk-menu-text">Products</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('translations.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-text2"></em></span>
                            <span class="nk-menu-text">Translations</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('notifications.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-bell"></em></span>
                            <span class="nk-menu-text">Notifications</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('roles.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-pie"></em></span>
                            <span class="nk-menu-text">Roles</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
