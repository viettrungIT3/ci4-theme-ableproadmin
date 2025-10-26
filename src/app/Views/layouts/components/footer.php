<?php
/**
 * Footer Component
 *
 * Responsive footer with links and copyright information
 *
 * @param string $copyrightText Custom copyright text
 * @param array $footerLinks Footer navigation links
 */

// Default values
$copyrightText = $copyrightText ?? 'Able Pro ❤️ crafted by Team Phoenixcoded';
$footerLinks = $footerLinks ?? [
    ['title' => 'Home', 'url' => base_url()],
    ['title' => 'Documentation', 'url' => 'https://phoenixcoded.gitbook.io/able-pro/', 'target' => '_blank'],
    ['title' => 'Support', 'url' => 'https://phoenixcoded.authordesk.app/', 'target' => '_blank']
];
?>
<!-- [ Footer ] start -->
<footer class="pc-footer">
    <div class="footer-wrapper container-fluid">
        <div class="row">
            <div class="col my-1">
                <p class="m-0">
                    <?= esc($copyrightText) ?>
                    <?php if (!isset($hideAuthor)): ?>
                        <a href="https://themeforest.net/user/phoenixcoded" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            Phoenixcoded
                        </a>
                    <?php endif; ?>
                </p>
            </div>
            <div class="col-auto my-1">
                <ul class="list-inline footer-link mb-0">
                    <?php foreach ($footerLinks as $link): ?>
                        <li class="list-inline-item">
                            <a href="<?= esc($link['url']) ?>" 
                               <?= isset($link['target']) ? 'target="' . esc($link['target']) . '"' : '' ?> 
                               rel="<?= isset($link['target']) && $link['target'] === '_blank' ? 'noopener noreferrer' : '' ?>">
                                <?= esc($link['title']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- [ Footer ] end -->
