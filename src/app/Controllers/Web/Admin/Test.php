<?php

namespace App\Controllers\Web\Admin;

use App\Controllers\BaseThemeController;

class Test extends BaseThemeController
{
    public function theme()
    {
        $this->setPageTitle('Theme Persistence Test');
        $this->setBreadcrumb([
            ['title' => 'Home', 'url' => '/'],
            ['title' => 'Test', 'url' => '/test-theme', 'active' => true],
        ]);

        return $this->renderAdminView('pages/test-theme');
    }

    public function toast()
    {
        $this->setPageTitle('Toast Notification Test');
        $this->setBreadcrumb([
            ['title' => 'Home', 'url' => '/'],
            ['title' => 'Test', 'url' => '/test-toast', 'active' => true],
        ]);

        return $this->renderAdminView('pages/test-toast');
    }

    public function toastSimple()
    {
        $this->setPageTitle('Simple Toast Test');
        $this->setBreadcrumb([
            ['title' => 'Home', 'url' => '/'],
            ['title' => 'Test', 'url' => '/test-toast-simple', 'active' => true],
        ]);

        return $this->renderAdminView('pages/test-toast-simple');
    }
}
