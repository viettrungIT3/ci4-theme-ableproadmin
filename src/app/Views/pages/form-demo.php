<?php
/**
 * Form Components Demo Page.
 *
 * This page demonstrates the usage of advanced form components including
 * select, textarea, checkbox, radio, and file upload components.
 */

$this->extend('layouts/admin');
$this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Form Components Demo</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url() ?>">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#!">Components</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#!">Form Components</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Basic Form Components -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Basic Form Components</h5>
                <p class="text-muted mb-0">Input, Select, and Textarea components</p>
            </div>
            <div class="card-body">
                <form>
                    <!-- Input Component -->
                    <?= $this->include('components/forms/input', [
                        'name' => 'username',
                        'type' => 'text',
                        'label' => 'Username',
                        'placeholder' => 'Enter your username',
                        'required' => true,
                        'icon' => 'ti ti-user',
                        'iconPosition' => 'left',
                    ]) ?>

                    <!-- Select Component -->
                    <?= $this->include('components/forms/select', [
                        'name' => 'country',
                        'label' => 'Country',
                        'placeholder' => 'Select your country',
                        'options' => [
                            'us' => 'United States',
                            'uk' => 'United Kingdom',
                            'ca' => 'Canada',
                            'au' => 'Australia',
                            'de' => 'Germany',
                            'fr' => 'France',
                            'jp' => 'Japan',
                        ],
                        'required' => true,
                        'icon' => 'ti ti-world',
                        'iconPosition' => 'left',
                    ]) ?>

                    <!-- Textarea Component -->
                    <?= $this->include('components/forms/textarea', [
                        'name' => 'message',
                        'label' => 'Message',
                        'placeholder' => 'Enter your message here...',
                        'rows' => 4,
                        'maxlength' => 500,
                        'help' => 'Maximum 500 characters',
                    ]) ?>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Checkbox & Radio Components</h5>
                <p class="text-muted mb-0">Interactive form controls</p>
            </div>
            <div class="card-body">
                <form>
                    <!-- Checkbox Component -->
                    <?= $this->include('components/forms/checkbox', [
                        'name' => 'newsletter',
                        'label' => 'Subscribe to newsletter',
                        'checked' => true,
                        'help' => 'Receive updates about new features and products',
                    ]) ?>

                    <?= $this->include('components/forms/checkbox', [
                        'name' => 'terms',
                        'label' => 'I agree to the terms and conditions',
                        'required' => true,
                    ]) ?>

                    <!-- Radio Component -->
                    <?= $this->include('components/forms/radio', [
                        'name' => 'plan',
                        'label' => 'Choose your plan',
                        'options' => [
                            'basic' => 'Basic Plan - $9/month',
                            'pro' => 'Pro Plan - $29/month',
                            'enterprise' => 'Enterprise Plan - $99/month',
                        ],
                        'value' => 'pro',
                        'required' => true,
                        'layout' => 'vertical',
                    ]) ?>

                    <!-- Radio Component - Horizontal Layout -->
                    <?= $this->include('components/forms/radio', [
                        'name' => 'theme',
                        'label' => 'Theme Preference',
                        'options' => [
                            'light' => 'Light',
                            'dark' => 'Dark',
                            'auto' => 'Auto',
                        ],
                        'value' => 'auto',
                        'layout' => 'horizontal',
                    ]) ?>

                    <button type="submit" class="btn btn-primary">Save Preferences</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- File Upload Components -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>File Upload - Images</h5>
                <p class="text-muted mb-0">Drag & drop image upload</p>
            </div>
            <div class="card-body">
                <?= $this->include('components/forms/file-upload', [
                    'name' => 'images',
                    'label' => 'Upload Images',
                    'accept' => 'image/*',
                    'multiple' => true,
                    'maxSize' => 10485760, // 10MB
                    'help' => 'Upload profile pictures or gallery images',
                ]) ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>File Upload - Documents</h5>
                <p class="text-muted mb-0">Document upload with validation</p>
            </div>
            <div class="card-body">
                <?= $this->include('components/forms/file-upload', [
                    'name' => 'documents',
                    'label' => 'Upload Documents',
                    'accept' => '.pdf,.doc,.docx,.txt',
                    'multiple' => true,
                    'maxSize' => 5242880, // 5MB
                    'help' => 'Upload PDF, Word, or text documents',
                ]) ?>
            </div>
        </div>
    </div>
</div>

<!-- Form Validation Examples -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Form Validation Examples</h5>
                <p class="text-muted mb-0">Different validation states and feedback</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6>Valid State</h6>
                        <?= $this->include('components/forms/input', [
                            'name' => 'valid_email',
                            'type' => 'email',
                            'label' => 'Email Address',
                            'value' => 'user@example.com',
                            'state' => 'valid',
                            'feedback' => 'Looks good!',
                        ]) ?>
                    </div>

                    <div class="col-md-4">
                        <h6>Invalid State</h6>
                        <?= $this->include('components/forms/input', [
                            'name' => 'invalid_email',
                            'type' => 'email',
                            'label' => 'Email Address',
                            'value' => 'invalid-email',
                            'state' => 'invalid',
                            'feedback' => 'Please enter a valid email address.',
                        ]) ?>
                    </div>

                    <div class="col-md-4">
                        <h6>Disabled State</h6>
                        <?= $this->include('components/forms/input', [
                            'name' => 'disabled_field',
                            'type' => 'text',
                            'label' => 'Disabled Field',
                            'value' => 'This field is disabled',
                            'disabled' => true,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Size Variations -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Size Variations</h5>
                <p class="text-muted mb-0">Different sizes for form components</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6>Small Size</h6>
                        <?= $this->include('components/forms/input', [
                            'name' => 'small_input',
                            'type' => 'text',
                            'label' => 'Small Input',
                            'size' => 'sm',
                            'placeholder' => 'Small input field',
                        ]) ?>

                        <?= $this->include('components/forms/select', [
                            'name' => 'small_select',
                            'label' => 'Small Select',
                            'size' => 'sm',
                            'options' => [
                                'option1' => 'Option 1',
                                'option2' => 'Option 2',
                                'option3' => 'Option 3',
                            ],
                        ]) ?>
                    </div>

                    <div class="col-md-4">
                        <h6>Default Size</h6>
                        <?= $this->include('components/forms/input', [
                            'name' => 'default_input',
                            'type' => 'text',
                            'label' => 'Default Input',
                            'placeholder' => 'Default input field',
                        ]) ?>

                        <?= $this->include('components/forms/select', [
                            'name' => 'default_select',
                            'label' => 'Default Select',
                            'options' => [
                                'option1' => 'Option 1',
                                'option2' => 'Option 2',
                                'option3' => 'Option 3',
                            ],
                        ]) ?>
                    </div>

                    <div class="col-md-4">
                        <h6>Large Size</h6>
                        <?= $this->include('components/forms/input', [
                            'name' => 'large_input',
                            'type' => 'text',
                            'label' => 'Large Input',
                            'size' => 'lg',
                            'placeholder' => 'Large input field',
                        ]) ?>

                        <?= $this->include('components/forms/select', [
                            'name' => 'large_select',
                            'label' => 'Large Select',
                            'size' => 'lg',
                            'options' => [
                                'option1' => 'Option 1',
                                'option2' => 'Option 2',
                                'option3' => 'Option 3',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Complete Form Example -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Complete Form Example</h5>
                <p class="text-muted mb-0">A comprehensive form using all components</p>
            </div>
            <div class="card-body">
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->include('components/forms/input', [
                                'name' => 'first_name',
                                'type' => 'text',
                                'label' => 'First Name',
                                'placeholder' => 'Enter your first name',
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->include('components/forms/input', [
                                'name' => 'last_name',
                                'type' => 'text',
                                'label' => 'Last Name',
                                'placeholder' => 'Enter your last name',
                                'required' => true,
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->include('components/forms/input', [
                                'name' => 'email',
                                'type' => 'email',
                                'label' => 'Email Address',
                                'placeholder' => 'Enter your email',
                                'required' => true,
                                'icon' => 'ti ti-mail',
                                'iconPosition' => 'left',
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->include('components/forms/input', [
                                'name' => 'phone',
                                'type' => 'tel',
                                'label' => 'Phone Number',
                                'placeholder' => 'Enter your phone number',
                                'icon' => 'ti ti-phone',
                                'iconPosition' => 'left',
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->include('components/forms/select', [
                                'name' => 'department',
                                'label' => 'Department',
                                'placeholder' => 'Select department',
                                'options' => [
                                    'engineering' => 'Engineering',
                                    'marketing' => 'Marketing',
                                    'sales' => 'Sales',
                                    'support' => 'Support',
                                    'hr' => 'Human Resources',
                                ],
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->include('components/forms/radio', [
                                'name' => 'experience',
                                'label' => 'Experience Level',
                                'options' => [
                                    'junior' => 'Junior (0-2 years)',
                                    'mid' => 'Mid-level (3-5 years)',
                                    'senior' => 'Senior (6+ years)',
                                ],
                                'required' => true,
                                'layout' => 'vertical',
                            ]) ?>
                        </div>
                    </div>

                    <?= $this->include('components/forms/textarea', [
                        'name' => 'bio',
                        'label' => 'Bio',
                        'placeholder' => 'Tell us about yourself...',
                        'rows' => 4,
                        'maxlength' => 1000,
                        'help' => 'Maximum 1000 characters',
                    ]) ?>

                    <?= $this->include('components/forms/file-upload', [
                        'name' => 'resume',
                        'label' => 'Resume',
                        'accept' => '.pdf,.doc,.docx',
                        'maxSize' => 5242880, // 5MB
                        'help' => 'Upload your resume (PDF or Word document)',
                    ]) ?>

                    <?= $this->include('components/forms/checkbox', [
                        'name' => 'newsletter_signup',
                        'label' => 'Subscribe to our newsletter',
                        'help' => 'Get updates about new job opportunities',
                    ]) ?>

                    <?= $this->include('components/forms/checkbox', [
                        'name' => 'terms_accepted',
                        'label' => 'I agree to the terms and conditions',
                        'required' => true,
                    ]) ?>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
