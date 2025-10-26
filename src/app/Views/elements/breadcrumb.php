<?php
/**
 * Breadcrumb Element.
 *
 * Usage:
 * echo view('elements/breadcrumb', [
 *     'items' => [
 *         ['title' => 'Dashboard', 'url' => base_url()],
 *         ['title' => 'Users', 'url' => base_url('users')],
 *         ['title' => 'Create', 'url' => base_url('users/create'), 'active' => true]
 *     ],
 *     'class' => 'mb-3'
 * ]);
 */
$class = $class ?? '';
$items = $items ?? [];
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb <?= $class ?>">
        <?php foreach ($items as $index => $item): ?>
            <?php if (isset($item['active']) && $item['active']): ?>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= esc($item['title']) ?>
                </li>
            <?php else: ?>
                <li class="breadcrumb-item">
                    <a href="<?= esc($item['url']) ?>"><?= esc($item['title']) ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>