<?php

namespace App\Controllers\Api\V1;

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
        $data = $this->request->getJSON(true) ?? [];

        // Set default values
        $data['is_active'] = $data['is_active'] ?? 1;

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

        $data = $this->request->getJSON(true) ?? [];

        // Only update password if provided
        if (empty($data['password'])) {
            unset($data['password']);
        }

        if (!$this->userModel->updateUser($id, $data)) {
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

    /**
     * Check username availability
     */
    public function checkUsername()
    {
        try {
            $username = $this->request->getGet('username');

            if (!$username) {
                return $this->respond([
                    'status' => 400,
                    'message' => 'Username is required'
                ], 400);
            }

            // Check if username exists
            $existingUser = $this->userModel->where('username', $username)->first();
            $available = !$existingUser;

            return $this->respond([
                'status' => 200,
                'available' => $available,
                'message' => $available ? 'Username is available' : 'Username is already taken'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 500,
                'message' => 'Error checking username: ' . $e->getMessage()
            ], 500);
        }
    }
}
