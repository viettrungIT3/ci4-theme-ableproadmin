<?php
/**
 * Accordion Component.
 *
 * Renders an accordion with collapsible content sections
 *
 * @param array $items Array of accordion items with 'id', 'title', 'content', 'icon', 'disabled'
 * @param bool $alwaysOpen Whether multiple items can be open at once
 * @param string $variant Accordion variant (default, flush, bordered)
 * @param string $size Accordion size (sm, md, lg)
 * @param string $activeItem ID of the active item
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Accordion container ID
 */

// Default values
$items = $items ?? [];
$alwaysOpen = $alwaysOpen ?? false;
$variant = $variant ?? 'default';
$size = $size ?? 'md';
$activeItem = $activeItem ?? ($items[0]['id'] ?? '');
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? 'accordion_' . uniqid();

// Size classes
$sizeClasses = [
    'sm' => 'accordion-sm',
    'md' => '',
    'lg' => 'accordion-lg',
];

// Variant classes
$variantClasses = [
    'default' => '',
    'flush' => 'accordion-flush',
    'bordered' => 'accordion-bordered',
];

// Build attributes
$accordionAttributes = array_merge([
    'id' => $id,
    'class' => 'accordion ' . $variantClasses[$variant] . ' ' . $sizeClasses[$size] . ' ' . $class,
], $attributes);

// Convert attributes array to string
$accordionAttributesString = '';
foreach ($accordionAttributes as $key => $val) {
    if (is_bool($val)) {
        if ($val) {
            $accordionAttributesString .= ' ' . $key;
        }
    } else {
        $accordionAttributesString .= ' ' . $key . '="' . esc($val) . '"';
    }
}
?>

<div<?= $accordionAttributesString ?>>
    <?php foreach ($items as $index => $item): ?>
        <?php
        $itemId = $item['id'] ?? 'item_' . $index;
        $isActive = $itemId === $activeItem;
        $isDisabled = $item['disabled'] ?? false;
        $collapseId = $itemId . '_collapse';
        $headingId = $itemId . '_heading';
        ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="<?= esc($headingId) ?>">
                <button class="accordion-button <?= $isActive ? '' : 'collapsed' ?> <?= $isDisabled ? 'disabled' : '' ?>"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#<?= esc($collapseId) ?>"
                        aria-expanded="<?= $isActive ? 'true' : 'false' ?>"
                        aria-controls="<?= esc($collapseId) ?>"
                        <?= $isDisabled ? 'disabled' : '' ?>>
                    <?php if (!empty($item['icon'])): ?>
                        <i class="<?= esc($item['icon']) ?> me-2"></i>
                    <?php endif; ?>
                    <?= esc($item['title']) ?>
                </button>
            </h2>
            <div id="<?= esc($collapseId) ?>"
                 class="accordion-collapse collapse <?= $isActive ? 'show' : '' ?>"
                 aria-labelledby="<?= esc($headingId) ?>"
                 data-bs-parent="<?= $alwaysOpen ? '' : '#' . esc($id) ?>">
                <div class="accordion-body">
                    <?= $item['content'] ?? '' ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<style>
.accordion {
    width: 100%;
}

.accordion-item {
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;
}

.accordion-item:last-child {
    margin-bottom: 0;
}

.accordion-header {
    margin-bottom: 0;
}

.accordion-button {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    padding: 1rem 1.25rem;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    background-color: #fff;
    border: 0;
    border-radius: 0.375rem;
    overflow-anchor: none;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, border-radius 0.15s ease-in-out;
    cursor: pointer;
    font-weight: 500;
}

.accordion-button:not(.collapsed) {
    color: #0c63e4;
    background-color: #e7f1ff;
    box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.125);
}

.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230c63e4'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    transform: rotate(-180deg);
}

.accordion-button::after {
    flex-shrink: 0;
    width: 1.25rem;
    height: 1.25rem;
    margin-left: auto;
    content: "";
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-size: 1.25rem;
    transition: transform 0.2s ease-in-out;
}

.accordion-button:hover {
    z-index: 2;
}

.accordion-button:focus {
    z-index: 3;
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.accordion-button.disabled {
    color: #6c757d;
    background-color: #fff;
    opacity: 0.65;
    cursor: not-allowed;
}

.accordion-collapse {
    height: 0;
    overflow: hidden;
    transition: height 0.35s ease;
}

.accordion-collapse.show {
    height: auto;
}

.accordion-body {
    padding: 1rem 1.25rem;
}

/* Variant styles */
.accordion-flush .accordion-item {
    border-left: 0;
    border-right: 0;
    border-radius: 0;
}

.accordion-flush .accordion-item:first-child {
    border-top-left-radius: 0.375rem;
    border-top-right-radius: 0.375rem;
}

.accordion-flush .accordion-item:last-child {
    border-bottom-left-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
}

.accordion-flush .accordion-button {
    border-radius: 0;
}

.accordion-flush .accordion-button:not(.collapsed) {
    box-shadow: none;
}

.accordion-bordered .accordion-item {
    border: 2px solid #dee2e6;
    margin-bottom: 1rem;
}

.accordion-bordered .accordion-button:not(.collapsed) {
    border-bottom: 2px solid #dee2e6;
}

/* Size variations */
.accordion-sm .accordion-button {
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
}

.accordion-sm .accordion-body {
    padding: 0.75rem 1rem;
}

.accordion-lg .accordion-button {
    padding: 1.25rem 1.5rem;
    font-size: 1.125rem;
}

.accordion-lg .accordion-body {
    padding: 1.25rem 1.5rem;
}

/* Dark theme support */
[data-pc-theme="dark"] .accordion-item {
    background-color: #1a1a1a;
    border-color: #404040;
}

[data-pc-theme="dark"] .accordion-button {
    background-color: #1a1a1a;
    color: #e9ecef;
}

[data-pc-theme="dark"] .accordion-button:not(.collapsed) {
    color: #86b7fe;
    background-color: #0d1b2a;
}

[data-pc-theme="dark"] .accordion-button.disabled {
    color: #6c757d;
    background-color: #1a1a1a;
}

[data-pc-theme="dark"] .accordion-bordered .accordion-item {
    border-color: #404040;
}

[data-pc-theme="dark"] .accordion-bordered .accordion-button:not(.collapsed) {
    border-bottom-color: #404040;
}

/* Responsive */
@media (max-width: 768px) {
    .accordion-button {
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
    }
    
    .accordion-body {
        padding: 0.75rem 1rem;
    }
    
    .accordion-sm .accordion-button {
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
    }
    
    .accordion-sm .accordion-body {
        padding: 0.5rem 0.75rem;
    }
    
    .accordion-lg .accordion-button {
        padding: 1rem 1.25rem;
        font-size: 1rem;
    }
    
    .accordion-lg .accordion-body {
        padding: 1rem 1.25rem;
    }
}

/* Animation */
.accordion-collapse {
    transition: height 0.35s ease;
}

.accordion-button::after {
    transition: transform 0.2s ease-in-out;
}

/* Accessibility */
.accordion-button:focus-visible {
    outline: 2px solid #0d6efd;
    outline-offset: 2px;
}

.accordion-button.disabled:focus {
    outline: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const accordions = document.querySelectorAll('.accordion');
    
    accordions.forEach(accordion => {
        const buttons = accordion.querySelectorAll('.accordion-button');
        const collapses = accordion.querySelectorAll('.accordion-collapse');
        const alwaysOpen = !accordion.querySelector('.accordion-collapse').getAttribute('data-bs-parent');
        
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                if (this.classList.contains('disabled')) {
                    return;
                }
                
                const targetId = this.getAttribute('data-bs-target');
                const targetCollapse = accordion.querySelector(targetId);
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                
                if (!alwaysOpen) {
                    // Close all other items
                    buttons.forEach(btn => {
                        if (btn !== this) {
                            btn.classList.add('collapsed');
                            btn.setAttribute('aria-expanded', 'false');
                        }
                    });
                    
                    collapses.forEach(collapse => {
                        if (collapse !== targetCollapse) {
                            collapse.classList.remove('show');
                        }
                    });
                }
                
                // Toggle current item
                if (isExpanded) {
                    this.classList.add('collapsed');
                    this.setAttribute('aria-expanded', 'false');
                    targetCollapse.classList.remove('show');
                } else {
                    this.classList.remove('collapsed');
                    this.setAttribute('aria-expanded', 'true');
                    targetCollapse.classList.add('show');
                }
            });
        });
    });
});
</script>
