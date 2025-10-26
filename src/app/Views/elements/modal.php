<?php
/**
 * Modal Element
 * 
 * Usage:
 * echo view('elements/modal', [
 *     'id' => 'myModal',
 *     'title' => 'Modal Title',
 *     'size' => 'md', // sm, md, lg, xl
 *     'content' => 'Modal content here',
 *     'footer' => 'Modal footer buttons', // optional
 *     'backdrop' => true, // click outside to close
 *     'keyboard' => true, // ESC key to close
 *     'centered' => false, // vertically centered
 *     'scrollable' => false // scrollable content
 * ]);
 */

$id = $id ?? 'modal';
$size = $size ?? 'md';
$backdrop = $backdrop ?? true;
$keyboard = $keyboard ?? true;
$centered = $centered ?? false;
$scrollable = $scrollable ?? false;

$modalClass = 'modal-dialog';
$modalClass .= $size !== 'md' ? " modal-{$size}" : '';
$modalClass .= $centered ? ' modal-dialog-centered' : '';
$modalClass .= $scrollable ? ' modal-dialog-scrollable' : '';
?>

<div class="modal fade" id="<?= esc($id) ?>" tabindex="-1" aria-labelledby="<?= esc($id) ?>Label" aria-hidden="true"
    data-bs-backdrop="<?= $backdrop ? 'true' : 'false' ?>" data-bs-keyboard="<?= $keyboard ? 'true' : 'false' ?>">
    <div class="<?= $modalClass ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?= esc($id) ?>Label"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $content ?>
            </div>
            <?php if (isset($footer)): ?>
                <div class="modal-footer">
                    <?= $footer ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>