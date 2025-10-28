<?php
/**
 * Tabs Component.
 *
 * Renders a tabbed interface with customizable content and styling
 *
 * @param array $tabs Array of tab items with 'id', 'title', 'content', 'icon', 'disabled'
 * @param string $variant Tab variant (tabs, pills, underline)
 * @param string $size Tab size (sm, md, lg)
 * @param string $alignment Tab alignment (left, center, right)
 * @param bool $vertical Whether to display tabs vertically
 * @param bool $justified Whether to justify tabs
 * @param string $activeTab ID of the active tab
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Tabs container ID
 */

// Default values
$tabs = $tabs ?? [];
$variant = $variant ?? 'tabs';
$size = $size ?? 'md';
$alignment = $alignment ?? 'left';
$vertical = $vertical ?? false;
$justified = $justified ?? false;
$activeTab = $activeTab ?? ($tabs[0]['id'] ?? '');
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? 'tabs_' . uniqid();

// Size classes
$sizeClasses = [
    'sm' => 'nav-sm',
    'md' => '',
    'lg' => 'nav-lg',
];

// Variant classes
$variantClasses = [
    'tabs' => 'nav-tabs',
    'pills' => 'nav-pills',
    'underline' => 'nav-underline',
];

// Alignment classes
$alignmentClasses = [
    'left' => 'justify-content-start',
    'center' => 'justify-content-center',
    'right' => 'justify-content-end',
];

// Build attributes
$tabsAttributes = array_merge([
    'id' => $id,
    'class' => 'tabs-container ' . $class,
], $attributes);

// Convert attributes array to string
$tabsAttributesString = '';
foreach ($tabsAttributes as $key => $val) {
    if (is_bool($val)) {
        if ($val) {
            $tabsAttributesString .= ' ' . $key;
        }
    } else {
        $tabsAttributesString .= ' ' . $key . '="' . esc($val) . '"';
    }
}

// Nav classes
$navClass = 'nav ' . $variantClasses[$variant] . ' ' . $sizeClasses[$size];
if ($justified) {
    $navClass .= ' nav-fill';
}
if ($vertical) {
    $navClass .= ' flex-column';
} else {
    $navClass .= ' ' . $alignmentClasses[$alignment];
}
?>

<div<?= $tabsAttributesString ?>>
    <!-- Tab Navigation -->
    <ul class="<?= esc($navClass) ?>" role="tablist">
        <?php foreach ($tabs as $index => $tab): ?>
            <?php
            $tabId = $tab['id'] ?? 'tab_' . $index;
            $isActive = $tabId === $activeTab;
            $isDisabled = $tab['disabled'] ?? false;
            ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $isActive ? 'active' : '' ?> <?= $isDisabled ? 'disabled' : '' ?>"
                        id="<?= esc($tabId) ?>_tab"
                        data-bs-toggle="tab"
                        data-bs-target="#<?= esc($tabId) ?>_content"
                        type="button"
                        role="tab"
                        aria-controls="<?= esc($tabId) ?>_content"
                        aria-selected="<?= $isActive ? 'true' : 'false' ?>"
                        <?= $isDisabled ? 'disabled' : '' ?>>
                    <?php if (!empty($tab['icon'])): ?>
                        <i class="<?= esc($tab['icon']) ?> me-2"></i>
                    <?php endif; ?>
                    <?= esc($tab['title']) ?>
                </button>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="<?= esc($id) ?>_content">
        <?php foreach ($tabs as $index => $tab): ?>
            <?php
            $tabId = $tab['id'] ?? 'tab_' . $index;
            $isActive = $tabId === $activeTab;
            ?>
            <div class="tab-pane fade <?= $isActive ? 'show active' : '' ?>"
                 id="<?= esc($tabId) ?>_content"
                 role="tabpanel"
                 aria-labelledby="<?= esc($tabId) ?>_tab">
                <div class="tab-content-body">
                    <?= $tab['content'] ?? '' ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.tabs-container {
    width: 100%;
}

.nav {
    display: flex;
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
    border-bottom: 1px solid #dee2e6;
}

.nav-link {
    display: block;
    padding: 0.5rem 1rem;
    color: #6c757d;
    text-decoration: none;
    background: none;
    border: 0;
    border-radius: 0.375rem 0.375rem 0 0;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
}

.nav-link:hover {
    color: #495057;
    background-color: #f8f9fa;
}

.nav-link.active {
    color: #0d6efd;
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff;
}

.nav-link.disabled {
    color: #6c757d;
    pointer-events: none;
    cursor: default;
}

/* Tab variants */
.nav-tabs {
    border-bottom: 1px solid #dee2e6;
}

.nav-tabs .nav-link {
    margin-bottom: -1px;
    border: 1px solid transparent;
    border-top-left-radius: 0.375rem;
    border-top-right-radius: 0.375rem;
}

.nav-tabs .nav-link:hover {
    border-color: #e9ecef #e9ecef #dee2e6;
    isolation: isolate;
}

.nav-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff;
}

.nav-pills .nav-link {
    border-radius: 0.375rem;
    margin-right: 0.5rem;
}

.nav-pills .nav-link.active {
    color: #fff;
    background-color: #0d6efd;
}

.nav-underline {
    border-bottom: 2px solid #dee2e6;
}

.nav-underline .nav-link {
    border-bottom: 2px solid transparent;
    border-radius: 0;
    margin-bottom: -2px;
}

.nav-underline .nav-link.active {
    color: #0d6efd;
    border-bottom-color: #0d6efd;
    background-color: transparent;
}

/* Size variations */
.nav-sm .nav-link {
    padding: 0.25rem 0.75rem;
    font-size: 0.875rem;
}

.nav-lg .nav-link {
    padding: 0.75rem 1.5rem;
    font-size: 1.125rem;
}

/* Vertical tabs */
.flex-column .nav-link {
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;
}

.flex-column.nav-tabs .nav-link {
    border: 1px solid transparent;
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;
}

.flex-column.nav-tabs .nav-link.active {
    border-color: #dee2e6;
}

/* Tab content */
.tab-content {
    padding: 1rem 0;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.tab-content-body {
    min-height: 100px;
}

/* Justified tabs */
.nav-fill .nav-item {
    flex: 1 1 auto;
    text-align: center;
}

.nav-justified .nav-item {
    flex-basis: 0;
    flex-grow: 1;
    text-align: center;
}

/* Dark theme support */
[data-pc-theme="dark"] .nav {
    border-bottom-color: #404040;
}

[data-pc-theme="dark"] .nav-link {
    color: #adb5bd;
}

[data-pc-theme="dark"] .nav-link:hover {
    color: #e9ecef;
    background-color: #2d2d2d;
}

[data-pc-theme="dark"] .nav-link.active {
    color: #86b7fe;
    background-color: #1a1a1a;
    border-color: #404040 #404040 #1a1a1a;
}

[data-pc-theme="dark"] .nav-tabs .nav-link:hover {
    border-color: #404040 #404040 #404040;
}

[data-pc-theme="dark"] .nav-tabs .nav-link.active {
    border-color: #404040 #404040 #1a1a1a;
}

[data-pc-theme="dark"] .nav-underline {
    border-bottom-color: #404040;
}

[data-pc-theme="dark"] .nav-underline .nav-link.active {
    border-bottom-color: #86b7fe;
}

/* Responsive */
@media (max-width: 768px) {
    .nav-link {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
    
    .nav-sm .nav-link {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    .nav-lg .nav-link {
        padding: 0.5rem 1rem;
        font-size: 1rem;
    }
    
    .flex-column .nav-link {
        margin-bottom: 0.25rem;
    }
}

/* Animation */
.tab-pane.fade {
    transition: opacity 0.15s linear;
}

.tab-pane.fade:not(.show) {
    opacity: 0;
}

.tab-pane.fade.show {
    opacity: 1;
}

/* Accessibility */
.nav-link:focus {
    outline: 2px solid #0d6efd;
    outline-offset: 2px;
}

.nav-link.disabled:focus {
    outline: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabsContainers = document.querySelectorAll('.tabs-container');
    
    tabsContainers.forEach(container => {
        const navLinks = container.querySelectorAll('.nav-link');
        const tabPanes = container.querySelectorAll('.tab-pane');
        
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                if (this.classList.contains('disabled')) {
                    return;
                }
                
                // Remove active class from all links and panes
                navLinks.forEach(l => l.classList.remove('active'));
                tabPanes.forEach(p => p.classList.remove('show', 'active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');
                
                // Show corresponding tab pane
                const targetId = this.getAttribute('data-bs-target');
                const targetPane = container.querySelector(targetId);
                if (targetPane) {
                    targetPane.classList.add('show', 'active');
                }
                
                // Update aria-selected for other links
                navLinks.forEach(l => {
                    if (l !== this) {
                        l.setAttribute('aria-selected', 'false');
                    }
                });
            });
        });
    });
});
</script>
