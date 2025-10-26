<?php
/**
 * Modal Component
 * 
 * A reusable modal component for displaying dialogs
 * 
 * @param string $id Modal ID (required)
 * @param string $title Modal title
 * @param string $content Modal content
 * @param string $footer Modal footer content (optional)
 * @param string $size Modal size (sm, lg, xl, default)
 * @param bool $centered Whether modal is centered
 * @param bool $scrollable Whether modal is scrollable
 * @param bool $backdrop Whether to show backdrop
 * @param bool $keyboard Whether to close on ESC key
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 */

// Default values
$id = $id ?? 'modal-' . uniqid();
$title = $title ?? '';
$content = $content ?? '';
$footer = $footer ?? '';
$size = $size ?? 'default';
$centered = $centered ?? false;
$scrollable = $scrollable ?? false;
$backdrop = $backdrop ?? true;
$keyboard = $keyboard ?? true;
$class = $class ?? '';
$attributes = $attributes ?? [];

// Build modal classes
$modalClasses = ['modal', 'fade'];

// Add size class
if ($size !== 'default') {
    $modalClasses[] = "modal-{$size}";
}

// Add custom classes
if (!empty($class)) {
    $modalClasses[] = $class;
}

// Build dialog classes
$dialogClasses = ['modal-dialog'];

if ($centered) {
    $dialogClasses[] = 'modal-dialog-centered';
}

if ($scrollable) {
    $dialogClasses[] = 'modal-dialog-scrollable';
}

// Build attributes string
$attributesString = '';
foreach ($attributes as $key => $value) {
    $attributesString .= " {$key}=\"{$value}\"";
}

// Build data attributes
$dataAttributes = '';
$dataAttributes .= " data-bs-backdrop=\"" . ($backdrop ? 'true' : 'false') . "\"";
$dataAttributes .= " data-bs-keyboard=\"" . ($keyboard ? 'true' : 'false') . "\"";
?>

<div 
    class="<?= implode(' ', $modalClasses) ?>"
    id="<?= $id ?>"
    tabindex="-1"
    aria-labelledby="<?= $id ?>Label"
    aria-hidden="true"
    <?= $dataAttributes ?>
    <?= $attributesString ?>
>
    <div class="<?= implode(' ', $dialogClasses) ?>">
        <div class="modal-content">
            <?php if (!empty($title)): ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="<?= $id ?>Label"><?= $title ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="modal-body">
                <?= $content ?>
            </div>
            
            <?php if (!empty($footer)): ?>
                <div class="modal-footer">
                    <?= $footer ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
