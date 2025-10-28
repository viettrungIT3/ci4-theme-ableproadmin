<?php

namespace App\Controllers\Web\Admin;

use App\Controllers\BaseThemeController;

class DashboardDemo extends BaseThemeController
{
    public function index()
    {
        $this->setPageTitle('Demo Theme');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Demo Theme', 'url' => base_url('dashboard/demo-theme')],
        ]);

        return $this->renderAdminView('pages/dashboard/demo-theme');
    }
}
