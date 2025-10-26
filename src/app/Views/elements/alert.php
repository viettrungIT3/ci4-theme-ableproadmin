<?php
/**
 * Alert Element
 * 
 * Usage:
 * echo view('elements/alert', [
 *     'type' => 'success', // primary, secondary, success, danger, warning, info, dark
 *     'message' => 'Your message here',
 *     'dismissible' => true, // optional, default false
 *     'icon' => 'ti ti-check', // optional icon class
 *     'title' => 'Alert Title' // optional title
 * ]);
 */

$type = $type ?? 'primary';
$dismissible = $dismissible ?? false;
$icon = $icon ?? null;
$title = $title ?? null;
?>

<div class="alert alert-<?= $type ?><?= $dismissible ? ' alert-dismissible fade show' : '' ?>" role="alert">
    <?php if ($icon): ?>
        <i class="<?= $icon ?> me-2"></i>
    <?php endif; ?>

    <?php if ($title): ?>
        <h4 class="alert-heading"><?= esc($title) ?></h4>
    <?php endif; ?>

    <div><?= $message ?></div>

    <?php if ($dismissible): ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?php endif; ?>
</div>