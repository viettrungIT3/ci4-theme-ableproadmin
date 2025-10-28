<?php
/**
 * Select Component.
 *
 * Renders a select dropdown with customizable options and styling
 *
 * @param string $name Input name attribute
 * @param array $options Array of options (value => label)
 * @param string $value Selected value
 * @param string $label Label text
 * @param string $placeholder Placeholder text
 * @param string $help Help text
 * @param bool $required Whether field is required
 * @param bool $disabled Whether field is disabled
 * @param bool $multiple Whether multiple selection is allowed
 * @param string $size Select size (sm, lg, default)
 * @param string $state Validation state (valid, invalid, default)
 * @param string $feedback Validation feedback message
 * @param string $icon Icon class
 * @param string $iconPosition Icon position (left, right)
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Input ID
 */

// Default values
$name = $name ?? 'select';
$options = $options ?? [];
$value = $value ?? '';
$label = $label ?? '';
$placeholder = $placeholder ?? 'Select an option';
$help = $help ?? '';
$required = $required ?? false;
$disabled = $disabled ?? false;
$multiple = $multiple ?? false;
$size = $size ?? 'default';
$state = $state ?? 'default';
$feedback = $feedback ?? '';
$icon = $icon ?? '';
$iconPosition = $iconPosition ?? 'right';
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? 'select_' . uniqid();

// Size classes
$sizeClasses = [
    'sm' => 'form-select-sm',
    'lg' => 'form-select-lg',
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
    'class' => 'form-select ' . $sizeClasses[$size] . ' ' . $stateClasses[$state] . ' ' . $class,
], $attributes);

if ($required) {
    $inputAttributes['required'] = 'required';
}

if ($disabled) {
    $inputAttributes['disabled'] = 'disabled';
}

if ($multiple) {
    $inputAttributes['multiple'] = 'multiple';
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
        <label for="<?= esc($id) ?>" class="form-label">
            <?= esc($label) ?>
            <?php if ($required): ?>
                <span class="text-danger">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <div class="input-group">
        <?php if (!empty($icon) && $iconPosition === 'left'): ?>
            <span class="input-group-text">
                <i class="<?= esc($icon) ?>"></i>
            </span>
        <?php endif; ?>

        <select<?= $inputAttributesString ?>>
            <?php if (!empty($placeholder) && !$multiple): ?>
                <option value="" disabled <?= empty($value) ? 'selected' : '' ?>>
                    <?= esc($placeholder) ?>
                </option>
            <?php endif; ?>

            <?php foreach ($options as $optionValue => $optionLabel): ?>
                <?php
                $isSelected = false;
                if ($multiple) {
                    $isSelected = is_array($value) && in_array($optionValue, $value);
                } else {
                    $isSelected = $value === $optionValue;
                }
                ?>
                <option value="<?= esc($optionValue) ?>" <?= $isSelected ? 'selected' : '' ?>>
                    <?= esc($optionLabel) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <?php if (!empty($icon) && $iconPosition === 'right'): ?>
            <span class="input-group-text">
                <i class="<?= esc($icon) ?>"></i>
            </span>
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
.form-group .form-select {
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-group .form-select:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-group .form-select.is-valid {
    border-color: #198754;
}

.form-group .form-select.is-valid:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
}

.form-group .form-select.is-invalid {
    border-color: #dc3545;
}

.form-group .form-select.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.form-group .form-select-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    border-radius: 0.25rem;
}

.form-group .form-select-lg {
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    border-radius: 0.5rem;
}

.form-group .input-group-text {
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    color: #6c757d;
}

.form-group .input-group .form-select {
    border-left: 0;
    border-right: 0;
}

.form-group .input-group .form-select:first-child {
    border-left: 1px solid #ced4da;
}

.form-group .input-group .form-select:last-child {
    border-right: 1px solid #ced4da;
}

/* Dark theme support */
[data-pc-theme="dark"] .form-group .form-select {
    background-color: #1a1a1a;
    border-color: #404040;
    color: #e9ecef;
}

[data-pc-theme="dark"] .form-group .form-select:focus {
    border-color: #86b7fe;
    background-color: #1a1a1a;
}

[data-pc-theme="dark"] .form-group .form-select option {
    background-color: #1a1a1a;
    color: #e9ecef;
}

[data-pc-theme="dark"] .form-group .input-group-text {
    background-color: #2d2d2d;
    border-color: #404040;
    color: #adb5bd;
}

/* Responsive */
@media (max-width: 768px) {
    .form-group .form-select {
        font-size: 16px; /* Prevent zoom on iOS */
    }
}
</style>
