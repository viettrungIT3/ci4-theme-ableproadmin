<?php
/**
 * Breadcrumb Component
 * 
 * A reusable breadcrumb navigation component
 * 
 * @param array $items Array of breadcrumb items
 * @param string $separator Separator between items
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Breadcrumb ID
 */

// Default values
$items = $items ?? [];
$separator = $separator ?? '/';
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? '';

// Build breadcrumb classes
$breadcrumbClasses = ['breadcrumb'];

// Add custom classes
if (!empty($class)) {
    $breadcrumbClasses[] = $class;
}

// Build attributes string
$attributesString = '';
foreach ($attributes as $key => $value) {
    $attributesString .= " {$key}=\"{$value}\"";
}

// Build breadcrumb items
$breadcrumbItems = '';
$itemCount = count($items);

foreach ($items as $index => $item) {
    $isLast = ($index === $itemCount - 1);
    $itemClasses = ['breadcrumb-item'];
    
    if ($isLast) {
        $itemClasses[] = 'active';
    }
    
    $breadcrumbItems .= '<li class="' . implode(' ', $itemClasses) . '">';
    
    if ($isLast) {
        $breadcrumbItems .= $item['text'];
    } else {
        $breadcrumbItems .= '<a href="' . htmlspecialchars($item['url']) . '">' . htmlspecialchars($item['text']) . '</a>';
    }
    
    $breadcrumbItems .= '</li>';
}
?>

<nav aria-label="breadcrumb" <?= !empty($id) ? "id=\"{$id}\"" : '' ?> <?= $attributesString ?>>
    <ol class="<?= implode(' ', $breadcrumbClasses) ?>">
        <?= $breadcrumbItems ?>
    </ol>
</nav>
