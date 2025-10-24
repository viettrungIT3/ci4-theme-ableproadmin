<?php

namespace App\Controllers;

use App\Controllers\BaseThemeController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseThemeController
{
    protected $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    /**
     * Display a listing of users
     */
    public function index()
    {
        $this->setPageTitle('Users Management');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Users', 'url' => base_url('users')]
        ]);

        $users = $this->userModel->findAll();
        
        $data = [
            'users' => $users
        ];

        return $this->renderAdminView('pages/users/index', $data);
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        $this->setPageTitle('Create New User');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Users', 'url' => base_url('users')],
            ['title' => 'Create', 'url' => base_url('users/create')]
        ]);

        return $this->renderAdminView('pages/users/create');
    }

    /**
     * Store a newly created user
     */
    public function store()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'is_active' => $this->request->getPost('is_active') ?? 1
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('/users')->with('success', 'User created successfully');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }
    }

    /**
     * Display the specified user
     */
    public function show($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        $this->setPageTitle('User Details');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Users', 'url' => base_url('users')],
            ['title' => 'Details', 'url' => base_url('users/show/' . $id)]
        ]);

        $data = [
            'user' => $user
        ];

        return $this->renderAdminView('pages/users/show', $data);
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        $this->setPageTitle('Edit User');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Users', 'url' => base_url('users')],
            ['title' => 'Edit', 'url' => base_url('users/edit/' . $id)]
        ]);

        $data = [
            'user' => $user
        ];

        return $this->renderAdminView('pages/users/edit', $data);
    }

    /**
     * Update the specified user
     */
    public function update($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'is_active' => $this->request->getPost('is_active')
        ];

        // Only update password if provided
        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        if ($this->userModel->update($id, $data)) {
            return redirect()->to('/users')->with('success', 'User updated successfully');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }
    }

    /**
     * Remove the specified user
     */
    public function delete($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        $this->userModel->delete($id);
        return redirect()->to('/users')->with('success', 'User deleted successfully');
    }

    /**
     * Search users
     */
    public function search()
    {
        $search = $this->request->getGet('q');
        
        if ($search) {
            $users = $this->userModel->like('username', $search)
                                   ->orLike('email', $search)
                                   ->orLike('first_name', $search)
                                   ->orLike('last_name', $search)
                                   ->findAll();
        } else {
            $users = $this->userModel->findAll();
        }

        $this->setPageTitle('Search Users');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Users', 'url' => base_url('users')],
            ['title' => 'Search', 'url' => base_url('users/search')]
        ]);

        $data = [
            'users' => $users,
            'search' => $search
        ];

        return $this->renderAdminView('pages/users/search', $data);
    }

    /**
     * Toggle user status
     */
    public function toggleStatus($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        $newStatus = $user['is_active'] ? 0 : 1;
        $this->userModel->update($id, ['is_active' => $newStatus]);

        $status = $newStatus ? 'activated' : 'deactivated';
        return redirect()->to('/users')->with('success', "User {$status} successfully");
    }
}
