<?php

namespace App\Controllers\Web\Auth;

use App\Controllers\BaseThemeController;

class Login extends BaseThemeController
{
    public function index()
    {
        $this->setPageTitle('Login');
        $this->setBreadcrumb([
            ['title' => 'Login', 'url' => '/auth/login', 'active' => true]
        ]);
        return $this->renderAuthView('pages/auth/login');
    }

    public function process()
    {
        // Handle login logic here
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validate credentials
        // ... validation logic ...

        return redirect()->to('/dashboard');
    }
}
