<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Navigation Components Demo
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="pc-container">
    <div class="pc-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Navigation Components Demo</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Breadcrumb Demo -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Breadcrumb Component</h5>
                    </div>
                    <div class="card-body">
                        <h6>Default Breadcrumb:</h6>
                        <?= $this->include('components/navigation/breadcrumb', [
                            'items' => [
                                ['text' => 'Home', 'url' => base_url(), 'icon' => 'ti ti-home'],
                                ['text' => 'Dashboard', 'url' => base_url('dashboard'), 'icon' => 'ti ti-dashboard'],
                                ['text' => 'Users', 'url' => base_url('admin/users'), 'icon' => 'ti ti-users'],
                                ['text' => 'Create User', 'active' => true, 'icon' => 'ti ti-user-plus'],
                            ],
                        ]) ?>

                        <hr>

                        <h6>Simple Breadcrumb:</h6>
                        <?= $this->include('components/navigation/breadcrumb', [
                            'items' => [
                                ['text' => 'Home', 'url' => base_url()],
                                ['text' => 'Settings', 'active' => true],
                            ],
                            'separator' => '>',
                        ]) ?>

                        <hr>

                        <h6>Breadcrumb with Custom Styling:</h6>
                        <?= $this->include('components/navigation/breadcrumb', [
                            'items' => [
                                ['text' => 'Home', 'url' => base_url(), 'icon' => 'ti ti-home'],
                                ['text' => 'Admin', 'url' => base_url('admin'), 'icon' => 'ti ti-settings'],
                                ['text' => 'Users', 'active' => true, 'icon' => 'ti ti-users'],
                            ],
                            'class' => 'custom-breadcrumb',
                            'separator' => '→',
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Demo -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Mobile Menu Component</h5>
                    </div>
                    <div class="card-body">
                        <p>Click the button below to open the mobile menu:</p>
                        <button class="btn btn-primary" id="openMobileMenu">
                            <i class="ti ti-menu-2"></i> Open Mobile Menu
                        </button>

                        <hr>

                        <h6>Mobile Menu Features:</h6>
                        <ul>
                            <li>Responsive overlay design</li>
                            <li>User profile section</li>
                            <li>Nested navigation support</li>
                            <li>Dark theme support</li>
                            <li>Keyboard navigation (ESC to close)</li>
                            <li>Touch-friendly interface</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Helper Demo -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Navigation Helper Demo</h5>
                    </div>
                    <div class="card-body">
                        <h6>Default Menu Items:</h6>
                        <pre class="bg-light p-3 rounded"><code><?= json_encode(\App\Helpers\NavigationHelper::getDefaultMenuItems(), JSON_PRETTY_PRINT) ?></code></pre>

                        <hr>

                        <h6>Breadcrumb for Current Route:</h6>
                        <pre class="bg-light p-3 rounded"><code><?= json_encode(\App\Helpers\NavigationHelper::getBreadcrumbItems('admin/users/create'), JSON_PRETTY_PRINT) ?></code></pre>

                        <hr>

                        <h6>Active Menu Item Check:</h6>
                        <p>
                            Is 'dashboard' active for route 'dashboard/analytics'? 
                            <strong><?= \App\Helpers\NavigationHelper::isMenuItemActive('dashboard', 'dashboard/analytics') ? 'Yes' : 'No' ?></strong>
                        </p>
                        <p>
                            Is 'users' active for route 'admin/users/create'? 
                            <strong><?= \App\Helpers\NavigationHelper::isMenuItemActive('users', 'admin/users/create') ? 'Yes' : 'No' ?></strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Usage Examples -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Usage Examples</h5>
                    </div>
                    <div class="card-body">
                        <h6>Breadcrumb Usage:</h6>
                        <pre class="bg-dark text-light p-3 rounded"><code>&lt;?= $this->include('components/navigation/breadcrumb', [
    'items' => [
        ['text' => 'Home', 'url' => base_url(), 'icon' => 'ti ti-home'],
        ['text' => 'Dashboard', 'url' => base_url('dashboard')],
        ['text' => 'Current Page', 'active' => true]
    ],
    'separator' => '/',
    'class' => 'custom-breadcrumb'
]) ?&gt;</code></pre>

                        <hr>

                        <h6>Mobile Menu Usage:</h6>
                        <pre class="bg-dark text-light p-3 rounded"><code>&lt;?= $this->include('components/navigation/mobile-menu', [
    'menuItems' => \App\Helpers\NavigationHelper::getDefaultMenuItems(),
    'activeItem' => 'dashboard',
    'user' => [
        'name' => 'John Doe',
        'avatar' => '/assets/images/user/avatar.jpg'
    ]
]) ?&gt;</code></pre>

                        <hr>

                        <h6>Navigation Helper Usage:</h6>
                        <pre class="bg-dark text-light p-3 rounded"><code>// Get default menu items
$menuItems = \App\Helpers\NavigationHelper::getDefaultMenuItems();

// Get breadcrumb for current route
$breadcrumbs = \App\Helpers\NavigationHelper::getBreadcrumbItems('admin/users/create');

// Check if menu item is active
$isActive = \App\Helpers\NavigationHelper::isMenuItemActive('dashboard', 'dashboard/analytics');

// Get active menu item
$activeItem = \App\Helpers\NavigationHelper::getActiveMenuItem('admin/users', $menuItems);</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.custom-breadcrumb {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    padding: 1rem;
}

.page-header {
    background-color: #fff;
    border-bottom: 1px solid #dee2e6;
    padding: 1.5rem 0;
    margin-bottom: 2rem;
}

.page-header-title h2 {
    color: #495057;
    font-weight: 600;
}

pre code {
    font-size: 0.875rem;
    line-height: 1.5;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const openMobileMenuBtn = document.getElementById('openMobileMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    
    if (openMobileMenuBtn && mobileMenu && mobileMenuOverlay) {
        openMobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.add('show');
            mobileMenuOverlay.classList.add('show');
            document.body.classList.add('mobile-menu-open');
        });
    }
});
</script>
<?= $this->endSection() ?>
