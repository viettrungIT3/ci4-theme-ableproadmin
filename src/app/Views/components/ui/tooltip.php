<?php
/**
 * Tooltip Component.
 *
 * Renders a tooltip with customizable positioning and styling
 *
 * @param string $content Tooltip content
 * @param string $title Tooltip title
 * @param string $placement Tooltip placement (top, bottom, left, right, auto)
 * @param string $trigger Tooltip trigger (hover, click, focus, manual)
 * @param string $variant Tooltip variant (light, dark)
 * @param bool $html Whether to allow HTML content
 * @param int $delay Tooltip delay in milliseconds
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Tooltip ID
 */

// Default values
$content = $content ?? '';
$title = $title ?? '';
$placement = $placement ?? 'top';
$trigger = $trigger ?? 'hover';
$variant = $variant ?? 'dark';
$html = $html ?? false;
$delay = $delay ?? 0;
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? 'tooltip_' . uniqid();

// Placement classes
$placementClasses = [
    'top' => 'bs-tooltip-top',
    'bottom' => 'bs-tooltip-bottom',
    'left' => 'bs-tooltip-start',
    'right' => 'bs-tooltip-end',
    'auto' => '',
];

// Variant classes
$variantClasses = [
    'light' => 'tooltip-light',
    'dark' => 'tooltip-dark',
];

// Build attributes
$tooltipAttributes = array_merge([
    'id' => $id,
    'class' => 'tooltip ' . $placementClasses[$placement] . ' ' . $variantClasses[$variant] . ' ' . $class,
    'role' => 'tooltip',
], $attributes);

// Convert attributes array to string
$tooltipAttributesString = '';
foreach ($tooltipAttributes as $key => $val) {
    if (is_bool($val)) {
        if ($val) {
            $tooltipAttributesString .= ' ' . $key;
        }
    } else {
        $tooltipAttributesString .= ' ' . $key . '="' . esc($val) . '"';
    }
}

// Data attributes for Bootstrap
$dataAttributes = [
    'data-bs-toggle' => 'tooltip',
    'data-bs-placement' => $placement,
    'data-bs-trigger' => $trigger,
    'data-bs-delay' => $delay,
];

if ($html) {
    $dataAttributes['data-bs-html'] = 'true';
}

$dataAttributesString = '';
foreach ($dataAttributes as $key => $val) {
    $dataAttributesString .= ' ' . $key . '="' . esc($val) . '"';
}
?>

<div<?= $tooltipAttributesString ?>>
    <div class="tooltip-arrow"></div>
    <div class="tooltip-inner">
        <?php if (!empty($title)): ?>
            <div class="tooltip-title"><?= $html ? $title : esc($title) ?></div>
        <?php endif; ?>
        <?php if (!empty($content)): ?>
            <div class="tooltip-content"><?= $html ? $content : esc($content) ?></div>
        <?php endif; ?>
    </div>
</div>

<style>
.tooltip {
    position: absolute;
    z-index: 1070;
    display: block;
    margin: 0;
    font-family: var(--bs-font-sans-serif);
    font-style: normal;
    font-weight: 400;
    line-height: 1.5;
    text-align: left;
    text-decoration: none;
    text-shadow: none;
    text-transform: none;
    letter-spacing: normal;
    word-break: normal;
    word-spacing: normal;
    white-space: normal;
    line-break: auto;
    font-size: 0.875rem;
    word-wrap: break-word;
    opacity: 0;
    transition: opacity 0.15s ease-in-out;
}

.tooltip.show {
    opacity: 0.9;
}

.tooltip-arrow {
    position: absolute;
    display: block;
    width: 0.8rem;
    height: 0.4rem;
}

.tooltip-inner {
    max-width: 200px;
    padding: 0.5rem 0.75rem;
    color: #fff;
    text-align: center;
    background-color: #000;
    border-radius: 0.375rem;
}

.tooltip-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
}

.tooltip-content {
    font-size: 0.8rem;
    line-height: 1.4;
}

/* Placement styles */
.bs-tooltip-top .tooltip-arrow {
    bottom: 0;
    left: 50%;
    margin-left: -0.4rem;
    border-width: 0.4rem 0.4rem 0;
    border-top-color: #000;
}

.bs-tooltip-bottom .tooltip-arrow {
    top: 0;
    left: 50%;
    margin-left: -0.4rem;
    border-width: 0 0.4rem 0.4rem;
    border-bottom-color: #000;
}

.bs-tooltip-start .tooltip-arrow {
    right: 0;
    top: 50%;
    margin-top: -0.4rem;
    border-width: 0.4rem 0 0.4rem 0.4rem;
    border-left-color: #000;
}

.bs-tooltip-end .tooltip-arrow {
    left: 0;
    top: 50%;
    margin-top: -0.4rem;
    border-width: 0.4rem 0.4rem 0.4rem 0;
    border-right-color: #000;
}

/* Variant styles */
.tooltip-light .tooltip-inner {
    color: #000;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

.tooltip-light.bs-tooltip-top .tooltip-arrow {
    border-top-color: #dee2e6;
}

.tooltip-light.bs-tooltip-bottom .tooltip-arrow {
    border-bottom-color: #dee2e6;
}

.tooltip-light.bs-tooltip-start .tooltip-arrow {
    border-left-color: #dee2e6;
}

.tooltip-light.bs-tooltip-end .tooltip-arrow {
    border-right-color: #dee2e6;
}

/* Dark theme support */
[data-pc-theme="dark"] .tooltip-dark .tooltip-inner {
    background-color: #1a1a1a;
    color: #e9ecef;
}

[data-pc-theme="dark"] .tooltip-dark.bs-tooltip-top .tooltip-arrow {
    border-top-color: #1a1a1a;
}

[data-pc-theme="dark"] .tooltip-dark.bs-tooltip-bottom .tooltip-arrow {
    border-bottom-color: #1a1a1a;
}

[data-pc-theme="dark"] .tooltip-dark.bs-tooltip-start .tooltip-arrow {
    border-left-color: #1a1a1a;
}

[data-pc-theme="dark"] .tooltip-dark.bs-tooltip-end .tooltip-arrow {
    border-right-color: #1a1a1a;
}

/* Responsive */
@media (max-width: 768px) {
    .tooltip-inner {
        max-width: 150px;
        padding: 0.375rem 0.5rem;
        font-size: 0.75rem;
    }
    
    .tooltip-title {
        font-size: 0.8rem;
    }
    
    .tooltip-content {
        font-size: 0.7rem;
    }
}

/* Animation */
.tooltip.fade {
    transition: opacity 0.15s linear;
}

.tooltip.fade.show {
    opacity: 0.9;
}

/* Accessibility */
.tooltip:focus {
    outline: 2px solid #0d6efd;
    outline-offset: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    
    tooltips.forEach(tooltip => {
        // Create tooltip element
        const tooltipId = tooltip.getAttribute('data-bs-target') || 'tooltip_' + Math.random().toString(36).substr(2, 9);
        const tooltipElement = document.createElement('div');
        tooltipElement.id = tooltipId;
        tooltipElement.className = 'tooltip';
        tooltipElement.setAttribute('role', 'tooltip');
        
        // Get content
        const title = tooltip.getAttribute('title') || tooltip.getAttribute('data-bs-original-title') || '';
        const content = tooltip.getAttribute('data-bs-content') || '';
        
        // Build tooltip content
        let tooltipContent = '';
        if (title) {
            tooltipContent += '<div class="tooltip-title">' + title + '</div>';
        }
        if (content) {
            tooltipContent += '<div class="tooltip-content">' + content + '</div>';
        }
        
        tooltipElement.innerHTML = '<div class="tooltip-arrow"></div><div class="tooltip-inner">' + tooltipContent + '</div>';
        
        // Add to body
        document.body.appendChild(tooltipElement);
        
        // Set up event listeners
        const trigger = tooltip.getAttribute('data-bs-trigger') || 'hover';
        const placement = tooltip.getAttribute('data-bs-placement') || 'top';
        const delay = parseInt(tooltip.getAttribute('data-bs-delay')) || 0;
        
        let showTimeout, hideTimeout;
        
        function showTooltip() {
            clearTimeout(hideTimeout);
            showTimeout = setTimeout(() => {
                positionTooltip();
                tooltipElement.classList.add('show');
            }, delay);
        }
        
        function hideTooltip() {
            clearTimeout(showTimeout);
            hideTimeout = setTimeout(() => {
                tooltipElement.classList.remove('show');
            }, delay);
        }
        
        function positionTooltip() {
            const rect = tooltip.getBoundingClientRect();
            const tooltipRect = tooltipElement.getBoundingClientRect();
            
            let top, left;
            
            switch (placement) {
                case 'top':
                    top = rect.top - tooltipRect.height - 8;
                    left = rect.left + (rect.width - tooltipRect.width) / 2;
                    tooltipElement.className = 'tooltip bs-tooltip-top show';
                    break;
                case 'bottom':
                    top = rect.bottom + 8;
                    left = rect.left + (rect.width - tooltipRect.width) / 2;
                    tooltipElement.className = 'tooltip bs-tooltip-bottom show';
                    break;
                case 'left':
                    top = rect.top + (rect.height - tooltipRect.height) / 2;
                    left = rect.left - tooltipRect.width - 8;
                    tooltipElement.className = 'tooltip bs-tooltip-start show';
                    break;
                case 'right':
                    top = rect.top + (rect.height - tooltipRect.height) / 2;
                    left = rect.right + 8;
                    tooltipElement.className = 'tooltip bs-tooltip-end show';
                    break;
            }
            
            tooltipElement.style.top = top + 'px';
            tooltipElement.style.left = left + 'px';
        }
        
        if (trigger.includes('hover')) {
            tooltip.addEventListener('mouseenter', showTooltip);
            tooltip.addEventListener('mouseleave', hideTooltip);
        }
        
        if (trigger.includes('click')) {
            tooltip.addEventListener('click', (e) => {
                e.preventDefault();
                if (tooltipElement.classList.contains('show')) {
                    hideTooltip();
                } else {
                    showTooltip();
                }
            });
        }
        
        if (trigger.includes('focus')) {
            tooltip.addEventListener('focus', showTooltip);
            tooltip.addEventListener('blur', hideTooltip);
        }
        
        // Remove title attribute to prevent default tooltip
        tooltip.removeAttribute('title');
    });
});
</script>
