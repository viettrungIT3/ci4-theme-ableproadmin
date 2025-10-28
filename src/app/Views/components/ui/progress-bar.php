<?php
/**
 * Progress Bar Component.
 *
 * Renders a progress bar with customizable styling and animations
 *
 * @param int $value Current progress value (0-100)
 * @param string $label Progress label text
 * @param string $size Progress bar size (sm, md, lg)
 * @param string $variant Progress bar variant (primary, secondary, success, danger, warning, info)
 * @param bool $animated Whether to show animated stripes
 * @param bool $showPercentage Whether to show percentage text
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Progress bar ID
 */

// Default values
$value = $value ?? 0;
$label = $label ?? '';
$size = $size ?? 'md';
$variant = $variant ?? 'primary';
$animated = $animated ?? false;
$showPercentage = $showPercentage ?? true;
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? 'progress_' . uniqid();

// Ensure value is between 0 and 100
$value = max(0, min(100, $value));

// Size classes
$sizeClasses = [
    'sm' => 'progress-sm',
    'md' => '',
    'lg' => 'progress-lg',
];

// Variant classes
$variantClasses = [
    'primary' => 'bg-primary',
    'secondary' => 'bg-secondary',
    'success' => 'bg-success',
    'danger' => 'bg-danger',
    'warning' => 'bg-warning',
    'info' => 'bg-info',
];

// Build attributes
$progressAttributes = array_merge([
    'id' => $id,
    'class' => 'progress ' . $sizeClasses[$size] . ' ' . $class,
    'role' => 'progressbar',
    'aria-valuenow' => $value,
    'aria-valuemin' => 0,
    'aria-valuemax' => 100,
], $attributes);

// Convert attributes array to string
$progressAttributesString = '';
foreach ($progressAttributes as $key => $val) {
    if (is_bool($val)) {
        if ($val) {
            $progressAttributesString .= ' ' . $key;
        }
    } else {
        $progressAttributesString .= ' ' . $key . '="' . esc($val) . '"';
    }
}

// Build progress bar classes
$progressBarClass = 'progress-bar ' . $variantClasses[$variant];
if ($animated) {
    $progressBarClass .= ' progress-bar-animated progress-bar-striped';
}
?>

<div class="progress-container">
    <?php if (!empty($label)): ?>
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="progress-label"><?= esc($label) ?></span>
            <?php if ($showPercentage): ?>
                <span class="progress-percentage"><?= $value ?>%</span>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div<?= $progressAttributesString ?>>
        <div class="<?= esc($progressBarClass) ?>" 
             style="width: <?= $value ?>%" 
             role="progressbar" 
             aria-valuenow="<?= $value ?>" 
             aria-valuemin="0" 
             aria-valuemax="100">
            <?php if (!$showPercentage || !empty($label)): ?>
                <span class="sr-only"><?= $value ?>% Complete</span>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($showPercentage && empty($label)): ?>
        <div class="text-end mt-1">
            <small class="text-muted"><?= $value ?>%</small>
        </div>
    <?php endif; ?>
</div>

<style>
.progress-container {
    width: 100%;
}

.progress {
    height: 1rem;
    background-color: #e9ecef;
    border-radius: 0.375rem;
    overflow: hidden;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
}

.progress-sm {
    height: 0.5rem;
}

.progress-lg {
    height: 1.5rem;
}

.progress-bar {
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    background-color: #0d6efd;
    transition: width 0.6s ease;
    border-radius: 0.375rem;
}

.progress-bar-striped {
    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    background-size: 1rem 1rem;
}

.progress-bar-animated {
    animation: progress-bar-stripes 1s linear infinite;
}

@keyframes progress-bar-stripes {
    0% {
        background-position-x: 1rem;
    }
}

.progress-label {
    font-weight: 500;
    color: #495057;
}

.progress-percentage {
    font-weight: 600;
    color: #6c757d;
    font-size: 0.875rem;
}

/* Variant colors */
.progress-bar.bg-primary {
    background-color: #0d6efd;
}

.progress-bar.bg-secondary {
    background-color: #6c757d;
}

.progress-bar.bg-success {
    background-color: #198754;
}

.progress-bar.bg-danger {
    background-color: #dc3545;
}

.progress-bar.bg-warning {
    background-color: #ffc107;
    color: #000;
}

.progress-bar.bg-info {
    background-color: #0dcaf0;
    color: #000;
}

/* Dark theme support */
[data-pc-theme="dark"] .progress {
    background-color: #2d2d2d;
}

[data-pc-theme="dark"] .progress-label {
    color: #e9ecef;
}

[data-pc-theme="dark"] .progress-percentage {
    color: #adb5bd;
}

/* Responsive */
@media (max-width: 768px) {
    .progress-label {
        font-size: 0.875rem;
    }
    
    .progress-percentage {
        font-size: 0.75rem;
    }
}

/* Accessibility */
.progress:focus {
    outline: 2px solid #0d6efd;
    outline-offset: 2px;
}

.progress-bar:focus {
    outline: 2px solid #fff;
    outline-offset: -2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const progressBars = document.querySelectorAll('.progress-bar');
    
    progressBars.forEach(bar => {
        // Animate progress bar on scroll into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const targetValue = parseInt(entry.target.style.width);
                    let currentValue = 0;
                    
                    const animate = () => {
                        if (currentValue < targetValue) {
                            currentValue += 1;
                            entry.target.style.width = currentValue + '%';
                            entry.target.setAttribute('aria-valuenow', currentValue);
                            requestAnimationFrame(animate);
                        }
                    };
                    
                    // Reset to 0 and animate
                    entry.target.style.width = '0%';
                    setTimeout(animate, 100);
                    
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(bar);
    });
});
</script>
