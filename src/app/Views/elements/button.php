<?php
/**
 * Button Element
 * 
 * Usage:
 * echo view('elements/button', [
 *     'type' => 'primary', // primary, secondary, success, danger, warning, info, light, dark, link
 *     'variant' => 'solid', // solid, outline, light, link
 *     'size' => 'md', // sm, md, lg
 *     'text' => 'Click me',
 *     'icon' => 'ti ti-plus', // optional icon
 *     'icon_position' => 'left', // left, right
 *     'href' => '/some-url', // optional - makes it a link
 *     'disabled' => false,
 *     'attributes' => ['data-bs-toggle' => 'modal'] // additional attributes
 * ]);
 */

$type = $type ?? 'primary';
$variant = $variant ?? 'solid';
$size = $size ?? 'md';
$icon = $icon ?? null;
$icon_position = $icon_position ?? 'left';
$disabled = $disabled ?? false;
$attributes = $attributes ?? [];

// Build button classes
$buttonClass = 'btn';
$buttonClass .= $variant === 'solid' ? " btn-{$type}" : " btn-{$variant}-{$type}";
$buttonClass .= $size !== 'md' ? " btn-{$size}" : '';
$buttonClass .= $disabled ? ' disabled' : '';

// Build attributes string
$attrString = '';
foreach ($attributes as $key => $value) {
    $attrString .= " {$key}=\"{$value}\"";
}

// Determine tag (button or a)
$tag = isset($href) ? 'a' : 'button';
$hrefAttr = isset($href) ? " href=\"{$href}\"" : '';
$typeAttr = $tag === 'button' && !isset($attributes['type']) ? ' type="button"' : '';
?>

<<?= $tag ?> class="<?= $buttonClass ?>"<?= $hrefAttr ?><?= $typeAttr ?><?= $attrString ?>>
    <?php if ($icon && $icon_position === 'left'): ?>
        <i class="<?= $icon ?> me-1"></i>
    <?php endif; ?>

    <?= esc($text) ?>

    <?php if ($icon && $icon_position === 'right'): ?>
        <i class="<?= $icon ?> ms-1"></i>
    <?php endif; ?>
</<?= $tag ?>>