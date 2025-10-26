<?php
/**
 * Badge Element.
 *
 * Usage:
 * echo view('elements/badge', [
 *     'text' => 'New',
 *     'type' => 'success', // primary, secondary, success, danger, warning, info, light, dark
 *     'size' => 'md', // sm, md, lg
 *     'pill' => false, // rounded pill style
 *     'class' => 'me-2' // additional CSS classes
 * ]);
 */
$type = $type ?? 'primary';
$size = $size ?? 'md';
$pill = $pill ?? false;
$class = $class ?? '';

$badgeClass = 'badge';
$badgeClass .= " bg-{$type}";
$badgeClass .= $size !== 'md' ? " fs-{$size}" : '';
$badgeClass .= $pill ? ' rounded-pill' : '';
$badgeClass .= $class ? " {$class}" : '';
?>

<span class="<?= $badgeClass ?>"><?= esc($text) ?></span>