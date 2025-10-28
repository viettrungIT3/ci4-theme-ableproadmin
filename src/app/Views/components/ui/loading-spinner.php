<?php
/**
 * Loading Spinner Component.
 *
 * Renders a loading spinner with customizable size, color, and animation
 *
 * @param string $size Spinner size (sm, md, lg, xl)
 * @param string $variant Spinner variant (primary, secondary, success, danger, warning, info, light, dark)
 * @param string $type Spinner type (spinner, dots, pulse, grow)
 * @param string $text Loading text
 * @param bool $centered Whether to center the spinner
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Spinner ID
 */

// Default values
$size = $size ?? 'md';
$variant = $variant ?? 'primary';
$type = $type ?? 'spinner';
$text = $text ?? '';
$centered = $centered ?? false;
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? 'spinner_' . uniqid();

// Size classes
$sizeClasses = [
    'sm' => 'spinner-sm',
    'md' => '',
    'lg' => 'spinner-lg',
    'xl' => 'spinner-xl',
];

// Variant classes
$variantClasses = [
    'primary' => 'text-primary',
    'secondary' => 'text-secondary',
    'success' => 'text-success',
    'danger' => 'text-danger',
    'warning' => 'text-warning',
    'info' => 'text-info',
    'light' => 'text-light',
    'dark' => 'text-dark',
];

// Build attributes
$spinnerAttributes = array_merge([
    'id' => $id,
    'class' => 'spinner ' . $sizeClasses[$size] . ' ' . $variantClasses[$variant] . ' ' . $class,
    'role' => 'status',
    'aria-label' => 'Loading...',
], $attributes);

// Convert attributes array to string
$spinnerAttributesString = '';
foreach ($spinnerAttributes as $key => $val) {
    if (is_bool($val)) {
        if ($val) {
            $spinnerAttributesString .= ' ' . $key;
        }
    } else {
        $spinnerAttributesString .= ' ' . $key . '="' . esc($val) . '"';
    }
}

// Container classes
$containerClass = 'spinner-container';
if ($centered) {
    $containerClass .= ' d-flex justify-content-center align-items-center';
}
?>

<div class="<?= esc($containerClass) ?>">
    <?php if ($type === 'spinner'): ?>
        <div<?= $spinnerAttributesString ?>>
            <span class="spinner-border" role="status" aria-hidden="true"></span>
            <?php if (!empty($text)): ?>
                <span class="visually-hidden"><?= esc($text) ?></span>
            <?php endif; ?>
        </div>
    <?php elseif ($type === 'dots'): ?>
        <div<?= $spinnerAttributesString ?>>
            <div class="spinner-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <?php if (!empty($text)): ?>
                <span class="visually-hidden"><?= esc($text) ?></span>
            <?php endif; ?>
        </div>
    <?php elseif ($type === 'pulse'): ?>
        <div<?= $spinnerAttributesString ?>>
            <div class="spinner-pulse"></div>
            <?php if (!empty($text)): ?>
                <span class="visually-hidden"><?= esc($text) ?></span>
            <?php endif; ?>
        </div>
    <?php elseif ($type === 'grow'): ?>
        <div<?= $spinnerAttributesString ?>>
            <span class="spinner-grow" role="status" aria-hidden="true"></span>
            <?php if (!empty($text)): ?>
                <span class="visually-hidden"><?= esc($text) ?></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($text) && $type !== 'spinner' && $type !== 'grow'): ?>
        <div class="spinner-text mt-2">
            <?= esc($text) ?>
        </div>
    <?php endif; ?>
</div>

<style>
.spinner-container {
    display: inline-block;
}

.spinner {
    display: inline-block;
}

.spinner-sm {
    font-size: 0.75rem;
}

.spinner-lg {
    font-size: 1.5rem;
}

.spinner-xl {
    font-size: 2rem;
}

/* Bootstrap spinner */
.spinner-border {
    display: inline-block;
    width: 2rem;
    height: 2rem;
    vertical-align: -0.125em;
    border: 0.25em solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    animation: spinner-border 0.75s linear infinite;
}

.spinner-grow {
    display: inline-block;
    width: 2rem;
    height: 2rem;
    vertical-align: -0.125em;
    background-color: currentColor;
    border-radius: 50%;
    opacity: 0;
    animation: spinner-grow 0.75s linear infinite;
}

/* Custom dots spinner */
.spinner-dots {
    display: inline-flex;
    gap: 0.25rem;
}

.spinner-dots span {
    width: 0.5rem;
    height: 0.5rem;
    border-radius: 50%;
    background-color: currentColor;
    animation: spinner-dots 1.4s ease-in-out infinite both;
}

.spinner-dots span:nth-child(1) {
    animation-delay: -0.32s;
}

.spinner-dots span:nth-child(2) {
    animation-delay: -0.16s;
}

/* Custom pulse spinner */
.spinner-pulse {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    background-color: currentColor;
    animation: spinner-pulse 1s ease-in-out infinite;
}

.spinner-text {
    font-size: 0.875rem;
    color: #6c757d;
    text-align: center;
}

/* Animations */
@keyframes spinner-border {
    to {
        transform: rotate(360deg);
    }
}

@keyframes spinner-grow {
    0% {
        transform: scale(0);
    }
    50% {
        opacity: 1;
        transform: none;
    }
}

@keyframes spinner-dots {
    0%, 80%, 100% {
        transform: scale(0);
    }
    40% {
        transform: scale(1);
    }
}

@keyframes spinner-pulse {
    0% {
        transform: scale(0);
        opacity: 1;
    }
    100% {
        transform: scale(1);
        opacity: 0;
    }
}

/* Size variations */
.spinner-sm .spinner-border,
.spinner-sm .spinner-grow {
    width: 1rem;
    height: 1rem;
}

.spinner-sm .spinner-pulse {
    width: 1rem;
    height: 1rem;
}

.spinner-sm .spinner-dots span {
    width: 0.25rem;
    height: 0.25rem;
}

.spinner-lg .spinner-border,
.spinner-lg .spinner-grow {
    width: 3rem;
    height: 3rem;
}

.spinner-lg .spinner-pulse {
    width: 3rem;
    height: 3rem;
}

.spinner-lg .spinner-dots span {
    width: 0.75rem;
    height: 0.75rem;
}

.spinner-xl .spinner-border,
.spinner-xl .spinner-grow {
    width: 4rem;
    height: 4rem;
}

.spinner-xl .spinner-pulse {
    width: 4rem;
    height: 4rem;
}

.spinner-xl .spinner-dots span {
    width: 1rem;
    height: 1rem;
}

/* Dark theme support */
[data-pc-theme="dark"] .spinner-text {
    color: #adb5bd;
}

/* Responsive */
@media (max-width: 768px) {
    .spinner-text {
        font-size: 0.75rem;
    }
}

/* Accessibility */
.spinner:focus {
    outline: 2px solid currentColor;
    outline-offset: 2px;
}
</style>
