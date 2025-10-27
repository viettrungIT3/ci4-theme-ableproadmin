<?php
/**
 * Textarea Component.
 *
 * Renders a textarea with customizable options and styling
 *
 * @param string $name Input name attribute
 * @param string $value Textarea value
 * @param string $label Label text
 * @param string $placeholder Placeholder text
 * @param string $help Help text
 * @param bool $required Whether field is required
 * @param bool $disabled Whether field is disabled
 * @param bool $readonly Whether field is readonly
 * @param int $rows Number of rows
 * @param int $cols Number of columns
 * @param int $maxlength Maximum length
 * @param string $size Textarea size (sm, lg, default)
 * @param string $state Validation state (valid, invalid, default)
 * @param string $feedback Validation feedback message
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Input ID
 */

// Default values
$name = $name ?? 'textarea';
$value = $value ?? '';
$label = $label ?? '';
$placeholder = $placeholder ?? '';
$help = $help ?? '';
$required = $required ?? false;
$disabled = $disabled ?? false;
$readonly = $readonly ?? false;
$rows = $rows ?? 3;
$cols = $cols ?? 50;
$maxlength = $maxlength ?? null;
$size = $size ?? 'default';
$state = $state ?? 'default';
$feedback = $feedback ?? '';
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? 'textarea_' . uniqid();

// Size classes
$sizeClasses = [
    'sm' => 'form-control-sm',
    'lg' => 'form-control-lg',
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
    'rows' => $rows,
    'cols' => $cols,
    'class' => 'form-control ' . $sizeClasses[$size] . ' ' . $stateClasses[$state] . ' ' . $class,
], $attributes);

if ($required) {
    $inputAttributes['required'] = 'required';
}

if ($disabled) {
    $inputAttributes['disabled'] = 'disabled';
}

if ($readonly) {
    $inputAttributes['readonly'] = 'readonly';
}

if ($maxlength) {
    $inputAttributes['maxlength'] = $maxlength;
}

if (!empty($placeholder)) {
    $inputAttributes['placeholder'] = $placeholder;
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

    <textarea<?= $inputAttributesString ?>><?= esc($value) ?></textarea>

    <?php if ($maxlength): ?>
        <div class="form-text">
            <span class="char-count"><?= strlen($value) ?></span> / <?= $maxlength ?> characters
        </div>
    <?php endif; ?>

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
.form-group textarea {
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    resize: vertical;
    min-height: 80px;
}

.form-group textarea:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-group textarea.is-valid {
    border-color: #198754;
}

.form-group textarea.is-valid:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
}

.form-group textarea.is-invalid {
    border-color: #dc3545;
}

.form-group textarea.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.form-group textarea.form-control-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    border-radius: 0.25rem;
    min-height: 60px;
}

.form-group textarea.form-control-lg {
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    border-radius: 0.5rem;
    min-height: 120px;
}

.form-group .char-count {
    font-weight: 500;
}

.form-group textarea[readonly] {
    background-color: #e9ecef;
    opacity: 1;
}

.form-group textarea[disabled] {
    background-color: #e9ecef;
    opacity: 1;
}

/* Dark theme support */
[data-pc-theme="dark"] .form-group textarea {
    background-color: #1a1a1a;
    border-color: #404040;
    color: #e9ecef;
}

[data-pc-theme="dark"] .form-group textarea:focus {
    border-color: #86b7fe;
    background-color: #1a1a1a;
}

[data-pc-theme="dark"] .form-group textarea[readonly] {
    background-color: #2d2d2d;
}

[data-pc-theme="dark"] .form-group textarea[disabled] {
    background-color: #2d2d2d;
}

/* Responsive */
@media (max-width: 768px) {
    .form-group textarea {
        font-size: 16px; /* Prevent zoom on iOS */
    }
}
</style>

<?php if ($maxlength): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('<?= esc($id) ?>');
    const charCount = textarea.parentElement.querySelector('.char-count');
    
    if (textarea && charCount) {
        function updateCharCount() {
            const currentLength = textarea.value.length;
            charCount.textContent = currentLength;
            
            if (currentLength > <?= $maxlength ?>) {
                charCount.style.color = '#dc3545';
            } else if (currentLength > <?= $maxlength ?> * 0.9) {
                charCount.style.color = '#ffc107';
            } else {
                charCount.style.color = '#6c757d';
            }
        }
        
        textarea.addEventListener('input', updateCharCount);
        updateCharCount(); // Initial count
    }
});
</script>
<?php endif; ?>
