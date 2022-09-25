<div class="btn-group btn-group-sm" role="group">
    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Delete
    </button>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
        <li>
            <a
                class="dropdown-item"
                href="#"
                onclick='deleteRecord(`{{ $urlDestroy }}`, `{{ $urlRedirect }}`)'
            >
                Confirm Delete
            </a>
        </li>
    </ul>
</div>