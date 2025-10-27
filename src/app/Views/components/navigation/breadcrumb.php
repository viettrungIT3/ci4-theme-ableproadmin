<?php
/**
 * Breadcrumb Navigation Component.
 *
 * Responsive breadcrumb navigation with customizable styling and separators
 *
 * @param array $items Breadcrumb items array
 * @param string $separator Separator between items (default: '/')
 * @param string $class Additional CSS classes
 * @param bool $showHome Whether to show home link
 * @param string $homeText Home link text
 * @param string $homeUrl Home link URL
 */

// Default values
$items = $items ?? [];
$separator = $separator ?? '/';
$class = $class ?? '';
$showHome = $showHome ?? true;
$homeText = $homeText ?? 'Home';
$homeUrl = $homeUrl ?? base_url();

// Ensure we have items
if (empty($items) && $showHome) {
    $items = [['text' => $homeText, 'url' => $homeUrl, 'active' => true]];
}
?>

<?php if (!empty($items)): ?>
<nav aria-label="breadcrumb" class="breadcrumb-nav <?= esc($class) ?>">
    <ol class="breadcrumb">
        <?php if ($showHome && (!isset($items[0]['text']) || $items[0]['text'] !== $homeText)): ?>
            <li class="breadcrumb-item">
                <a href="<?= esc($homeUrl) ?>" class="breadcrumb-link">
                    <i class="ti ti-home"></i>
                    <span class="breadcrumb-text"><?= esc($homeText) ?></span>
                </a>
            </li>
        <?php endif; ?>
        
        <?php foreach ($items as $index => $item): ?>
            <?php
            $isLast = $index === count($items) - 1;
            $isActive = isset($item['active']) ? $item['active'] : $isLast;
            $itemText = $item['text'] ?? '';
            $itemUrl = $item['url'] ?? '#';
            $itemIcon = $item['icon'] ?? '';
            ?>
            
            <?php if (!$isLast): ?>
                <li class="breadcrumb-item">
                    <?php if ($isActive): ?>
                        <span class="breadcrumb-text">
                            <?php if ($itemIcon): ?>
                                <i class="<?= esc($itemIcon) ?>"></i>
                            <?php endif; ?>
                            <?= esc($itemText) ?>
                        </span>
                    <?php else: ?>
                        <a href="<?= esc($itemUrl) ?>" class="breadcrumb-link">
                            <?php if ($itemIcon): ?>
                                <i class="<?= esc($itemIcon) ?>"></i>
                            <?php endif; ?>
                            <span class="breadcrumb-text"><?= esc($itemText) ?></span>
                        </a>
                    <?php endif; ?>
                </li>
            <?php else: ?>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php if ($itemIcon): ?>
                        <i class="<?= esc($itemIcon) ?>"></i>
                    <?php endif; ?>
                    <span class="breadcrumb-text"><?= esc($itemText) ?></span>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>

<style>
.breadcrumb-nav {
    margin-bottom: 1rem;
}

.breadcrumb {
    display: flex;
    flex-wrap: wrap;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
    list-style: none;
    background-color: transparent;
    border-radius: 0.375rem;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
}

.breadcrumb-item + .breadcrumb-item {
    padding-left: 0.5rem;
}

.breadcrumb-item + .breadcrumb-item::before {
    display: inline-block;
    padding-right: 0.5rem;
    color: #6c757d;
    content: "<?= esc($separator) ?>";
}

.breadcrumb-item.active {
    color: #6c757d;
}

.breadcrumb-link {
    color: #0d6efd;
    text-decoration: none;
    transition: color 0.15s ease-in-out;
}

.breadcrumb-link:hover {
    color: #0a58ca;
    text-decoration: underline;
}

.breadcrumb-text {
    margin-left: 0.25rem;
}

/* Responsive */
@media (max-width: 768px) {
    .breadcrumb {
        padding: 0.5rem;
        font-size: 0.875rem;
    }
    
    .breadcrumb-text {
        display: none;
    }
    
    .breadcrumb-item i {
        font-size: 1rem;
    }
}

/* Dark theme support */
[data-pc-theme="dark"] .breadcrumb-item.active {
    color: #adb5bd;
}

[data-pc-theme="dark"] .breadcrumb-link {
    color: #6ea8fe;
}

[data-pc-theme="dark"] .breadcrumb-link:hover {
    color: #8bb9fe;
}

[data-pc-theme="dark"] .breadcrumb-item + .breadcrumb-item::before {
    color: #adb5bd;
}
</style>
<?php endif; ?>