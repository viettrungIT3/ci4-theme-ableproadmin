<?php
use App\Helpers\ElementHelper;

// Breadcrumb
echo ElementHelper::breadcrumb([
    ['title' => 'Dashboard', 'url' => base_url()],
    ['title' => 'Users', 'url' => base_url('users')],
    ['title' => 'Edit', 'url' => base_url('users/edit/' . $user['id']), 'active' => true],
]);

// Success/Error alerts
if (session()->getFlashdata('success')) {
    echo ElementHelper::success(session()->getFlashdata('success'));
}
if (session()->getFlashdata('error')) {
    echo ElementHelper::error(session()->getFlashdata('error'));
}
?>

<!-- [ Edit User ] start -->
<div class="col-sm-12">
    <?= ElementHelper::card(
        '<form id="editUserForm">
            <div class="row">
                <div class="col-md-6">
                    ' . ElementHelper::input('username', [
                    'label' => 'Username',
                    'value' => $user['username'],
                    'placeholder' => 'Enter username',
                    'required' => false,
                    'help_text' => 'Leave unchanged or enter new username',
                ]) . '
                </div>
                <div class="col-md-6">
                    ' . ElementHelper::input('email', [
                    'label' => 'Email',
                    'type' => 'email',
                    'value' => $user['email'],
                    'placeholder' => 'Email address',
                    'required' => false,
                    'readonly' => true,
                    'help_text' => 'Email cannot be changed',
                ]) . '
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    ' . ElementHelper::input('first_name', [
                    'label' => 'First Name',
                    'value' => $user['first_name'],
                    'placeholder' => 'Enter first name',
                    'required' => false,
                    'help_text' => 'Enter new first name',
                ]) . '
                </div>
                <div class="col-md-6">
                    ' . ElementHelper::input('last_name', [
                    'label' => 'Last Name',
                    'value' => $user['last_name'],
                    'placeholder' => 'Enter last name',
                    'required' => false,
                    'help_text' => 'Enter new last name',
                ]) . '
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    ' . ElementHelper::input('password', [
                    'label' => 'Password',
                    'type' => 'password',
                    'placeholder' => 'Enter new password (leave blank to keep current)',
                    'help_text' => 'Leave blank to keep current password',
                ]) . '
                </div>
                <div class="col-md-6">
                    ' . ElementHelper::select('is_active', [
                    'label' => 'Status',
                    'options' => [
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ],
                    'value' => $user['is_active'],
                    'help_text' => 'User account status',
                ]) . '
                </div>
            </div>

            <div class="d-flex gap-2">
                ' . ElementHelper::successButton('Update User', null, [
                    'type' => 'submit',
                    'icon' => 'ti ti-check',
                    'attributes' => [
                        'id' => 'editUserBtn',
                        'disabled' => true,
                    ],
                ]) . '
                ' . ElementHelper::button('Cancel', [
                    'type' => 'secondary',
                    'variant' => 'outline',
                    'href' => base_url('users/show/' . $user['id']),
                    'attributes' => [
                        'id' => 'cancelBtn',
                    ],
                ]) . '
            </div>
        </form>',
        [
            'title' => 'Edit User',
        ]
    ) ?>
</div>
<!-- [ Edit User ] end -->

<script>
    // Store original form data
    let originalData = {};

    document.addEventListener('DOMContentLoaded', function () {
        // Store original values
        originalData = {
            username: document.getElementById('username').value,
            first_name: document.getElementById('first_name').value,
            last_name: document.getElementById('last_name').value,
            password: '',
            is_active: document.getElementById('is_active').value
        };

        // Add change listeners to enable/disable button
        const form = document.getElementById('editUserForm');
        const inputs = form.querySelectorAll('input, select');
        const submitBtn = document.getElementById('editUserBtn');

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
                first_name: document.getElementById('first_name').value,
                last_name: document.getElementById('last_name').value,
                password: document.getElementById('password').value,
                is_active: document.getElementById('is_active').value
            };

            // Check if any field has changed
            const hasChanges = Object.keys(currentData).some(key => {
                if (key === 'password') {
                    return currentData[key] !== ''; // Password changed if not empty
                }
                return currentData[key] !== originalData[key];
            });

            // Enable/disable submit button
            if (submitBtn) {
                submitBtn.disabled = !hasChanges;

                if (hasChanges) {
                    submitBtn.innerHTML = '<i class="ti ti-check"></i> Update User';
                } else {
                    submitBtn.innerHTML = '<i class="ti ti-check"></i> No Changes';
                }
            }
        }

        // Initial check
        checkForChanges();
    });

    document.getElementById('editUserForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        // Convert is_active to boolean
        data.is_active = data.is_active === '1' ? 1 : 0;

        // Remove empty password
        if (!data.password) {
            delete data.password;
        }

        // Remove email (cannot be changed)
        delete data.email;

        // Only send changed fields
        const changedData = {};
        Object.keys(data).forEach(key => {
            if (key === 'password') {
                if (data[key] !== '') {
                    changedData[key] = data[key];
                }
            } else if (data[key] !== originalData[key]) {
                changedData[key] = data[key];
            }
        });

        // If no changes, show message
        if (Object.keys(changedData).length === 0) {
            if (typeof Toast !== 'undefined') {
                Toast.info('No changes detected');
            } else {
                alert('INFO: No changes detected');
            }
            return;
        }

        const btn = document.getElementById('editUserBtn');
        const originalText = btn.innerHTML;

        try {
            btn.innerHTML = '<i class="ti ti-loader-2"></i> Updating...';
            btn.disabled = true;

            const response = await fetch('<?= base_url('api/v1/users/' . $user['id']) ?>', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(changedData)
            });

            const result = await response.json();

            if (response.ok) {
                // Show success message
                if (typeof Toast !== 'undefined') {
                    Toast.success('User updated successfully!');
                } else {
                    alert('SUCCESS: User updated successfully!');
                }

                // Update original data with new values
                Object.keys(changedData).forEach(key => {
                    if (key === 'password') {
                        originalData[key] = ''; // Reset password field
                        document.getElementById('password').value = '';
                    } else {
                        originalData[key] = changedData[key];
                    }
                });

                // Re-check for changes
                setTimeout(() => {
                    const inputs = document.querySelectorAll('#editUserForm input, #editUserForm select');
                    inputs.forEach(input => {
                        input.dispatchEvent(new Event('input'));
                    });
                }, 100);

            } else {
                // Show error messages
                if (result.errors) {
                    const errorMsg = Object.values(result.errors).join('<br>');
                    if (typeof Toast !== 'undefined') {
                        Toast.error(errorMsg);
                    } else {
                        alert('ERROR: ' + errorMsg);
                    }
                } else {
                    const errorMsg = result.message || 'Error updating user';
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