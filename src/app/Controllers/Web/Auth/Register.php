<?php

namespace App\Controllers\Web\Auth;

use App\Controllers\BaseThemeController;

class Register extends BaseThemeController
{
    public function index()
    {
        $this->setPageTitle('Register');
        $this->setBreadcrumb([
            ['title' => 'Register', 'url' => '/auth/register', 'active' => true]
        ]);
        return $this->renderAuthView('pages/auth/register');
    }

    public function process()
    {
        // Handle registration logic here
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        // Validate and create user
        // ... registration logic ...

        return redirect()->to('/auth/login');
    }
}
