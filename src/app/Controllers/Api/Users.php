<?php

namespace App\Controllers\Api;

use App\Controllers\ApiController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends ApiController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Get all users
     */
    public function index()
    {
        $users = $this->userModel->findAll();
        return $this->success($users, 'Users retrieved successfully');
    }

    /**
     * Get user by ID
     */
    public function show($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->error('User not found', 404);
        }

        return $this->success($user, 'User retrieved successfully');
    }

    /**
     * Create new user
     */
    public function create()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'is_active' => $this->request->getPost('is_active') ?? 1
        ];

        if (!$this->userModel->insert($data)) {
            return $this->validationError($this->userModel->errors());
        }

        $user = $this->userModel->find($this->userModel->getInsertID());
        return $this->success($user, 'User created successfully', 201);
    }

    /**
     * Update user
     */
    public function update($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->error('User not found', 404);
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

        if (!$this->userModel->update($id, $data)) {
            return $this->validationError($this->userModel->errors());
        }

        $updatedUser = $this->userModel->find($id);
        return $this->success($updatedUser, 'User updated successfully');
    }

    /**
     * Delete user
     */
    public function delete($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->error('User not found', 404);
        }

        $this->userModel->delete($id);
        return $this->success(null, 'User deleted successfully');
    }

    /**
     * Get active users only
     */
    public function active()
    {
        $users = $this->userModel->getActiveUsers();
        return $this->success($users, 'Active users retrieved successfully');
    }
}
