<!-- Brand Logo -->
<a href="{{ route('dashboard.index') }}" class="brand-link d-flex flex-column align-items-center">
    <img src="{{ asset('assets/logo/rie-white.png') }}" alt="Riset Inovasi dan Expo" class="brand-image">
</a>

<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}"
                    class="nav-link {{ request()->is('backend/dashboard') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p class="text">Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('activity.index') }}"
                    class="nav-link {{ request()->is('backend/activity') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-snowboarding"></i>
                    <p class="text">Activity</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('poster.index') }}"
                    class="nav-link {{ request()->is('backend/poster') ? 'active' : ''}}">
                    <i class="nav-icon fab fa-windows"></i>
                    <p class="text">Poster</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('partner.index') }}"
                    class="nav-link {{ request()->is('backend/partner') ? 'active' : ''}}">
                    <i class="nav-icon far fa-handshake"></i>
                    <p class="text">Partner</p>
                </a>
            </li>

            <li class="nav-header">Riset &amp; Inovation</li>

            <li class="nav-item">
                <a href="{{ route('conference.index') }}"
                    class="nav-link {{ request()->is('backend/conference') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-users"></i>
                    <p class="text">Conference</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('grant.index') }}"
                    class="nav-link {{ request()->is('backend/grant') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-hand-holding-usd"></i>
                    <p class="text">Grant</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('journal.index') }}"
                    class="nav-link {{ request()->is('backend/journal') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-journal-whills"></i>
                    <p class="text">Journal</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('book.index') }}" class="nav-link {{ request()->is('backend/book') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-book"></i>
                    <p class="text">Book</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('haki.index') }}" class="nav-link {{ request()->is('backend/haki') ? 'active' : ''}}">
                    <i class="nav-icon fa fa-copyright"></i>
                    <p class="text">HAKI</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('innovation.index') }}"
                    class="nav-link {{ request()->is('backend/innovation') ? 'active' : ''}}">
                    <i class="nav-icon fa fa-lightbulb"></i>
                    <p class="text">Innovation</p>
                </a>
            </li>

            <li class="nav-header">Information</li>
            <li class="nav-item">
                <a href="{{ route('major.index') }}"
                    class="nav-link {{ request()->is('backend/major') || request()->is('backend/major/create') ? 'active' : '' }}">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p class="text">Major</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('member.index') }}"
                    class="nav-link {{ request()->is('backend/member') || request()->is('backend/member/create')  ? 'active' : '' }}">
                    <i class="nav-icon far fa-user"></i>
                    <p class="text">Member</p>
                </a>
            </li>


            <li class="nav-header">Others</li>

            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-laptop"></i>
                    <p class="text">Main Website</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->