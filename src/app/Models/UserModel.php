<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'is_active'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'first_name' => 'permit_empty|max_length[100]',
        'last_name' => 'permit_empty|max_length[100]',
        'is_active' => 'permit_empty|in_list[0,1]'
    ];

    // Validation rules for updates (less strict)
    protected $updateValidationRules = [
        'username' => 'permit_empty|min_length[3]|max_length[100]|is_unique[users.username,id,{id}]',
        'email' => 'permit_empty|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'permit_empty|min_length[6]|max_length[255]',
        'first_name' => 'permit_empty|min_length[2]|max_length[100]',
        'last_name' => 'permit_empty|min_length[2]|max_length[100]',
        'is_active' => 'permit_empty|in_list[0,1]'
    ];

    // Validation rules for partial updates
    protected $partialUpdateValidationRules = [
        'username' => 'permit_empty|min_length[3]|max_length[100]|is_unique[users.username,id,{id}]',
        'email' => 'permit_empty|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'permit_empty|min_length[6]|max_length[255]',
        'first_name' => 'permit_empty|min_length[2]|max_length[100]',
        'last_name' => 'permit_empty|min_length[2]|max_length[100]',
        'is_active' => 'permit_empty|in_list[0,1]'
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username is required',
            'min_length' => 'Username must be at least 3 characters',
            'max_length' => 'Username cannot exceed 100 characters',
            'is_unique' => 'Username already exists'
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
            'is_unique' => 'Email already exists'
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 6 characters',
            'max_length' => 'Password cannot exceed 255 characters'
        ],
        'first_name' => [
            'min_length' => 'First name must be at least 2 characters',
            'max_length' => 'First name cannot exceed 100 characters'
        ],
        'last_name' => [
            'min_length' => 'Last name must be at least 2 characters',
            'max_length' => 'Last name cannot exceed 100 characters'
        ],
        'is_active' => [
            'in_list' => 'Status must be either active or inactive'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function findByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    public function findByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }

    public function getActiveUsers()
    {
        return $this->where('is_active', 1)->findAll();
    }

    /**
     * Update user with flexible validation
     */
    public function updateUser($id, $data)
    {
        // Store original validation rules
        $originalRules = $this->validationRules;

        // Use update validation rules
        $this->validationRules = $this->updateValidationRules;

        // Replace {id} placeholder in validation rules
        foreach ($this->validationRules as $field => $rules) {
            $this->validationRules[$field] = str_replace('{id}', $id, $rules);
        }

        // Only validate fields that are being updated
        $fieldsToValidate = array_keys($data);
        $filteredRules = [];
        foreach ($fieldsToValidate as $field) {
            if (isset($this->validationRules[$field])) {
                $filteredRules[$field] = $this->validationRules[$field];
            }
        }
        $this->validationRules = $filteredRules;

        $result = $this->update($id, $data);

        // Restore original validation rules
        $this->validationRules = $originalRules;

        return $result;
    }

    /**
     * Partial update user with minimal validation
     */
    public function partialUpdateUser($id, $data)
    {
        // Store original validation rules
        $originalRules = $this->validationRules;

        // Apply partial update validation rules
        $this->validationRules = $this->partialUpdateValidationRules;

        // Replace {id} placeholder in validation rules
        foreach ($this->validationRules as $field => $rules) {
            $this->validationRules[$field] = str_replace('{id}', $id, $rules);
        }

        // Only validate fields that are being updated
        $fieldsToValidate = array_keys($data);
        $filteredRules = [];
        foreach ($fieldsToValidate as $field) {
            if (isset($this->validationRules[$field])) {
                $filteredRules[$field] = $this->validationRules[$field];
            }
        }
        $this->validationRules = $filteredRules;

        $result = $this->update($id, $data);

        // Restore original validation rules
        $this->validationRules = $originalRules;

        return $result;
    }

    /**
     * Validate single field
     */
    public function validateField($field, $value, $id = null)
    {
        $rules = $this->partialUpdateValidationRules;

        if (!isset($rules[$field])) {
            return true;
        }

        $rule = $rules[$field];

        // Replace {id} placeholder if provided
        if ($id && strpos($rule, '{id}') !== false) {
            $rule = str_replace('{id}', $id, $rule);
        }

        $this->validationRules = [$field => $rule];
        $this->validationMessages = $this->getFieldValidationMessages($field);

        $result = $this->validate([$field => $value]);

        // Reset validation rules
        $this->validationRules = [];

        return $result;
    }

    /**
     * Get validation messages for specific field
     */
    public function getFieldValidationMessages($field)
    {
        return isset($this->validationMessages[$field])
            ? [$field => $this->validationMessages[$field]]
            : [];
    }
}
