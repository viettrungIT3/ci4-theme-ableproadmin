<?php
use App\Helpers\ElementHelper;

// Breadcrumb
echo ElementHelper::breadcrumb([
    ['title' => 'Dashboard', 'url' => base_url()],
    ['title' => 'Users', 'url' => base_url('users')],
    ['title' => 'Create', 'url' => base_url('users/create'), 'active' => true],
]);

// Success/Error alerts
if (session()->getFlashdata('success')) {
    echo ElementHelper::success(session()->getFlashdata('success'));
}
if (session()->getFlashdata('error')) {
    echo ElementHelper::error(session()->getFlashdata('error'));
}
?>

<!-- [ Create User ] start -->
<div class="col-sm-12">
    <?= ElementHelper::card(
        '<form id="createUserForm">
            <div class="row">
                <div class="col-md-6">
                    ' . ElementHelper::input('username', [
                    'label' => 'Username',
                    'placeholder' => 'Enter username',
                    'required' => true,
                    'help_text' => 'Choose a unique username',
                ]) . '
                </div>
                <div class="col-md-6">
                    ' . ElementHelper::input('email', [
                    'label' => 'Email',
                    'type' => 'email',
                    'placeholder' => 'Enter email address',
                    'required' => true,
                    'help_text' => 'Enter a valid email address',
                ]) . '
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    ' . ElementHelper::input('first_name', [
                    'type' => 'text',
                    'label' => 'First Name',
                    'placeholder' => 'Enter first name',
                    'required' => true,
                ]) . '
                </div>
                <div class="col-md-6">
                    ' . ElementHelper::input('last_name', [
                    'type' => 'text',
                    'label' => 'Last Name',
                    'placeholder' => 'Enter last name',
                    'required' => true,
                ]) . '
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    ' . ElementHelper::input('password', [
                    'label' => 'Password',
                    'type' => 'password',
                    'placeholder' => 'Enter password',
                    'required' => true,
                    'help_text' => 'Minimum 6 characters',
                ]) . '
                </div>
                <div class="col-md-6">
                    ' . ElementHelper::select('is_active', [
                    'label' => 'Status',
                    'options' => [
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ],
                    'value' => '1',
                    'help_text' => 'User account status',
                ]) . '
                </div>
            </div>

            <div class="d-flex gap-2">
                ' . ElementHelper::successButton('Create User', null, [
                    'attributes' => ['type' => 'submit', 'id' => 'createUserBtn', 'disabled' => true],
                    'icon' => 'ti ti-check',
                ]) . '
                ' . ElementHelper::button('Cancel', [
                    'type' => 'secondary',
                    'variant' => 'outline',
                    'href' => base_url('users'),
                    'attributes' => ['id' => 'cancelCreateBtn'],
                ]) . '
            </div>
        </form>',
        [
            'title' => 'Create New User',
        ]
    ) ?>
</div>
<!-- [ Create User ] end -->

<script>
    // Script loaded

    // Store original form data (empty for create)
    let originalData = {};

    document.addEventListener('DOMContentLoaded', function () {
        // Store original values (empty for create)
        originalData = {
            username: '',
            email: '',
            first_name: '',
            last_name: '',
            password: '',
            is_active: '1'
        };

        // Add change listeners to enable/disable button
        const form = document.getElementById('createUserForm');
        const inputs = form.querySelectorAll('input, select');
        const submitBtn = document.getElementById('createUserBtn');

        // Check if button exists
        if (!submitBtn) {
            console.error('Submit button not found!');
            return;
        }

        inputs.forEach(input => {
            input.addEventListener('input', checkForChanges);
            input.addEventListener('change', checkForChanges);
        });

        function checkForChanges() {
            const currentData = {
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                first_name: document.getElementById('first_name').value,
                last_name: document.getElementById('last_name').value,
                password: document.getElementById('password').value,
                is_active: document.getElementById('is_active').value
            };

            // Check if all required fields are filled
            const hasRequiredData = currentData.username &&
                currentData.email &&
                currentData.first_name &&
                currentData.last_name &&
                currentData.password;

            // Enable/disable submit button
            if (submitBtn) {
                submitBtn.disabled = !hasRequiredData;

                if (hasRequiredData) {
                    submitBtn.innerHTML = '<i class="ti ti-check"></i> Create User';
                } else {
                    submitBtn.innerHTML = '<i class="ti ti-check"></i> Fill Required Fields';
                }
            }
        }

        // Initial check
        checkForChanges();
    });

    document.getElementById('createUserForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        // Convert is_active to boolean
        data.is_active = data.is_active === '1' ? 1 : 0;

        const btn = document.getElementById('createUserBtn');
        const originalText = btn.innerHTML;

        try {
            btn.innerHTML = '<i class="ti ti-loader-2"></i> Creating...';
            btn.disabled = true;

            const response = await fetch('<?= base_url('api/v1/users') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                if (typeof Toast !== 'undefined') {
                    Toast.success('User created successfully!');
                } else {
                    alert('SUCCESS: User created successfully!');
                }
                // Clear form
                document.getElementById('createUserForm').reset();

                // Reset button state
                setTimeout(() => {
                    const inputs = document.querySelectorAll('#createUserForm input, #createUserForm select');
                    inputs.forEach(input => {
                        input.dispatchEvent(new Event('input'));
                    });
                }, 100);

            } else {
                if (result.errors) {
                    const errorMsg = Object.values(result.errors).join('<br>');
                    if (typeof Toast !== 'undefined') {
                        Toast.error(errorMsg);
                    } else {
                        alert('ERROR: ' + errorMsg);
                    }
                } else {
                    const errorMsg = result.message || 'Error creating user';
                    if (typeof Toast !== 'undefined') {
                        Toast.error(errorMsg);
                    } else {
                        alert('ERROR: ' + errorMsg);
                    }
                }
            }
        } catch (error) {
            if (typeof Toast !== 'undefined') {
                Toast.error('Network error. Please try again.');
            } else {
                alert('ERROR: Network error. Please try again.');
            }
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    });

</script>