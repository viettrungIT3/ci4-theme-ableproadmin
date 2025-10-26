<?php
/**
 * Card Component
 * 
 * A reusable card component with various layouts and styles
 * 
 * @param string $title Card title (optional)
 * @param string $subtitle Card subtitle (optional)
 * @param string $content Card content
 * @param string $image Card image URL (optional)
 * @param string $imagePosition Image position (top, bottom, overlay)
 * @param string $header Card header content (optional)
 * @param string $footer Card footer content (optional)
 * @param string $variant Card variant (default, primary, secondary, success, danger, warning, info, light, dark)
 * @param string $alignment Text alignment (left, center, right)
 * @param bool $shadow Whether to add shadow
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Card ID
 */

// Default values
$title = $title ?? '';
$subtitle = $subtitle ?? '';
$content = $content ?? '';
$image = $image ?? '';
$imagePosition = $imagePosition ?? 'top';
$header = $header ?? '';
$footer = $footer ?? '';
$variant = $variant ?? 'default';
$alignment = $alignment ?? 'left';
$shadow = $shadow ?? false;
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? '';

// Build card classes
$cardClasses = ['card'];

// Add variant class
if ($variant !== 'default') {
    if (in_array($variant, ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'])) {
        $cardClasses[] = "text-white bg-{$variant}";
    }
}

// Add shadow class
if ($shadow) {
    $cardClasses[] = 'shadow';
}

// Add alignment class
if ($alignment !== 'left') {
    $cardClasses[] = "text-{$alignment}";
}

// Add custom classes
if (!empty($class)) {
    $cardClasses[] = $class;
}

// Build attributes string
$attributesString = '';
foreach ($attributes as $key => $value) {
    $attributesString .= " {$key}=\"{$value}\"";
}

// Build image HTML
$imageHtml = '';
if (!empty($image)) {
    $imageClass = 'img-fluid';
    if ($imagePosition === 'top') {
        $imageClass .= ' card-img-top';
    } elseif ($imagePosition === 'bottom') {
        $imageClass .= ' card-img-bottom';
    } else {
        $imageClass .= ' card-img';
    }
    $imageHtml = "<img src=\"{$image}\" class=\"{$imageClass}\" alt=\"Card image\">";
}

// Build overlay content
$overlayContent = '';
if ($imagePosition === 'overlay' && !empty($image)) {
    $overlayContent = '<div class="card-img-overlay">';
    if (!empty($title)) {
        $overlayContent .= "<h5 class=\"card-title text-white\">{$title}</h5>";
    }
    if (!empty($subtitle)) {
        $overlayContent .= "<h6 class=\"card-subtitle mb-2 text-white\">{$subtitle}</h6>";
    }
    if (!empty($content)) {
        $overlayContent .= "<p class=\"card-text text-white\">{$content}</p>";
    }
    $overlayContent .= '</div>';
}
?>

<div 
    class="<?= implode(' ', $cardClasses) ?>"
    <?= !empty($id) ? "id=\"{$id}\"" : '' ?>
    <?= $attributesString ?>
>
    <?php if ($imagePosition === 'top' && !empty($image)): ?>
        <?= $imageHtml ?>
    <?php endif; ?>
    
    <?php if (!empty($header)): ?>
        <div class="card-header">
            <?= $header ?>
        </div>
    <?php endif; ?>
    
    <div class="card-body">
        <?php if ($imagePosition !== 'overlay'): ?>
            <?php if (!empty($title)): ?>
                <h5 class="card-title"><?= $title ?></h5>
            <?php endif; ?>
            
            <?php if (!empty($subtitle)): ?>
                <h6 class="card-subtitle mb-2 text-muted"><?= $subtitle ?></h6>
            <?php endif; ?>
            
            <?php if (!empty($content)): ?>
                <p class="card-text"><?= $content ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <?php if ($imagePosition === 'overlay' && !empty($image)): ?>
        <?= $imageHtml ?>
        <?= $overlayContent ?>
    <?php endif; ?>
    
    <?php if ($imagePosition === 'bottom' && !empty($image)): ?>
        <?= $imageHtml ?>
    <?php endif; ?>
    
    <?php if (!empty($footer)): ?>
        <div class="card-footer">
            <?= $footer ?>
        </div>
    <?php endif; ?>
</div>
