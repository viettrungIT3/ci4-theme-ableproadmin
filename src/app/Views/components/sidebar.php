<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="<?= base_url('dashboard') ?>" class="b-brand text-primary">
                <img src="<?= base_url('assets/images/icon-admin.svg') ?>" class="img-fluid logo-lg" alt="logo">

                <span class="badge bg-light-success rounded-pill ms-2 theme-version">v1.0.0</span>
            </a>
        </div>
        <div class="navbar-content">
            <div class="card pc-user-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="/assets/images/user/avatar-1.jpg" alt="user-image"
                                class="user-avtar wid-45 rounded-circle">
                        </div>
                        <div class="flex-grow-1 ms-3 me-2">
                            <h6 class="mb-0">Jonh Smith</h6>
                            <small>Administrator</small>
                        </div>
                        <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse"
                            href="#pc_sidebar_userlink">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3">
                            <a href="#!">
                                <i class="ti ti-user"></i>
                                <span>My Account</span>
                            </a>
                            <a href="#!">
                                <i class="ti ti-settings"></i>
                                <span>Settings</span>
                            </a>
                            <a href="#!">
                                <i class="ti ti-lock"></i>
                                <span>Lock Screen</span>
                            </a>
                            <a href="#!">
                                <i class="ti ti-power"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-status-up"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                        <span class="pc-badge">2</span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard') ?>">Default</a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/analytics') ?>">Analytics</a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/finance') ?>">Finance</a>
                        </li>
                    </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-document"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Layouts</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/layouts/vertical') ?>">Vertical</a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/layouts/horizontal') ?>">Horizontal</a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/layouts/compact') ?>">Compact</a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/layouts/tab') ?>">Tab</a>
                        </li>
                    </ul>
                </li>
                <li class="pc-item pc-caption">
                    <label>Admin Panel</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-layer"></use>
                    </svg>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-user"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Users</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/users') ?>">List Users</a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/users/create') ?>">Add User</a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/users/roles') ?>">User Roles</a>
                        </li>
                    </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-setting-2"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Settings</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/settings/general') ?>">General</a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/settings/theme') ?>">Theme</a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('dashboard/settings/security') ?>">Security</a>
                        </li>
                    </ul>
                </li>
                <li class="pc-item pc-caption">
                    <label>Other</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-notification-status"></use>
                    </svg>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('dashboard/help') ?>" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-24-support"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Help & Support</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->