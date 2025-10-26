<?php

namespace App\Controllers\Web\Admin;

use App\Controllers\BaseThemeController;
use App\Models\UserModel;

class Users extends BaseThemeController
{
    protected $userModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
    }

    /**
     * Display a listing of users.
     */
    public function index()
    {
        $this->setPageTitle('Users Management');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Users', 'url' => base_url('users')],
        ]);

        $users = $this->userModel->findAll();

        $data = [
            'users' => $users,
        ];

        return $this->renderAdminView('pages/users/index', $data);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $this->setPageTitle('Create New User');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Users', 'url' => base_url('users')],
            ['title' => 'Create', 'url' => base_url('users/create')],
        ]);

        return $this->renderAdminView('pages/users/create');
    }

    /**
     * Display the specified user.
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
            ['title' => 'Details', 'url' => base_url('users/show/' . $id)],
        ]);

        $data = [
            'user' => $user,
        ];

        return $this->renderAdminView('pages/users/show', $data);
    }

    /**
     * Show the form for editing the specified user.
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
            ['title' => 'Edit', 'url' => base_url('users/edit/' . $id)],
        ]);

        $data = [
            'user' => $user,
        ];

        return $this->renderAdminView('pages/users/edit', $data);
    }

    /**
     * Search users.
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
            ['title' => 'Search', 'url' => base_url('users/search')],
        ]);

        $data = [
            'users' => $users,
            'search' => $search,
        ];

        return $this->renderAdminView('pages/users/search', $data);
    }
}
