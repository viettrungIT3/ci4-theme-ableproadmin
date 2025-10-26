<?php
/**
 * Loading Spinner Element
 * 
 * Usage:
 * echo view('elements/spinner', [
 *     'size' => 'md', // sm, md, lg
 *     'type' => 'border', // border, grow
 *     'color' => 'primary', // primary, secondary, success, danger, warning, info, light, dark
 *     'text' => 'Loading...', // optional text
 *     'class' => 'text-center'
 * ]);
 */

$size = $size ?? 'md';
$type = $type ?? 'border';
$color = $color ?? 'primary';
$class = $class ?? '';

$spinnerClass = "spinner-{$type}";
$spinnerClass .= " text-{$color}";
$spinnerClass .= $size !== 'md' ? " spinner-{$type}-{$size}" : '';
?>

<div class="<?= $class ?>">
    <div class="<?= $spinnerClass ?>" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <?php if (isset($text)): ?>
        <div class="mt-2"><?= esc($text) ?></div>
    <?php endif; ?>
</div>