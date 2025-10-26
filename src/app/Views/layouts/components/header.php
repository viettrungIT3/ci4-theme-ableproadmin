<?php
/**
 * Header/Topbar Component.
 *
 * Responsive header with search, notifications, theme toggle, and user profile
 *
 * @param string $pageTitle Current page title
 * @param array $user Current user information
 * @param array $notifications Notification items
 */

// Default values
$pageTitle = $pageTitle ?? 'Dashboard';
$user = $user ?? ['name' => 'Carson Darrin', 'avatar' => '/assets/images/user/avatar-2.jpg', 'email' => '[email protected]'];
$notifications = $notifications ?? [];
?>
<!-- [ Header Topbar ] start -->
<header class="pc-header">
    <div class="header-wrapper">
        <!-- Mobile Menu & Search -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <!-- Menu collapse icon -->
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                
                <!-- Mobile menu popup -->
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                
                <!-- Search -->
                <li class="pc-h-item d-none d-md-inline-flex">
                    <form class="form-search">
                        <i class="search-icon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-search-normal-1"></use>
                            </svg>
                        </i>
                        <input type="search" class="form-control" placeholder="Ctrl + K" aria-label="Search">
                    </form>
                </li>
            </ul>
        </div>
        
        <!-- Right Side Actions -->
        <div class="ms-auto">
            <ul class="list-unstyled">
                <!-- Theme Toggle -->
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" 
                       data-bs-toggle="dropdown" 
                       href="#" 
                       role="button" 
                       aria-haspopup="false" 
                       aria-expanded="false">
                        <svg class="pc-icon">
                            <use xlink:href="#custom-sun-1"></use>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <a href="#!" class="dropdown-item" onclick="layout_change('dark')">
                            <svg class="pc-icon"><use xlink:href="#custom-moon"></use></svg>
                            <span>Dark</span>
                        </a>
                        <a href="#!" class="dropdown-item" onclick="layout_change('light')">
                            <svg class="pc-icon"><use xlink:href="#custom-sun-1"></use></svg>
                            <span>Light</span>
                        </a>
                        <a href="#!" class="dropdown-item" onclick="layout_change_default()">
                            <svg class="pc-icon"><use xlink:href="#custom-setting-2"></use></svg>
                            <span>Default</span>
                        </a>
                    </div>
                </li>
                
                <!-- Settings Dropdown -->
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" 
                       data-bs-toggle="dropdown" 
                       href="#" 
                       role="button" 
                       aria-haspopup="false" 
                       aria-expanded="false">
                        <svg class="pc-icon">
                            <use xlink:href="#custom-setting-2"></use>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <a href="#!" class="dropdown-item">
                            <i class="ti ti-user"></i> <span>My Account</span>
                        </a>
                        <a href="#!" class="dropdown-item">
                            <i class="ti ti-settings"></i> <span>Settings</span>
                        </a>
                        <a href="#!" class="dropdown-item">
                            <i class="ti ti-headset"></i> <span>Support</span>
                        </a>
                        <a href="#!" class="dropdown-item">
                            <i class="ti ti-lock"></i> <span>Lock Screen</span>
                        </a>
                        <a href="<?= base_url('auth/logout') ?>" class="dropdown-item">
                            <i class="ti ti-power"></i> <span>Logout</span>
                        </a>
                    </div>
                </li>
                
                <!-- Announcement -->
                <li class="pc-h-item">
                    <a href="#" 
                       class="pc-head-link me-0" 
                       data-bs-toggle="offcanvas" 
                       data-bs-target="#announcement" 
                       aria-controls="announcement">
                        <svg class="pc-icon">
                            <use xlink:href="#custom-flash"></use>
                        </svg>
                    </a>
                </li>
                
                <!-- Notifications -->
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" 
                       data-bs-toggle="dropdown" 
                       href="#" 
                       role="button" 
                       aria-haspopup="false" 
                       aria-expanded="false">
                        <svg class="pc-icon">
                            <use xlink:href="#custom-notification"></use>
                        </svg>
                        <?php if (!empty($notifications)): ?>
                            <span class="badge bg-success pc-h-badge"><?= count($notifications) ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0">Notifications</h5>
                            <a href="#!" class="btn btn-link btn-sm">Mark all read</a>
                        </div>
                        <div class="dropdown-body text-wrap header-notification-scroll position-relative" 
                             style="max-height: calc(100vh - 215px)">
                            <?php if (empty($notifications)): ?>
                                <p class="text-center text-muted py-3">No notifications</p>
                            <?php else: ?>
                                <?php foreach ($notifications as $notification): ?>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="pc-icon text-primary">
                                                        <use xlink:href="<?= isset($notification['icon']) ? '#' . $notification['icon'] : '#custom-layer' ?>"></use>
                                                    </svg>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <span class="float-end text-sm text-muted"><?= isset($notification['time']) ? $notification['time'] : 'Now' ?></span>
                                                    <h5 class="text-body mb-2"><?= esc($notification['title']) ?></h5>
                                                    <p class="mb-0"><?= esc($notification['message']) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="text-center py-2">
                            <a href="#!" class="link-danger">Clear all Notifications</a>
                        </div>
                    </div>
                </li>
                
                <!-- User Profile -->
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" 
                       data-bs-toggle="dropdown" 
                       href="#" 
                       role="button" 
                       aria-haspopup="false" 
                       data-bs-auto-close="outside" 
                       aria-expanded="false">
                        <img src="<?= base_url($user['avatar']) ?>" 
                             alt="user-image" 
                             class="user-avtar">
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0">Profile</h5>
                        </div>
                        <div class="dropdown-body">
                            <div class="d-flex mb-1">
                                <div class="flex-shrink-0">
                                    <img src="<?= base_url($user['avatar']) ?>" 
                                         alt="user-image" 
                                         class="user-avtar wid-35">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1"><?= esc($user['name']) ?></h6>
                                    <span><?= esc($user['email']) ?></span>
                                </div>
                            </div>
                            <hr class="border-secondary border-opacity-50">
                            
                            <p class="text-span">Manage</p>
                            <a href="<?= base_url('profile') ?>" class="dropdown-item">
                                <svg class="pc-icon text-muted me-2">
                                    <use xlink:href="#custom-setting-outline"></use>
                                </svg>
                                <span>Settings</span>
                            </a>
                            <a href="<?= base_url('profile') ?>" class="dropdown-item">
                                <svg class="pc-icon text-muted me-2">
                                    <use xlink:href="#custom-lock-outline"></use>
                                </svg>
                                <span>Change Password</span>
                            </a>
                            
                            <hr class="border-secondary border-opacity-50">
                            
                            <div class="d-grid mb-3">
                                <button class="btn btn-primary">
                                    <svg class="pc-icon me-2">
                                        <use xlink:href="#custom-logout-1-outline"></use>
                                    </svg>
                                    Logout
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- [ Header ] end -->
