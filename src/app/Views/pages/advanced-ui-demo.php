<?php
/**
 * Advanced UI Components Demo Page.
 *
 * This page demonstrates the usage of advanced UI components including
 * progress bars, loading spinners, tooltips, tabs, accordions, carousels, and image galleries.
 */

// Include component library
include APPPATH . 'Views/components/index.php';

$this->extend('layouts/admin');
$this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Advanced UI Components Demo</h5>
            </div>
            <div class="card-body">
                <h3>Progress Bars</h3>
                <?= renderComponent('ui', 'progress-bar', [
                    'value' => 75,
                    'label' => 'Progress',
                    'showPercentage' => true,
                    'color' => 'primary',
                    'size' => 'md',
                    'animated' => true,
                ]) ?>

                <?= renderComponent('ui', 'progress-bar', [
                    'value' => 60,
                    'label' => 'Success Progress',
                    'showPercentage' => true,
                    'color' => 'success',
                    'size' => 'lg',
                    'striped' => true,
                ]) ?>

                <hr class="my-4">

                <h3>Loading Spinners</h3>
                <div class="row">
                    <div class="col-md-4">
                        <?= renderComponent('ui', 'loading-spinner', [
                            'size' => 'sm',
                            'color' => 'primary',
                            'text' => 'Loading...',
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= renderComponent('ui', 'loading-spinner', [
                            'size' => 'md',
                            'color' => 'success',
                            'text' => 'Processing...',
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= renderComponent('ui', 'loading-spinner', [
                            'size' => 'lg',
                            'color' => 'warning',
                            'text' => 'Please wait...',
                        ]) ?>
                    </div>
                </div>

                <hr class="my-4">

                <h3>Tooltips</h3>
                <div class="d-flex gap-3">
                    <?= renderComponent('ui', 'tooltip', [
                        'text' => 'This is a tooltip',
                        'content' => 'Tooltip content goes here',
                        'placement' => 'top',
                        'trigger' => 'hover',
                    ]) ?>

                    <?= renderComponent('ui', 'tooltip', [
                        'text' => 'Click me',
                        'content' => 'This tooltip appears on click',
                        'placement' => 'bottom',
                        'trigger' => 'click',
                    ]) ?>

                    <?= renderComponent('ui', 'tooltip', [
                        'text' => 'Focus me',
                        'content' => 'This tooltip appears on focus',
                        'placement' => 'right',
                        'trigger' => 'focus',
                    ]) ?>
                </div>

                <hr class="my-4">

                <h3>Tabs</h3>
                <?= renderComponent('ui', 'tabs', [
                    'tabs' => [
                        [
                            'id' => 'tab1',
                            'title' => 'Tab 1',
                            'content' => '<p>This is the content of tab 1.</p>',
                            'icon' => 'ti ti-home',
                        ],
                        [
                            'id' => 'tab2',
                            'title' => 'Tab 2',
                            'content' => '<p>This is the content of tab 2.</p>',
                            'icon' => 'ti ti-user',
                        ],
                        [
                            'id' => 'tab3',
                            'title' => 'Tab 3',
                            'content' => '<p>This is the content of tab 3.</p>',
                            'icon' => 'ti ti-settings',
                        ],
                    ],
                    'variant' => 'pills',
                    'justified' => true,
                ]) ?>

                <hr class="my-4">

                <h3>Accordion</h3>
                <?= renderComponent('ui', 'accordion', [
                    'items' => [
                        [
                            'id' => 'item1',
                            'title' => 'Accordion Item 1',
                            'content' => '<p>This is the content of accordion item 1.</p>',
                            'icon' => 'ti ti-info-circle',
                        ],
                        [
                            'id' => 'item2',
                            'title' => 'Accordion Item 2',
                            'content' => '<p>This is the content of accordion item 2.</p>',
                            'icon' => 'ti ti-check-circle',
                        ],
                        [
                            'id' => 'item3',
                            'title' => 'Accordion Item 3',
                            'content' => '<p>This is the content of accordion item 3.</p>',
                            'icon' => 'ti ti-alert-circle',
                        ],
                    ],
                    'alwaysOpen' => false,
                    'variant' => 'default',
                    'size' => 'md',
                ]) ?>

                <hr class="my-4">

                <h3>Carousel</h3>
                <?= renderComponent('ui', 'carousel', [
                    'slides' => [
                        [
                            'image' => 'https://via.placeholder.com/800x400/007bff/ffffff?text=Slide+1',
                            'title' => 'Slide 1',
                            'content' => 'This is the first slide',
                            'link' => [
                                'url' => '#',
                                'text' => 'Learn More',
                                'class' => 'btn-primary',
                            ],
                        ],
                        [
                            'image' => 'https://via.placeholder.com/800x400/28a745/ffffff?text=Slide+2',
                            'title' => 'Slide 2',
                            'content' => 'This is the second slide',
                            'link' => [
                                'url' => '#',
                                'text' => 'Get Started',
                                'class' => 'btn-success',
                            ],
                        ],
                        [
                            'image' => 'https://via.placeholder.com/800x400/dc3545/ffffff?text=Slide+3',
                            'title' => 'Slide 3',
                            'content' => 'This is the third slide',
                            'link' => [
                                'url' => '#',
                                'text' => 'Contact Us',
                                'class' => 'btn-danger',
                            ],
                        ],
                    ],
                    'indicators' => true,
                    'controls' => true,
                    'autoplay' => true,
                    'interval' => 3000,
                    'variant' => 'default',
                    'height' => 'fixed',
                ]) ?>

                <hr class="my-4">

                <h3>Image Gallery</h3>
                <?= renderComponent('ui', 'image-gallery', [
                    'images' => [
                        [
                            'src' => 'https://via.placeholder.com/400x300/007bff/ffffff?text=Image+1',
                            'alt' => 'Image 1',
                            'title' => 'Image 1',
                            'caption' => 'This is image 1',
                        ],
                        [
                            'src' => 'https://via.placeholder.com/400x300/28a745/ffffff?text=Image+2',
                            'alt' => 'Image 2',
                            'title' => 'Image 2',
                            'caption' => 'This is image 2',
                        ],
                        [
                            'src' => 'https://via.placeholder.com/400x300/dc3545/ffffff?text=Image+3',
                            'alt' => 'Image 3',
                            'title' => 'Image 3',
                            'caption' => 'This is image 3',
                        ],
                        [
                            'src' => 'https://via.placeholder.com/400x300/ffc107/000000?text=Image+4',
                            'alt' => 'Image 4',
                            'title' => 'Image 4',
                            'caption' => 'This is image 4',
                        ],
                        [
                            'src' => 'https://via.placeholder.com/400x300/17a2b8/ffffff?text=Image+5',
                            'alt' => 'Image 5',
                            'title' => 'Image 5',
                            'caption' => 'This is image 5',
                        ],
                        [
                            'src' => 'https://via.placeholder.com/400x300/6f42c1/ffffff?text=Image+6',
                            'alt' => 'Image 6',
                            'title' => 'Image 6',
                            'caption' => 'This is image 6',
                        ],
                    ],
                    'layout' => 'grid',
                    'columns' => 3,
                    'lightbox' => true,
                    'lazyLoad' => true,
                    'aspectRatio' => '16:9',
                    'showCaptions' => true,
                ]) ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
