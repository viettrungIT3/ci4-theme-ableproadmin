<?php
/**
 * Checkbox Component.
 *
 * Renders a checkbox with customizable options and styling
 *
 * @param string $name Input name attribute
 * @param string $value Checkbox value
 * @param bool $checked Whether checkbox is checked
 * @param string $label Label text
 * @param string $help Help text
 * @param bool $required Whether field is required
 * @param bool $disabled Whether field is disabled
 * @param string $size Checkbox size (sm, lg, default)
 * @param string $state Validation state (valid, invalid, default)
 * @param string $feedback Validation feedback message
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Input ID
 */

// Default values
$name = $name ?? 'checkbox';
$value = $value ?? '1';
$checked = $checked ?? false;
$label = $label ?? '';
$help = $help ?? '';
$required = $required ?? false;
$disabled = $disabled ?? false;
$size = $size ?? 'default';
$state = $state ?? 'default';
$feedback = $feedback ?? '';
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? 'checkbox_' . uniqid();

// Size classes
$sizeClasses = [
    'sm' => 'form-check-input-sm',
    'lg' => 'form-check-input-lg',
    'default' => '',
];

// State classes
$stateClasses = [
    'valid' => 'is-valid',
    'invalid' => 'is-invalid',
    'default' => '',
];

// Build attributes
$inputAttributes = array_merge([
    'id' => $id,
    'name' => $name,
    'value' => $value,
    'type' => 'checkbox',
    'class' => 'form-check-input ' . $sizeClasses[$size] . ' ' . $stateClasses[$state] . ' ' . $class,
], $attributes);

if ($required) {
    $inputAttributes['required'] = 'required';
}

if ($disabled) {
    $inputAttributes['disabled'] = 'disabled';
}

if ($checked) {
    $inputAttributes['checked'] = 'checked';
}

// Convert attributes array to string
$inputAttributesString = '';
foreach ($inputAttributes as $key => $val) {
    if (is_bool($val)) {
        if ($val) {
            $inputAttributesString .= ' ' . $key;
        }
    } else {
        $inputAttributesString .= ' ' . $key . '="' . esc($val) . '"';
    }
}
?>

<div class="form-group mb-3">
    <div class="form-check">
        <input<?= $inputAttributesString ?>>
        
        <?php if (!empty($label)): ?>
            <label class="form-check-label" for="<?= esc($id) ?>">
                <?= esc($label) ?>
                <?php if ($required): ?>
                    <span class="text-danger">*</span>
                <?php endif; ?>
            </label>
        <?php endif; ?>
    </div>

    <?php if (!empty($help)): ?>
        <div class="form-text"><?= esc($help) ?></div>
    <?php endif; ?>

    <?php if (!empty($feedback) && $state === 'invalid'): ?>
        <div class="invalid-feedback"><?= esc($feedback) ?></div>
    <?php elseif (!empty($feedback) && $state === 'valid'): ?>
        <div class="valid-feedback"><?= esc($feedback) ?></div>
    <?php endif; ?>
</div>

<style>
.form-group .form-check {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
}

.form-group .form-check-input {
    margin-top: 0.25rem;
    margin-right: 0;
    width: 1rem;
    height: 1rem;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    background-color: #fff;
    transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-group .form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.form-group .form-check-input:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-group .form-check-input.is-valid {
    border-color: #198754;
}

.form-group .form-check-input.is-valid:checked {
    background-color: #198754;
    border-color: #198754;
}

.form-group .form-check-input.is-valid:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
}

.form-group .form-check-input.is-invalid {
    border-color: #dc3545;
}

.form-group .form-check-input.is-invalid:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}

.form-group .form-check-input.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.form-group .form-check-input-sm {
    width: 0.875rem;
    height: 0.875rem;
}

.form-group .form-check-input-lg {
    width: 1.25rem;
    height: 1.25rem;
}

.form-group .form-check-label {
    margin-bottom: 0;
    font-weight: 400;
    cursor: pointer;
    user-select: none;
}

.form-group .form-check-input[disabled] {
    background-color: #e9ecef;
    opacity: 1;
}

.form-group .form-check-input[disabled] + .form-check-label {
    color: #6c757d;
    cursor: not-allowed;
}

/* Custom checkbox styles */
.form-group .form-check-input.custom-checkbox {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    position: relative;
}

.form-group .form-check-input.custom-checkbox::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 0.25rem;
    height: 0.5rem;
    border: solid #fff;
    border-width: 0 2px 2px 0;
    transform: translate(-50%, -60%) rotate(45deg);
    opacity: 0;
    transition: opacity 0.15s ease-in-out;
}

.form-group .form-check-input.custom-checkbox:checked::after {
    opacity: 1;
}

/* Dark theme support */
[data-pc-theme="dark"] .form-group .form-check-input {
    background-color: #1a1a1a;
    border-color: #404040;
}

[data-pc-theme="dark"] .form-group .form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

[data-pc-theme="dark"] .form-group .form-check-input:focus {
    border-color: #86b7fe;
}

[data-pc-theme="dark"] .form-group .form-check-input[disabled] {
    background-color: #2d2d2d;
}

[data-pc-theme="dark"] .form-group .form-check-label {
    color: #e9ecef;
}

[data-pc-theme="dark"] .form-group .form-check-input[disabled] + .form-check-label {
    color: #6c757d;
}

/* Responsive */
@media (max-width: 768px) {
    .form-group .form-check {
        gap: 0.375rem;
    }
    
    .form-group .form-check-input {
        margin-top: 0.125rem;
    }
}
</style>
