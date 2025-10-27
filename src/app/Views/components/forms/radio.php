<?php
/**
 * Radio Component.
 *
 * Renders radio buttons with customizable options and styling
 *
 * @param string $name Input name attribute
 * @param array $options Array of radio options (value => label)
 * @param string $value Selected value
 * @param string $label Group label text
 * @param string $help Help text
 * @param bool $required Whether field is required
 * @param bool $disabled Whether field is disabled
 * @param string $size Radio size (sm, lg, default)
 * @param string $state Validation state (valid, invalid, default)
 * @param string $feedback Validation feedback message
 * @param string $layout Layout style (vertical, horizontal, inline)
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Input ID prefix
 */

// Default values
$name = $name ?? 'radio';
$options = $options ?? [];
$value = $value ?? '';
$label = $label ?? '';
$help = $help ?? '';
$required = $required ?? false;
$disabled = $disabled ?? false;
$size = $size ?? 'default';
$state = $state ?? 'default';
$feedback = $feedback ?? '';
$layout = $layout ?? 'vertical';
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? 'radio_' . uniqid();

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

// Layout classes
$layoutClasses = [
    'vertical' => 'd-flex flex-column',
    'horizontal' => 'd-flex flex-row flex-wrap',
    'inline' => 'd-flex flex-row flex-wrap',
];

// Build attributes
$inputAttributes = array_merge([
    'type' => 'radio',
    'name' => $name,
    'class' => 'form-check-input ' . $sizeClasses[$size] . ' ' . $stateClasses[$state] . ' ' . $class,
], $attributes);

if ($required) {
    $inputAttributes['required'] = 'required';
}

if ($disabled) {
    $inputAttributes['disabled'] = 'disabled';
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
    <?php if (!empty($label)): ?>
        <label class="form-label">
            <?= esc($label) ?>
            <?php if ($required): ?>
                <span class="text-danger">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <div class="radio-group <?= esc($layoutClasses[$layout]) ?>">
        <?php foreach ($options as $optionValue => $optionLabel): ?>
            <?php
            $optionId = $id . '_' . $optionValue;
            $isChecked = $value === $optionValue;
            ?>
            <div class="form-check <?= $layout === 'inline' ? 'me-3' : 'mb-2' ?>">
                <input<?= $inputAttributesString ?> 
                       id="<?= esc($optionId) ?>" 
                       value="<?= esc($optionValue) ?>" 
                       <?= $isChecked ? 'checked' : '' ?>>
                
                <label class="form-check-label" for="<?= esc($optionId) ?>">
                    <?= esc($optionLabel) ?>
                </label>
            </div>
        <?php endforeach; ?>
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
.form-group .radio-group {
    gap: 0.5rem;
}

.form-group .form-check {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
}

.form-group .form-check-input[type="radio"] {
    margin-top: 0.25rem;
    margin-right: 0;
    width: 1rem;
    height: 1rem;
    border: 1px solid #ced4da;
    border-radius: 50%;
    background-color: #fff;
    transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-group .form-check-input[type="radio"]:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e");
}

.form-group .form-check-input[type="radio"]:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-group .form-check-input[type="radio"].is-valid {
    border-color: #198754;
}

.form-group .form-check-input[type="radio"].is-valid:checked {
    background-color: #198754;
    border-color: #198754;
}

.form-group .form-check-input[type="radio"].is-valid:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
}

.form-group .form-check-input[type="radio"].is-invalid {
    border-color: #dc3545;
}

.form-group .form-check-input[type="radio"].is-invalid:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}

.form-group .form-check-input[type="radio"].is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.form-group .form-check-input-sm[type="radio"] {
    width: 0.875rem;
    height: 0.875rem;
}

.form-group .form-check-input-lg[type="radio"] {
    width: 1.25rem;
    height: 1.25rem;
}

.form-group .form-check-label {
    margin-bottom: 0;
    font-weight: 400;
    cursor: pointer;
    user-select: none;
}

.form-group .form-check-input[type="radio"][disabled] {
    background-color: #e9ecef;
    opacity: 1;
}

.form-group .form-check-input[type="radio"][disabled] + .form-check-label {
    color: #6c757d;
    cursor: not-allowed;
}

/* Custom radio styles */
.form-group .form-check-input.custom-radio[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    position: relative;
}

.form-group .form-check-input.custom-radio[type="radio"]::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 0.5rem;
    height: 0.5rem;
    border-radius: 50%;
    background-color: #fff;
    opacity: 0;
    transition: opacity 0.15s ease-in-out;
}

.form-group .form-check-input.custom-radio[type="radio"]:checked::after {
    opacity: 1;
}

/* Dark theme support */
[data-pc-theme="dark"] .form-group .form-check-input[type="radio"] {
    background-color: #1a1a1a;
    border-color: #404040;
}

[data-pc-theme="dark"] .form-group .form-check-input[type="radio"]:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

[data-pc-theme="dark"] .form-group .form-check-input[type="radio"]:focus {
    border-color: #86b7fe;
}

[data-pc-theme="dark"] .form-group .form-check-input[type="radio"][disabled] {
    background-color: #2d2d2d;
}

[data-pc-theme="dark"] .form-group .form-check-label {
    color: #e9ecef;
}

[data-pc-theme="dark"] .form-group .form-check-input[type="radio"][disabled] + .form-check-label {
    color: #6c757d;
}

/* Responsive */
@media (max-width: 768px) {
    .form-group .radio-group {
        gap: 0.375rem;
    }
    
    .form-group .form-check {
        gap: 0.375rem;
    }
    
    .form-group .form-check-input[type="radio"] {
        margin-top: 0.125rem;
    }
    
    .form-group .form-check.me-3 {
        margin-right: 1rem !important;
    }
}
</style>
