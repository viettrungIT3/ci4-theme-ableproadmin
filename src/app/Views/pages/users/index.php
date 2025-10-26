<?php
use App\Helpers\ElementHelper;

// Breadcrumb
echo ElementHelper::breadcrumb([
    ['title' => 'Dashboard', 'url' => base_url()],
    ['title' => 'Users', 'url' => base_url('users'), 'active' => true],
]);

// Success/Error alerts
if (session()->getFlashdata('success')) {
    echo ElementHelper::success(session()->getFlashdata('success'));
}
if (session()->getFlashdata('error')) {
    echo ElementHelper::error(session()->getFlashdata('error'));
}
?>

<!-- [ Users List ] start -->
<div class="col-sm-12">
    <?= ElementHelper::card(
        // Search Form
        '<div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="' . base_url('users/search') . '">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Search users..." value="' . esc($search ?? '') . '">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="ti ti-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>' .

        // Users Table
        '<div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>' .
        (
            !empty($users) ?
            implode('', array_map(function ($user) {
                return '<tr data-user-id="' . $user['id'] . '">
                                <td>' . $user['id'] . '</td>
                                <td>
                                    <img src="/assets/images/user/avatar-1.jpg" alt="avatar" class="rounded-circle" width="40" height="40">
                                </td>
                                <td>' . esc($user['username']) . '</td>
                                <td>' . esc($user['email']) . '</td>
                                <td>' . esc($user['first_name'] . ' ' . $user['last_name']) . '</td>
                                <td>' . ElementHelper::badge($user['is_active'] ? 'Active' : 'Inactive', $user['is_active'] ? 'success' : 'danger') . '</td>
                                <td>' . date('M d, Y', strtotime($user['created_at'])) . '</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        ' . ElementHelper::button('', [
                                'type' => 'primary',
                                'variant' => 'outline',
                                'size' => 'sm',
                                'icon' => 'ti ti-eye',
                                'href' => base_url('users/show/' . $user['id']),
                            ]) . '
                                        ' . ElementHelper::button('', [
                                'type' => 'warning',
                                'variant' => 'outline',
                                'size' => 'sm',
                                'icon' => 'ti ti-edit',
                                'href' => base_url('users/edit/' . $user['id']),
                            ]) . '
                                        <button class="btn btn-sm btn-outline-' . ($user['is_active'] ? 'danger' : 'success') . '"
                                                onclick="toggleUserStatus(' . $user['id'] . ', ' . ($user['is_active'] ? 'false' : 'true') . ')">
                                            <i class="ti ti-' . ($user['is_active'] ? 'ban' : 'check') . '"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteUser(' . $user['id'] . ')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>';
            }, $users)) :
            '<tr><td colspan="8" class="text-center">No users found</td></tr>'
        ) .
        '</tbody>
            </table>
        </div>',
        [
            'title' => 'Users Management',
            'footer' => ElementHelper::primaryButton('Add New User', base_url('users/create'), [
                'icon' => 'ti ti-plus',
            ]),
        ]
    ) ?>
</div>
<!-- [ Users List ] end -->

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
                updateUserStatusInTable(userId, newStatus);
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
                // Remove user from table without reload
                removeUserFromTable(userId);
            } else {
                Toast.error(result.message || 'Error deleting user');
            }
        } catch (error) {
            Toast.error('Network error. Please try again.');
        }
    }

    function updateUserStatusInTable(userId, newStatus) {
        // Find the user row
        const userRow = document.querySelector(`tr[data-user-id="${userId}"]`);
        if (!userRow) return;

        // Update status badge
        const statusBadge = userRow.querySelector('.badge');
        if (statusBadge) {
            statusBadge.className = `badge bg-${newStatus ? 'success' : 'danger'}`;
            statusBadge.textContent = newStatus ? 'Active' : 'Inactive';
        }

        // Update toggle button
        const toggleBtn = userRow.querySelector('button[onclick*="toggleUserStatus"]');
        if (toggleBtn) {
            toggleBtn.className = `btn btn-sm btn-outline-${newStatus ? 'danger' : 'success'}`;
            toggleBtn.setAttribute('onclick', `toggleUserStatus(${userId}, ${newStatus ? 'false' : 'true'})`);
            const icon = toggleBtn.querySelector('i');
            if (icon) {
                icon.className = `ti ti-${newStatus ? 'ban' : 'check'}`;
            }
        }
    }

    function removeUserFromTable(userId) {
        // Find and remove the user row
        const userRow = document.querySelector(`tr[data-user-id="${userId}"]`);
        if (userRow) {
            userRow.remove();
        }

        // Check if table is empty
        const tbody = document.querySelector('tbody');
        if (tbody && tbody.children.length === 0) {
            tbody.innerHTML = '<tr><td colspan="8" class="text-center">No users found</td></tr>';
        }
    }

</script>