<!-- [ Users List ] start -->
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Users Management</h5>
            <div class="card-header-right">
                <a href="<?= base_url('users/create') ?>" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Add New User
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Search Form -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <form method="GET" action="<?= base_url('users/search') ?>">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" placeholder="Search users..." value="<?= $search ?? '' ?>">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="ti ti-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Users Table -->
            <div class="table-responsive">
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
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td>
                                        <img src="<?= $themePath ?>/assets/images/user/avatar-1.jpg" 
                                             alt="avatar" class="rounded-circle" width="40" height="40">
                                    </td>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><?= esc($user['first_name'] . ' ' . $user['last_name']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $user['is_active'] ? 'success' : 'danger' ?>">
                                            <?= $user['is_active'] ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url('users/show/' . $user['id']) ?>" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="<?= base_url('users/edit/' . $user['id']) ?>" 
                                               class="btn btn-sm btn-outline-warning">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <a href="<?= base_url('users/toggle-status/' . $user['id']) ?>" 
                                               class="btn btn-sm btn-outline-<?= $user['is_active'] ? 'danger' : 'success' ?>"
                                               onclick="return confirm('Are you sure?')">
                                                <i class="ti ti-<?= $user['is_active'] ? 'ban' : 'check' ?>"></i>
                                            </a>
                                            <a href="<?= base_url('users/delete/' . $user['id']) ?>" 
                                               class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">No users found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- [ Users List ] end -->
