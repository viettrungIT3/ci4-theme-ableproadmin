<?php
/**
 * Mobile Menu Component.
 *
 * Responsive mobile navigation menu with overlay and animations
 *
 * @param array $menuItems Navigation menu items
 * @param string $activeItem Currently active menu item
 * @param array $user User information
 * @param string $class Additional CSS classes
 */

// Default values
$menuItems = $menuItems ?? [];
$activeItem = $activeItem ?? '';
$user = $user ?? ['name' => 'User', 'avatar' => '/assets/images/user/avatar-1.jpg'];
$class = $class ?? '';
?>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

<!-- Mobile Menu -->
<div class="mobile-menu <?= esc($class) ?>" id="mobileMenu">
    <div class="mobile-menu-header">
        <div class="mobile-menu-brand">
            <img src="<?= base_url('themes/able-pro-admin/assets/images/logo-dark.svg') ?>" 
                 alt="Logo" class="mobile-menu-logo">
            <span class="mobile-menu-title">Able Pro</span>
        </div>
        <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close menu">
            <i class="ti ti-x"></i>
        </button>
    </div>
    
    <div class="mobile-menu-content">
        <!-- User Profile -->
        <div class="mobile-menu-user">
            <div class="mobile-menu-user-avatar">
                <img src="<?= base_url($user['avatar']) ?>" 
                     alt="User Avatar" 
                     class="user-avatar">
            </div>
            <div class="mobile-menu-user-info">
                <h6 class="mobile-menu-user-name"><?= esc($user['name']) ?></h6>
                <small class="mobile-menu-user-role">Administrator</small>
            </div>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="mobile-menu-nav">
            <ul class="mobile-menu-list">
                <?php foreach ($menuItems as $menu): ?>
                    <?php if (isset($menu['caption'])): ?>
                        <!-- Category Caption -->
                        <li class="mobile-menu-caption">
                            <span><?= esc($menu['caption']) ?></span>
                        </li>
                    <?php else: ?>
                        <!-- Menu Item -->
                        <li class="mobile-menu-item <?= $activeItem === $menu['id'] ? 'active' : '' ?>">
                            <a href="<?= !empty($menu['submenu']) ? '#!' : (isset($menu['url']) ? $menu['url'] : base_url(strtolower($menu['id']))) ?>" 
                               class="mobile-menu-link <?= !empty($menu['submenu']) ? 'has-submenu' : '' ?>"
                               <?= !empty($menu['submenu']) ? 'data-bs-toggle="collapse" data-bs-target="#mobileSubmenu' . $menu['id'] . '"' : '' ?>>
                                <?php if (!empty($menu['icon'])): ?>
                                    <span class="mobile-menu-icon">
                                        <svg class="pc-icon">
                                            <use xlink:href="#<?= esc($menu['icon']) ?>"></use>
                                        </svg>
                                    </span>
                                <?php endif; ?>
                                <span class="mobile-menu-text"><?= esc($menu['title']) ?></span>
                                
                                <?php if (!empty($menu['badge'])): ?>
                                    <span class="mobile-menu-badge"><?= esc($menu['badge']) ?></span>
                                <?php endif; ?>
                                
                                <?php if (!empty($menu['submenu'])): ?>
                                    <span class="mobile-menu-arrow">
                                        <i class="ti ti-chevron-right"></i>
                                    </span>
                                <?php endif; ?>
                            </a>
                            
                            <?php if (!empty($menu['submenu'])): ?>
                                <div class="collapse mobile-menu-submenu" id="mobileSubmenu<?= esc($menu['id']) ?>">
                                    <ul class="mobile-menu-sublist">
                                        <?php foreach ($menu['submenu'] as $submenu): ?>
                                            <li class="mobile-menu-subitem <?= $activeItem === $submenu['id'] ? 'active' : '' ?>">
                                                <a class="mobile-menu-sublink" 
                                                   href="<?= isset($submenu['url']) ? $submenu['url'] : base_url(strtolower($submenu['id'])) ?>">
                                                    <?= esc($submenu['title']) ?>
                                                </a>
                                                
                                                <?php if (!empty($submenu['submenu'])): ?>
                                                    <div class="collapse mobile-menu-subsubmenu" id="mobileSubsubmenu<?= esc($submenu['id']) ?>">
                                                        <ul class="mobile-menu-subsublist">
                                                            <?php foreach ($submenu['submenu'] as $subsubmenu): ?>
                                                                <li class="mobile-menu-subsubitem">
                                                                    <a class="mobile-menu-subsublink" 
                                                                       href="<?= isset($subsubmenu['url']) ? $subsubmenu['url'] : base_url(strtolower($subsubmenu['id'])) ?>">
                                                                        <?= esc($subsubmenu['title']) ?>
                                                                    </a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
    
    <div class="mobile-menu-footer">
        <div class="mobile-menu-actions">
            <a href="<?= base_url('profile') ?>" class="mobile-menu-action">
                <i class="ti ti-user"></i>
                <span>Profile</span>
            </a>
            <a href="<?= base_url('settings') ?>" class="mobile-menu-action">
                <i class="ti ti-settings"></i>
                <span>Settings</span>
            </a>
            <a href="<?= base_url('auth/logout') ?>" class="mobile-menu-action">
                <i class="ti ti-power"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>
</div>

<style>
/* Mobile Menu Styles */
.mobile-menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1040;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.mobile-menu-overlay.show {
    opacity: 1;
    visibility: visible;
}

.mobile-menu {
    position: fixed;
    top: 0;
    left: -100%;
    width: 280px;
    height: 100%;
    background-color: #fff;
    z-index: 1050;
    transition: left 0.3s ease;
    overflow-y: auto;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
}

.mobile-menu.show {
    left: 0;
}

.mobile-menu-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    background-color: #f8f9fa;
}

.mobile-menu-brand {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.mobile-menu-logo {
    height: 32px;
    width: auto;
}

.mobile-menu-title {
    font-weight: 600;
    color: #495057;
}

.mobile-menu-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #6c757d;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 0.25rem;
    transition: all 0.2s ease;
}

.mobile-menu-close:hover {
    background-color: #e9ecef;
    color: #495057;
}

.mobile-menu-content {
    flex: 1;
    padding: 1rem 0;
}

.mobile-menu-user {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    margin-bottom: 1rem;
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    margin: 0 1rem 1rem;
}

.mobile-menu-user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
}

.mobile-menu-user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.mobile-menu-user-name {
    margin: 0;
    font-size: 0.9rem;
    font-weight: 600;
    color: #495057;
}

.mobile-menu-user-role {
    color: #6c757d;
    font-size: 0.8rem;
}

.mobile-menu-nav {
    padding: 0 1rem;
}

.mobile-menu-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mobile-menu-caption {
    padding: 0.5rem 0;
    margin: 1rem 0 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.mobile-menu-item {
    margin-bottom: 0.25rem;
}

.mobile-menu-link {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    color: #495057;
    text-decoration: none;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
    position: relative;
}

.mobile-menu-link:hover {
    background-color: #e9ecef;
    color: #0d6efd;
}

.mobile-menu-item.active .mobile-menu-link {
    background-color: #e7f1ff;
    color: #0d6efd;
    font-weight: 500;
}

.mobile-menu-icon {
    margin-right: 0.75rem;
    width: 20px;
    text-align: center;
}

.mobile-menu-text {
    flex: 1;
}

.mobile-menu-badge {
    background-color: #dc3545;
    color: white;
    font-size: 0.7rem;
    padding: 0.2rem 0.4rem;
    border-radius: 10px;
    margin-left: 0.5rem;
}

.mobile-menu-arrow {
    margin-left: 0.5rem;
    transition: transform 0.2s ease;
}

.mobile-menu-link[aria-expanded="true"] .mobile-menu-arrow {
    transform: rotate(90deg);
}

.mobile-menu-submenu {
    margin-left: 1rem;
    border-left: 2px solid #e9ecef;
    padding-left: 1rem;
}

.mobile-menu-sublist {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mobile-menu-subitem {
    margin-bottom: 0.25rem;
}

.mobile-menu-sublink {
    display: block;
    padding: 0.5rem 1rem;
    color: #6c757d;
    text-decoration: none;
    border-radius: 0.25rem;
    transition: all 0.2s ease;
    font-size: 0.9rem;
}

.mobile-menu-sublink:hover {
    background-color: #f8f9fa;
    color: #0d6efd;
}

.mobile-menu-subitem.active .mobile-menu-sublink {
    background-color: #e7f1ff;
    color: #0d6efd;
    font-weight: 500;
}

.mobile-menu-footer {
    padding: 1rem;
    border-top: 1px solid #e9ecef;
    background-color: #f8f9fa;
}

.mobile-menu-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.mobile-menu-action {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    color: #495057;
    text-decoration: none;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
}

.mobile-menu-action:hover {
    background-color: #e9ecef;
    color: #0d6efd;
}

/* Dark theme support */
[data-pc-theme="dark"] .mobile-menu {
    background-color: #1a1a1a;
    color: #e9ecef;
}

[data-pc-theme="dark"] .mobile-menu-header {
    background-color: #2d2d2d;
    border-bottom-color: #404040;
}

[data-pc-theme="dark"] .mobile-menu-title {
    color: #e9ecef;
}

[data-pc-theme="dark"] .mobile-menu-close {
    color: #adb5bd;
}

[data-pc-theme="dark"] .mobile-menu-close:hover {
    background-color: #404040;
    color: #e9ecef;
}

[data-pc-theme="dark"] .mobile-menu-user {
    background-color: #2d2d2d;
}

[data-pc-theme="dark"] .mobile-menu-user-name {
    color: #e9ecef;
}

[data-pc-theme="dark"] .mobile-menu-user-role {
    color: #adb5bd;
}

[data-pc-theme="dark"] .mobile-menu-caption {
    color: #adb5bd;
}

[data-pc-theme="dark"] .mobile-menu-link {
    color: #e9ecef;
}

[data-pc-theme="dark"] .mobile-menu-link:hover {
    background-color: #404040;
    color: #6ea8fe;
}

[data-pc-theme="dark"] .mobile-menu-item.active .mobile-menu-link {
    background-color: #1e3a8a;
    color: #6ea8fe;
}

[data-pc-theme="dark"] .mobile-menu-sublink {
    color: #adb5bd;
}

[data-pc-theme="dark"] .mobile-menu-sublink:hover {
    background-color: #404040;
    color: #6ea8fe;
}

[data-pc-theme="dark"] .mobile-menu-subitem.active .mobile-menu-sublink {
    background-color: #1e3a8a;
    color: #6ea8fe;
}

[data-pc-theme="dark"] .mobile-menu-footer {
    background-color: #2d2d2d;
    border-top-color: #404040;
}

[data-pc-theme="dark"] .mobile-menu-action {
    color: #e9ecef;
}

[data-pc-theme="dark"] .mobile-menu-action:hover {
    background-color: #404040;
    color: #6ea8fe;
}

/* Responsive */
@media (min-width: 768px) {
    .mobile-menu-overlay,
    .mobile-menu {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobile-collapse');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const mobileMenuClose = document.getElementById('mobileMenuClose');
    
    // Toggle mobile menu
    function toggleMobileMenu() {
        mobileMenu.classList.toggle('show');
        mobileMenuOverlay.classList.toggle('show');
        document.body.classList.toggle('mobile-menu-open');
    }
    
    // Close mobile menu
    function closeMobileMenu() {
        mobileMenu.classList.remove('show');
        mobileMenuOverlay.classList.remove('show');
        document.body.classList.remove('mobile-menu-open');
    }
    
    // Event listeners
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', toggleMobileMenu);
    }
    
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMobileMenu);
    }
    
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    }
    
    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('show')) {
            closeMobileMenu();
        }
    });
    
    // Handle submenu toggles
    const submenuToggles = document.querySelectorAll('.mobile-menu-link[data-bs-toggle="collapse"]');
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('data-bs-target'));
            if (target) {
                const bsCollapse = new bootstrap.Collapse(target, {
                    toggle: true
                });
            }
        });
    });
});
</script>
