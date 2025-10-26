<?php
/**
 * Sidebar Navigation Component.
 *
 * Responsive sidebar navigation with user profile and menu items
 *
 * @param array $user User information (name, role, avatar)
 * @param array $menuItems Navigation menu items
 * @param string $activeItem Currently active menu item
 * @param bool $collapsed Whether sidebar is collapsed
 */

// Default values
$user = $user ?? ['name' => 'Jonh Smith', 'role' => 'Administrator', 'avatar' => '/assets/images/user/avatar-1.jpg'];
$menuItems = $menuItems ?? [];
$activeItem = $activeItem ?? '';
$collapsed = $collapsed ?? false;
?>
<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar <?= $collapsed ? 'collapse' : '' ?>">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="<?= base_url() ?>" class="b-brand text-primary">
                <!-- Logo -->
                <img src="<?= base_url('themes/able-pro-admin/assets/images/logo-dark.svg') ?>"
                    class="img-fluid logo-lg" alt="Able Pro Logo">
                <span class="badge bg-light-success rounded-pill ms-2 theme-version">v9.4.1</span>
            </a>
        </div>

        <div class="navbar-content">
            <!-- User Profile Card -->
            <div class="card pc-user-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="<?= base_url($user['avatar']) ?>" alt="user-image"
                                class="user-avtar wid-45 rounded-circle">
                        </div>
                        <div class="flex-grow-1 ms-3 me-2">
                            <h6 class="mb-0"><?= esc($user['name']) ?></h6>
                            <small><?= esc($user['role']) ?></small>
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
                            <a href="<?= base_url('profile') ?>">
                                <i class="ti ti-user"></i> <span>My Account</span>
                            </a>
                            <a href="<?= base_url('settings') ?>">
                                <i class="ti ti-settings"></i> <span>Settings</span>
                            </a>
                            <a href="<?= base_url('lock-screen') ?>">
                                <i class="ti ti-lock"></i> <span>Lock Screen</span>
                            </a>
                            <a href="<?= base_url('auth/logout') ?>">
                                <i class="ti ti-power"></i> <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <ul class="pc-navbar">
                <?php foreach ($menuItems as $menu): ?>
                    <?php if (isset($menu['caption'])): ?>
                        <!-- Category Caption -->
                        <li class="pc-item pc-caption">
                            <label><?= esc($menu['caption']) ?></label>
                        </li>
                    <?php else: ?>
                        <!-- Menu Item -->
                        <li
                            class="pc-item <?= !empty($menu['submenu']) ? 'pc-hasmenu' : '' ?> <?= $activeItem === $menu['id'] ? 'active' : '' ?>">
                            <a href="<?= !empty($menu['submenu']) ? '#!' : (isset($menu['url']) ? $menu['url'] : base_url(strtolower($menu['id']))) ?>"
                                class="pc-link">
                                <?php if (!empty($menu['icon'])): ?>
                                    <span class="pc-micon">
                                        <svg class="pc-icon">
                                            <use xlink:href="#<?= esc($menu['icon']) ?>"></use>
                                        </svg>
                                    </span>
                                <?php endif; ?>
                                <span class="pc-mtext"><?= esc($menu['title']) ?></span>

                                <?php if (!empty($menu['badge'])): ?>
                                    <span class="pc-badge"><?= esc($menu['badge']) ?></span>
                                <?php endif; ?>

                                <?php if (!empty($menu['submenu'])): ?>
                                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                                <?php endif; ?>
                            </a>

                            <?php if (!empty($menu['submenu'])): ?>
                                <ul class="pc-submenu">
                                    <?php foreach ($menu['submenu'] as $submenu): ?>
                                        <li class="pc-item <?= $activeItem === $submenu['id'] ? 'active' : '' ?>">
                                            <a class="pc-link"
                                                href="<?= isset($submenu['url']) ? $submenu['url'] : base_url(strtolower($submenu['id'])) ?>">
                                                <?= esc($submenu['title']) ?>
                                            </a>

                                            <?php if (!empty($submenu['submenu'])): ?>
                                                <ul class="pc-submenu">
                                                    <?php foreach ($submenu['submenu'] as $subsubmenu): ?>
                                                        <li class="pc-item">
                                                            <a class="pc-link"
                                                                href="<?= isset($subsubmenu['url']) ? $subsubmenu['url'] : base_url(strtolower($subsubmenu['id'])) ?>">
                                                                <?= esc($subsubmenu['title']) ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->