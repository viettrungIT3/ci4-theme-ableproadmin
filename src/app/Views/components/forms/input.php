<?php
/**
 * Input Component.
 *
 * A reusable input component for forms
 *
 * @param string $name Input name
 * @param string $type Input type (text, email, password, number, tel, url, search, etc.)
 * @param string $value Input value
 * @param string $placeholder Input placeholder
 * @param string $label Input label (optional)
 * @param string $help Help text (optional)
 * @param bool $required Whether input is required
 * @param bool $disabled Whether input is disabled
 * @param bool $readonly Whether input is readonly
 * @param string $size Input size (sm, lg, default)
 * @param string $state Input state (valid, invalid, default)
 * @param string $feedback Validation feedback message
 * @param string $icon Icon class (optional)
 * @param string $iconPosition Icon position (left, right)
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Input ID
 */

// Default values
$name = $name ?? '';
$type = $type ?? 'text';
$value = $value ?? '';
$placeholder = $placeholder ?? '';
$label = $label ?? '';
$help = $help ?? '';
$required = $required ?? false;
$disabled = $disabled ?? false;
$readonly = $readonly ?? false;
$size = $size ?? 'default';
$state = $state ?? 'default';
$feedback = $feedback ?? '';
$icon = $icon ?? '';
$iconPosition = $iconPosition ?? 'left';
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? $name;

// Build input classes
$inputClasses = ['form-control'];

// Add size class
if ($size === 'sm') {
    $inputClasses[] = 'form-control-sm';
} elseif ($size === 'lg') {
    $inputClasses[] = 'form-control-lg';
}

// Add state class
if ($state === 'valid') {
    $inputClasses[] = 'is-valid';
} elseif ($state === 'invalid') {
    $inputClasses[] = 'is-invalid';
}

// Add custom classes
if (!empty($class)) {
    $inputClasses[] = $class;
}

// Build attributes string
$attributesString = '';
foreach ($attributes as $key => $value) {
    $attributesString .= " {$key}=\"{$value}\"";
}

// Build icon HTML
$iconHtml = '';
if (!empty($icon)) {
    $iconClass = "{$icon}";
    if ($iconPosition === 'left') {
        $iconClass .= ' me-2';
    } else {
        $iconClass .= ' ms-2';
    }
    $iconHtml = "<i class=\"{$iconClass}\"></i>";
}

// Build input group classes
$inputGroupClasses = ['input-group'];
if ($iconPosition === 'left' && !empty($icon)) {
    $inputGroupClasses[] = 'has-icon-left';
} elseif ($iconPosition === 'right' && !empty($icon)) {
    $inputGroupClasses[] = 'has-icon-right';
}
?>

<?php if (!empty($label)): ?>
    <label for="<?= $id ?>" class="form-label">
        <?= $label ?>
        <?php if ($required): ?>
            <span class="text-danger">*</span>
        <?php endif; ?>
    </label>
<?php endif; ?>

<?php if (!empty($icon)): ?>
    <div class="<?= implode(' ', $inputGroupClasses) ?>">
        <?php if ($iconPosition === 'left'): ?>
            <span class="input-group-text">
                <?= $iconHtml ?>
            </span>
        <?php endif; ?>
        
        <input 
            type="<?= $type ?>"
            class="<?= implode(' ', $inputClasses) ?>"
            id="<?= $id ?>"
            name="<?= $name ?>"
            value="<?= htmlspecialchars($value) ?>"
            placeholder="<?= htmlspecialchars($placeholder) ?>"
            <?= $required ? 'required' : '' ?>
            <?= $disabled ? 'disabled' : '' ?>
            <?= $readonly ? 'readonly' : '' ?>
            <?= $attributesString ?>
        >
        
        <?php if ($iconPosition === 'right'): ?>
            <span class="input-group-text">
                <?= $iconHtml ?>
            </span>
        <?php endif; ?>
    </div>
<?php else: ?>
    <input 
        type="<?= $type ?>"
        class="<?= implode(' ', $inputClasses) ?>"
        id="<?= $id ?>"
        name="<?= $name ?>"
        value="<?= htmlspecialchars($value) ?>"
        placeholder="<?= htmlspecialchars($placeholder) ?>"
        <?= $required ? 'required' : '' ?>
        <?= $disabled ? 'disabled' : '' ?>
        <?= $readonly ? 'readonly' : '' ?>
        <?= $attributesString ?>
    >
<?php endif; ?>

<?php if (!empty($help)): ?>
    <div class="form-text"><?= $help ?></div>
<?php endif; ?>

<?php if (!empty($feedback)): ?>
    <div class="<?= $state === 'valid' ? 'valid-feedback' : 'invalid-feedback' ?>">
        <?= $feedback ?>
    </div>
<?php endif; ?>
