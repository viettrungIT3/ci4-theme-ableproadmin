<?php

namespace App\Controllers\Web\Admin;

use App\Controllers\BaseThemeController;

class FormDemo extends BaseThemeController
{
    public function index()
    {
        $this->setPageTitle('Form Components Demo');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Form Demo', 'url' => base_url('form-demo')],
        ]);

        $data = [
            'pageTitle' => $this->data['pageTitle'],
            'breadcrumb' => $this->data['breadcrumb'],
        ];

        return $this->renderAdminView('pages/form-demo', $data);
    }
}
