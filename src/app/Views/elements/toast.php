<?php
/**
 * Toast Notification Element
 * 
 * Usage:
 * echo view('elements/toast', [
 *     'id' => 'toast-1',
 *     'type' => 'success', // success, error, warning, info
 *     'title' => 'Success!',
 *     'message' => 'User created successfully',
 *     'position' => 'top-center', // top-center, top-right, bottom-right, bottom-left
 *     'duration' => 5000, // auto hide duration in ms
 *     'dismissible' => true
 * ]);
 */

$id = $id ?? 'toast-' . uniqid();
$type = $type ?? 'info';
$title = $title ?? '';
$message = $message ?? '';
$position = $position ?? 'top-center';
$duration = $duration ?? 5000;
$dismissible = $dismissible ?? true;

// Position classes
$positionClasses = [
    'top-center' => 'toast-top-center',
    'top-right' => 'toast-top-right',
    'bottom-right' => 'toast-bottom-right',
    'bottom-left' => 'toast-bottom-left'
];

$positionClass = $positionClasses[$position] ?? 'toast-top-center';

// Type classes
$typeClasses = [
    'success' => 'bg-success',
    'error' => 'bg-danger',
    'warning' => 'bg-warning',
    'info' => 'bg-info'
];

$typeClass = $typeClasses[$type] ?? 'bg-info';

// Icons
$icons = [
    'success' => 'ti ti-check-circle',
    'error' => 'ti ti-alert-circle',
    'warning' => 'ti ti-alert-triangle',
    'info' => 'ti ti-info-circle'
];

$icon = $icons[$type] ?? 'ti ti-info-circle';
?>

<div id="<?= esc($id) ?>" class="toast <?= $positionClass ?> <?= $typeClass ?>" role="alert" aria-live="assertive"
    aria-atomic="true" data-bs-autohide="<?= $duration ? 'true' : 'false' ?>" data-bs-delay="<?= $duration ?>">
    <div class="toast-header <?= $typeClass ?> text-white">
        <i class="<?= $icon ?> me-2"></i>
        <strong class="me-auto"><?= esc($title) ?></strong>
        <?php if ($dismissible): ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        <?php endif; ?>
    </div>
    <div class="toast-body text-white">
        <?= esc($message) ?>
    </div>
</div>

<style>
    .toast-top-center {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 9999;
    }

    .toast-top-right {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .toast-bottom-right {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }

    .toast-bottom-left {
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 9999;
    }

    /* Animation for top-center */
    .toast-top-center {
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            transform: translateX(-50%) translateY(-100%);
            opacity: 0;
        }

        to {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
    }

    /* Animation for top-right */
    .toast-top-right {
        animation: slideInRight 0.3s ease-out;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Animation for bottom-right */
    .toast-bottom-right {
        animation: slideInUp 0.3s ease-out;
    }

    @keyframes slideInUp {
        from {
            transform: translateY(100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Animation for bottom-left */
    .toast-bottom-left {
        animation: slideInLeft 0.3s ease-out;
    }

    @keyframes slideInLeft {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .toast-top-center {
            top: 10px;
            left: 10px;
            right: 10px;
            transform: none;
        }

        .toast-top-right,
        .toast-bottom-right {
            right: 10px;
        }

        .toast-bottom-left {
            left: 10px;
        }
    }
</style>