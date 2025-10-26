<?php
use App\Helpers\ElementHelper;

// Breadcrumb
echo ElementHelper::breadcrumb([
    ['title' => 'Dashboard', 'url' => base_url()],
    ['title' => 'Users', 'url' => base_url('users')],
    ['title' => 'Search', 'url' => base_url('users/search'), 'active' => true]
]);

// Success/Error alerts
if (session()->getFlashdata('success')) {
    echo ElementHelper::success(session()->getFlashdata('success'));
}
if (session()->getFlashdata('error')) {
    echo ElementHelper::error(session()->getFlashdata('error'));
}
?>

<!-- [ Search Users ] start -->
<div class="col-sm-12">
    <?= ElementHelper::card(
        // Search Form
        '<div class="row mb-4">
            <div class="col-md-8">
                <form method="GET" action="' . base_url('users/search') . '">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Search users by username, email, first name, or last name..." value="' . esc($search ?? '') . '">
                        ' . ElementHelper::button('Search', [
                    'type' => 'primary',
                    'icon' => 'ti ti-search',
                    'options' => ['type' => 'submit']
                ]) . '
                    </div>
                </form>
            </div>
            <div class="col-md-4 text-end">
                ' . (!empty($search) ?
            ElementHelper::button('Clear Search', [
                'type' => 'secondary',
                'variant' => 'outline',
                'icon' => 'ti ti-x',
                'href' => base_url('users')
            ]) : ''
        ) . '
            </div>
        </div>' .

        // Search Results (will be shown via Toast)
        '' .

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
        (!empty($users) ?
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
                                    'href' => base_url('users/show/' . $user['id'])
                                ]) . '
                                        ' . ElementHelper::button('', [
                                    'type' => 'warning',
                                    'variant' => 'outline',
                                    'size' => 'sm',
                                    'icon' => 'ti ti-edit',
                                    'href' => base_url('users/edit/' . $user['id'])
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
            '<tr><td colspan="8" class="text-center">' . (!empty($search) ? 'No users found matching your search criteria' : 'No users found') . '</td></tr>'
        ) .
        '</tbody>
            </table>
        </div>',
        [
            'title' => 'Search Users',
            'footer' => ElementHelper::button('Back to Users', [
                'type' => 'secondary',
                'variant' => 'outline',
                'icon' => 'ti ti-arrow-left',
                'href' => base_url('users')
            ])
        ]
    ) ?>
</div>
<!-- [ Search Users ] end -->

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

    // Show search results toast if there's a search term
    <?php if (!empty($search)): ?>
        document.addEventListener('DOMContentLoaded', function () {
            const searchTerm = '<?= esc($search) ?>';
            const userCount = <?= count($users) ?>;

            if (searchTerm && userCount > 0) {
                Toast.info(`Search results for: <strong>${searchTerm}</strong> (${userCount} users found)`, {
                    duration: 4000,
                    position: 'top-center'
                });
            } else if (searchTerm && userCount === 0) {
                Toast.warning(`No users found for: <strong>${searchTerm}</strong>`, {
                    duration: 4000,
                    position: 'top-center'
                });
            }
        });
    <?php endif; ?>

</script>