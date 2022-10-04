<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavDarkDropdown"
            aria-controls="navbarNavDarkDropdown"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a
                        class="nav-link"
                        href="#"
                        id="navbarDarkDropdownMenuLink"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="fa-solid fa-bars"></i> Menu
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('sample.index') }}">Samples</a></li>
                        <li><a class="dropdown-item" href="#">Subsamples</a></li>
                        <li><a class="dropdown-item" href="#">Tests</a></li>
                        <li><a class="dropdown-item" href="#">Results</a></li>
                        <li><a class="dropdown-item" href="#">Incidents / NC</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link"
                        href="#"
                        id="navbarDarkDropdownMenuLink"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="fa-solid fa-gear"></i> System
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('user.index') }}">Users and Customers</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('analysis.index') }}">Analysis</a></li>
                        <li><a class="dropdown-item" href="{{ route('storage.index') }}">Storages</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">About / FAQ</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <a class="navbar-brand" href="#">{{ config('app.name', 'OpenLIMS') }}</a>
    </div>
</nav>