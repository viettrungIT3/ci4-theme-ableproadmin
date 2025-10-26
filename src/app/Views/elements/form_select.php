<?php
/**
 * Form Select Element
 * 
 * Usage:
 * echo view('elements/form_select', [
 *     'name' => 'status',
 *     'label' => 'Status',
 *     'options' => [
 *         '' => 'Select Status',
 *         '1' => 'Active',
 *         '0' => 'Inactive'
 *     ],
 *     'value' => $user['status'] ?? '',
 *     'required' => true,
 *     'disabled' => false,
 *     'multiple' => false,
 *     'class' => 'form-select',
 *     'help_text' => 'Select user status',
 *     'error' => $validation->getError('status')
 * ]);
 */

$required = $required ?? false;
$disabled = $disabled ?? false;
$multiple = $multiple ?? false;
$class = $class ?? 'form-select';
$options = $options ?? [];
$error = $error ?? null;

$selectClass = $class;
if ($error) {
    $selectClass .= ' is-invalid';
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

    <select class="<?= $selectClass ?>" id="<?= esc($name) ?>" name="<?= esc($name) ?><?= $multiple ? '[]' : '' ?>"
        <?= $required ? 'required' : '' ?> <?= $disabled ? 'disabled' : '' ?> <?= $multiple ? 'multiple' : '' ?>>

        <?php foreach ($options as $optionValue => $optionText): ?>
            <option value="<?= esc($optionValue) ?>" <?= ($value == $optionValue) ? 'selected' : '' ?>>
                <?= esc($optionText) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <?php if (isset($help_text)): ?>
        <div class="form-text"><?= esc($help_text) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="invalid-feedback"><?= esc($error) ?></div>
    <?php endif; ?>
</div>