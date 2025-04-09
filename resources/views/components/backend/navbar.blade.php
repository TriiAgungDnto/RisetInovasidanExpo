<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-th-large"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="{{ route('profile.edit', auth()->id()) }}" class="dropdown-item">
                    Change Profile
                </a>
                <a href="{{ route('profile.password.edit', auth()->id()) }}" class="dropdown-item">
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('form-logout').submit()"
                    class="dropdown-item">Logout</a>
                <form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
