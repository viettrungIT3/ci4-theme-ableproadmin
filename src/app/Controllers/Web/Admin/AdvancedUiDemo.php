<?php

namespace App\Controllers\Web\Admin;

use App\Controllers\BaseThemeController;

class AdvancedUiDemo extends BaseThemeController
{
    public function index()
    {
        $this->setPageTitle('Advanced UI Components Demo');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Advanced UI Demo', 'url' => base_url('advanced-ui-demo')],
        ]);

        return $this->renderAdminView('pages/advanced-ui-demo');
    }
}
