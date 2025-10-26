<?php
/**
 * Button Component
 * 
 * A reusable button component with various styles and sizes
 * 
 * @param string $text Button text
 * @param string $type Button type (primary, secondary, success, danger, warning, info, light, dark, link)
 * @param string $size Button size (sm, lg, default)
 * @param string $variant Button variant (default, outline, light, link)
 * @param bool $disabled Whether button is disabled
 * @param string $icon Icon class (optional)
 * @param string $iconPosition Icon position (left, right)
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Button ID
 */

// Default values
$text = $text ?? 'Button';
$type = $type ?? 'primary';
$size = $size ?? 'default';
$variant = $variant ?? 'default';
$disabled = $disabled ?? false;
$icon = $icon ?? '';
$iconPosition = $iconPosition ?? 'left';
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? '';

// Build button classes
$buttonClasses = ['btn'];

// Add type class
if ($variant === 'outline') {
    $buttonClasses[] = "btn-outline-{$type}";
} elseif ($variant === 'light') {
    $buttonClasses[] = "btn-light-{$type}";
} elseif ($variant === 'link') {
    $buttonClasses[] = "btn-link-{$type}";
} else {
    $buttonClasses[] = "btn-{$type}";
}

// Add size class
if ($size === 'sm') {
    $buttonClasses[] = 'btn-sm';
} elseif ($size === 'lg') {
    $buttonClasses[] = 'btn-lg';
}

// Add disabled class
if ($disabled) {
    $buttonClasses[] = 'disabled';
}

// Add custom classes
if (!empty($class)) {
    $buttonClasses[] = $class;
}

// Build attributes string
$attributesString = '';
foreach ($attributes as $key => $value) {
    $attributesString .= " {$key}=\"{$value}\"";
}

// Build icon HTML
$iconHtml = '';
if (!empty($icon)) {
    $iconClass = "{$icon}";
    if ($iconPosition === 'left') {
        $iconClass .= ' me-1';
    } else {
        $iconClass .= ' ms-1';
    }
    $iconHtml = "<i class=\"{$iconClass}\"></i>";
}

// Build button content
$buttonContent = '';
if ($iconPosition === 'left' && !empty($icon)) {
    $buttonContent = $iconHtml . $text;
} elseif ($iconPosition === 'right' && !empty($icon)) {
    $buttonContent = $text . $iconHtml;
} else {
    $buttonContent = $text;
}
?>

<button 
    type="button" 
    class="<?= implode(' ', $buttonClasses) ?>"
    <?= $disabled ? 'disabled' : '' ?>
    <?= !empty($id) ? "id=\"{$id}\"" : '' ?>
    <?= $attributesString ?>
>
    <?= $buttonContent ?>
</button>
