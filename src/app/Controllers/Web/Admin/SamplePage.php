<?php

namespace App\Controllers\Web\Admin;

use App\Controllers\BaseThemeController;

class SamplePage extends BaseThemeController
{
    public function index()
    {
        $this->setPageTitle('Sample Page');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Sample Page', 'url' => base_url('sample-page')],
        ]);

        return $this->renderAdminView('pages/sample-page');
    }
}
