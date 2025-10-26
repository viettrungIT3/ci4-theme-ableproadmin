<?php
/**
 * Card Element
 * 
 * Usage:
 * echo view('elements/card', [
 *     'title' => 'Card Title', // optional
 *     'subtitle' => 'Card Subtitle', // optional
 *     'header' => 'Custom Header HTML', // optional
 *     'footer' => 'Custom Footer HTML', // optional
 *     'class' => 'mb-3', // additional CSS classes
 *     'body_class' => 'p-4', // body CSS classes
 *     'content' => 'Card content here'
 * ]);
 */

$class = $class ?? '';
$bodyClass = $body_class ?? '';
?>

<div class="card <?= $class ?>">
    <?php if (isset($header)): ?>
        <div class="card-header">
            <?= $header ?>
        </div>
    <?php elseif (isset($title) || isset($subtitle)): ?>
        <div class="card-header">
            <?php if (isset($title)): ?>
                <h5 class="card-title"><?= esc($title) ?></h5>
            <?php endif; ?>
            <?php if (isset($subtitle)): ?>
                <h6 class="card-subtitle mb-2 text-muted"><?= esc($subtitle) ?></h6>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="card-body <?= $bodyClass ?>">
        <?= $content ?>
    </div>

    <?php if (isset($footer)): ?>
        <div class="card-footer">
            <?= $footer ?>
        </div>
    <?php endif; ?>
</div>