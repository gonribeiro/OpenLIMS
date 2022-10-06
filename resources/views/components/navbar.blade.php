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
                        <li><a class="dropdown-item" href="{{ route('sample.index') }}"><i class="fa-solid fa-vial"></i> &nbsp; Samples</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-vials"></i> &nbsp; Subsamples</a></li>
                        <li><a class="dropdown-item" href="{{ route('incident.index') }}"><i class="fa-solid fa-person-falling-burst"></i> &nbsp; Incidents</a></li>
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
                        <li><a class="dropdown-item" href="{{ route('user.index') }}"><i class="fa-solid fa-user"></i> &nbsp; Users and Customers</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('analysis.index') }}"><i class="fa-solid fa-microscope"></i> &nbsp; Analysis</a></li>
                        <li><a class="dropdown-item" href="{{ route('storage.index') }}"><i class="fa-solid fa-box-archive"></i> &nbsp; Storages</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-mug-hot"></i> &nbsp; About</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <a class="navbar-brand" href="#">{{ config('app.name', 'OpenLIMS') }}</a>
    </div>
</nav>