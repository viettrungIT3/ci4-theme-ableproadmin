<?php
/**
 * Form Input Element
 * 
 * Usage:
 * echo view('elements/form_input', [
 *     'name' => 'username',
 *     'label' => 'Username',
 *     'type' => 'text', // text, email, password, number, tel, url, etc.
 *     'value' => $user['username'] ?? '',
 *     'placeholder' => 'Enter username',
 *     'required' => true,
 *     'disabled' => false,
 *     'readonly' => false,
 *     'class' => 'form-control',
 *     'help_text' => 'Enter your username',
 *     'error' => $validation->getError('username'),
 *     'attributes' => ['data-test' => 'username']
 * ]);
 */

$type = $type ?? 'text';
$required = $required ?? false;
$disabled = $disabled ?? false;
$readonly = $readonly ?? false;
$class = $class ?? 'form-control';
$attributes = $attributes ?? [];
$error = $error ?? null;

// Build attributes string
$attrString = '';
foreach ($attributes as $key => $value) {
    $attrString .= " {$key}=\"{$value}\"";
}

$inputClass = $class;
if ($error) {
    $inputClass .= ' is-invalid';
}
?>

<div class="mb-3">
    <?php if (isset($label)): ?>
        <label for="<?= esc($name) ?>" class="form-label">
            <?= esc($label) ?>
            <?php if ($required): ?>
                <span class="text-danger">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <input type="<?= esc($type) ?>" class="<?= $inputClass ?>" id="<?= esc($name) ?>" name="<?= esc($name) ?>"
        value="<?= esc($value ?? '') ?>" placeholder="<?= esc($placeholder ?? '') ?>" <?= $required ? 'required' : '' ?>
        <?= $disabled ? 'disabled' : '' ?> <?= $readonly ? 'readonly' : '' ?> <?= $attrString ?>>

    <?php if (isset($help_text)): ?>
        <div class="form-text"><?= esc($help_text) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="invalid-feedback"><?= esc($error) ?></div>
    <?php endif; ?>
</div>