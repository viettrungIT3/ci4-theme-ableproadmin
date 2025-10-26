<?php
/**
 * Alert Component.
 *
 * A reusable alert component for displaying messages
 *
 * @param string $message Alert message
 * @param string $type Alert type (primary, secondary, success, danger, warning, info, dark)
 * @param string $title Alert title (optional)
 * @param bool $dismissible Whether alert can be dismissed
 * @param string $icon Icon class (optional)
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Alert ID
 */

// Default values
$message = $message ?? '';
$type = $type ?? 'primary';
$title = $title ?? '';
$dismissible = $dismissible ?? false;
$icon = $icon ?? '';
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? '';

// Build alert classes
$alertClasses = ['alert', "alert-{$type}"];

// Add dismissible class
if ($dismissible) {
    $alertClasses[] = 'alert-dismissible fade show';
}

// Add custom classes
if (!empty($class)) {
    $alertClasses[] = $class;
}

// Build attributes string
$attributesString = '';
foreach ($attributes as $key => $value) {
    $attributesString .= " {$key}=\"{$value}\"";
}

// Build icon HTML
$iconHtml = '';
if (!empty($icon)) {
    $iconHtml = "<i class=\"{$icon} me-2\"></i>";
}

// Build title HTML
$titleHtml = '';
if (!empty($title)) {
    $titleHtml = "<h4 class=\"alert-heading\">{$title}</h4>";
}
?>

<div 
    class="<?= implode(' ', $alertClasses) ?>"
    role="alert"
    <?= !empty($id) ? "id=\"{$id}\"" : '' ?>
    <?= $attributesString ?>
>
    <?php if ($dismissible): ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?php endif; ?>
    
    <?php if (!empty($icon) || !empty($title)): ?>
        <div class="d-flex align-items-center">
            <?= $iconHtml ?>
            <div>
                <?= $titleHtml ?>
                <?= $message ?>
            </div>
        </div>
    <?php else: ?>
        <?= $message ?>
    <?php endif; ?>
</div>
