<?php

namespace App\Controllers\Web\Admin;

use App\Controllers\BaseThemeController;

class Dashboard extends BaseThemeController
{
    public function index()
    {
        $this->setPageTitle('Dashboard');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url('dashboard')]
        ]);

        $data = [
            'stats' => [
                'total_users' => 1250,
                'total_orders' => 3420,
                'total_revenue' => 125000,
                'total_products' => 890
            ],
            'recent_activities' => [
                ['user' => 'John Doe', 'action' => 'Created new order', 'time' => '2 minutes ago'],
                ['user' => 'Jane Smith', 'action' => 'Updated profile', 'time' => '5 minutes ago'],
                ['user' => 'Mike Johnson', 'action' => 'Deleted product', 'time' => '10 minutes ago']
            ]
        ];

        return $this->renderAdminView('pages/dashboard/index', $data);
    }

    public function analytics()
    {
        $this->setPageTitle('Analytics Dashboard');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Analytics', 'url' => base_url('dashboard/analytics')]
        ]);

        $this->addCss($this->getThemeService()->getCssPath('plugins/apexcharts.min.css'));
        $this->addJs($this->getThemeService()->getJsPath('plugins/apexcharts.min.js'));
        $this->addJs($this->getThemeService()->getJsPath('pages/dashboard-analytics.js'));

        return $this->renderAdminView('pages/dashboard/analytics');
    }

    public function finance()
    {
        $this->setPageTitle('Finance Dashboard');
        $this->setBreadcrumb([
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Finance', 'url' => base_url('dashboard/finance')]
        ]);

        $this->addCss($this->getThemeService()->getCssPath('plugins/apexcharts.min.css'));
        $this->addJs($this->getThemeService()->getJsPath('plugins/apexcharts.min.js'));
        $this->addJs($this->getThemeService()->getJsPath('pages/dashboard-finance.js'));

        return $this->renderAdminView('pages/dashboard/finance');
    }
}
