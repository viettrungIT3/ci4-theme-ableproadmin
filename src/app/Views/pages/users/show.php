<?php
use App\Helpers\ElementHelper;

// Breadcrumb
echo ElementHelper::breadcrumb([
    ['title' => 'Dashboard', 'url' => base_url()],
    ['title' => 'Users', 'url' => base_url('users')],
    ['title' => 'Details', 'url' => base_url('users/show/' . $user['id']), 'active' => true]
]);

// Success/Error alerts
if (session()->getFlashdata('success')) {
    echo ElementHelper::success(session()->getFlashdata('success'));
}
if (session()->getFlashdata('error')) {
    echo ElementHelper::error(session()->getFlashdata('error'));
}
?>

<!-- [ User Details ] start -->
<div class="col-sm-12">
    <?= ElementHelper::card(
        '<div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="' . $themePath . '/assets/images/user/avatar-1.jpg" alt="avatar" class="rounded-circle mb-3" width="120" height="120">
                    <h4>' . esc($user['first_name'] . ' ' . $user['last_name']) . '</h4>
                    <p class="text-muted">' . esc($user['username']) . '</p>
                    ' . ElementHelper::badge($user['is_active'] ? 'Active' : 'Inactive', $user['is_active'] ? 'success' : 'danger', ['size' => 'lg']) . '
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">User ID</label>
                            <p class="form-control-plaintext">' . $user['id'] . '</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <p class="form-control-plaintext">' . esc($user['username']) . '</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <p class="form-control-plaintext">
                                <a href="mailto:' . esc($user['email']) . '">' . esc($user['email']) . '</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p class="form-control-plaintext">
                                ' . ElementHelper::badge($user['is_active'] ? 'Active' : 'Inactive', $user['is_active'] ? 'success' : 'danger') . '
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">First Name</label>
                            <p class="form-control-plaintext">' . esc($user['first_name']) . '</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Name</label>
                            <p class="form-control-plaintext">' . esc($user['last_name']) . '</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Created At</label>
                            <p class="form-control-plaintext">' . date('M d, Y H:i:s', strtotime($user['created_at'])) . '</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Updated</label>
                            <p class="form-control-plaintext">' . date('M d, Y H:i:s', strtotime($user['updated_at'])) . '</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <hr>
        
        <div class="d-flex gap-2">
            ' . ElementHelper::button('Edit User', [
                    'type' => 'warning',
                    'icon' => 'ti ti-edit',
                    'href' => base_url('users/edit/' . $user['id'])
                ]) . '
            <button class="btn btn-' . ($user['is_active'] ? 'danger' : 'success') . '"
                    onclick="toggleUserStatus(' . $user['id'] . ', ' . ($user['is_active'] ? 'false' : 'true') . ')">
                <i class="ti ti-' . ($user['is_active'] ? 'ban' : 'check') . '"></i> 
                ' . ($user['is_active'] ? 'Deactivate' : 'Activate') . ' User
            </button>
            <button class="btn btn-danger"
                    onclick="deleteUser(' . $user['id'] . ')">
                <i class="ti ti-trash"></i> Delete User
            </button>
        </div>',
        [
            'title' => 'User Details',
            'footer' => ElementHelper::button('Back to Users', [
                'type' => 'secondary',
                'variant' => 'outline',
                'icon' => 'ti ti-arrow-left',
                'href' => base_url('users')
            ])
        ]
    ) ?>
</div>
<!-- [ User Details ] end -->

<script>
    async function toggleUserStatus(userId, newStatus) {
        if (!confirm('Are you sure you want to ' + (newStatus ? 'activate' : 'deactivate') + ' this user?')) {
            return;
        }

        try {
            const response = await fetch(`<?= base_url('api/v1/users/') ?>${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ is_active: newStatus ? 1 : 0 })
            });

            const result = await response.json();

            if (response.ok) {
                Toast.success('User status updated successfully!');
                // Update UI without reload
                updateUserStatusOnPage(newStatus);
            } else {
                Toast.error(result.message || 'Error updating user status');
            }
        } catch (error) {
            Toast.error('Network error. Please try again.');
        }
    }

    async function deleteUser(userId) {
        if (!confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
            return;
        }

        try {
            const response = await fetch(`<?= base_url('api/v1/users/') ?>${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (response.ok) {
                Toast.success('User deleted successfully!');
                // Redirect to users list after delay
                setTimeout(() => {
                    window.location.href = '<?= base_url('users') ?>';
                }, 1500);
            } else {
                Toast.error(result.message || 'Error deleting user');
            }
        } catch (error) {
            Toast.error('Network error. Please try again.');
        }
    }

    function updateUserStatusOnPage(newStatus) {
        // Update status badge
        const statusBadge = document.querySelector('.badge');
        if (statusBadge) {
            statusBadge.className = `badge bg-${newStatus ? 'success' : 'danger'} fs-6`;
            statusBadge.textContent = newStatus ? 'Active' : 'Inactive';
        }

        // Update status in details section
        const statusDetail = document.querySelector('p.form-control-plaintext .badge');
        if (statusDetail) {
            statusDetail.className = `badge bg-${newStatus ? 'success' : 'danger'}`;
            statusDetail.textContent = newStatus ? 'Active' : 'Inactive';
        }

        // Update toggle button
        const toggleBtn = document.querySelector('button[onclick*="toggleUserStatus"]');
        if (toggleBtn) {
            toggleBtn.className = `btn btn-${newStatus ? 'danger' : 'success'}`;
            toggleBtn.setAttribute('onclick', `toggleUserStatus(<?= $user['id'] ?>, ${newStatus ? 'false' : 'true'})`);
            const icon = toggleBtn.querySelector('i');
            if (icon) {
                icon.className = `ti ti-${newStatus ? 'ban' : 'check'}`;
            }
            const text = toggleBtn.querySelector('span') || toggleBtn;
            if (text) {
                text.innerHTML = `<i class="ti ti-${newStatus ? 'ban' : 'check'}"></i> ${newStatus ? 'Deactivate' : 'Activate'} User`;
            }
        }
    }

</script>