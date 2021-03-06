<!-- header & grobal navi -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="{{ route('user.list') }}">CRUD Sample</a>
    @if (!Auth::guest())
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar" aria-controls="Navbar" aria-expanded="true" aria-label="ナビゲーションの切替">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="Navbar" style="">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.list') }}">List</a>
                        @can('admin-higher')
                            <a class="dropdown-item" href="{{ route('user.register.index') }}">Register</a>
                        @endcan
                    </div>
                </li>
                @can('systemadmin-only')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('csv.index') }}">Csv</a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    @endif
</nav>