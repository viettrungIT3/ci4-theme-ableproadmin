<?php
/**
 * Dashboard Demo Page.
 *
 * This page demonstrates the usage of dashboard widgets including
 * statistics, charts, and data tables.
 */
$this->extend('layouts/admin');
$this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Widgets Demo</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url() ?>">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#!">Components</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#!">Dashboard Widgets</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Widgets -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Statistics Widgets</h5>
                <p class="text-muted mb-0">Display key metrics with icons, values, and trends</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <?= $this->include('components/widgets/statistic', [
                            'title' => 'Total Revenue',
                            'value' => '$45,678',
                            'subtitle' => 'Last 30 days',
                            'icon' => 'ti ti-currency-dollar',
                            'trend' => 'up',
                            'trendValue' => '+12.5%',
                            'color' => 'success',
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->include('components/widgets/statistic', [
                            'title' => 'Total Users',
                            'value' => '2,456',
                            'subtitle' => 'Active users',
                            'icon' => 'ti ti-users',
                            'trend' => 'up',
                            'trendValue' => '+8.2%',
                            'color' => 'primary',
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->include('components/widgets/statistic', [
                            'title' => 'Orders',
                            'value' => '1,234',
                            'subtitle' => 'This month',
                            'icon' => 'ti ti-shopping-cart',
                            'trend' => 'down',
                            'trendValue' => '-3.1%',
                            'color' => 'warning',
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->include('components/widgets/statistic', [
                            'title' => 'Conversion Rate',
                            'value' => '3.2%',
                            'subtitle' => 'Average rate',
                            'icon' => 'ti ti-target',
                            'trend' => 'neutral',
                            'trendValue' => '0.0%',
                            'color' => 'info',
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart Widgets -->
<div class="row">
    <div class="col-md-8">
        <?= $this->include('components/widgets/chart', [
            'title' => 'Sales Analytics',
            'type' => 'line',
            'data' => [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                'datasets' => [
                    [
                        'label' => 'Sales',
                        'data' => [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000],
                        'borderColor' => '#0d6efd',
                        'backgroundColor' => 'rgba(13, 110, 253, 0.1)',
                        'tension' => 0.4,
                    ],
                    [
                        'label' => 'Revenue',
                        'data' => [8000, 12000, 10000, 18000, 15000, 22000, 20000, 28000],
                        'borderColor' => '#198754',
                        'backgroundColor' => 'rgba(25, 135, 84, 0.1)',
                        'tension' => 0.4,
                    ],
                ],
            ],
            'height' => '400px',
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $this->include('components/widgets/chart', [
            'title' => 'Traffic Sources',
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Direct', 'Social', 'Email', 'Referral'],
                'datasets' => [
                    [
                        'data' => [45, 25, 20, 10],
                        'backgroundColor' => [
                            '#0d6efd',
                            '#198754',
                            '#ffc107',
                            '#dc3545',
                        ],
                        'borderWidth' => 2,
                        'borderColor' => '#fff',
                    ],
                ],
            ],
            'height' => '400px',
        ]) ?>
    </div>
</div>

<!-- Data Table Widget -->
<div class="row">
    <div class="col-md-12">
        <?= $this->include('components/widgets/data-table', [
            'title' => 'Recent Orders',
            'headers' => [
                ['key' => 'id', 'label' => 'Order ID', 'sortable' => true],
                ['key' => 'customer', 'label' => 'Customer', 'sortable' => true],
                ['key' => 'product', 'label' => 'Product', 'sortable' => true],
                ['key' => 'amount', 'label' => 'Amount', 'sortable' => true],
                ['key' => 'status', 'label' => 'Status', 'sortable' => false],
                ['key' => 'date', 'label' => 'Date', 'sortable' => true],
                ['key' => 'actions', 'label' => 'Actions', 'sortable' => false],
            ],
            'data' => [
                ['id' => '#12345', 'customer' => 'John Doe', 'product' => 'Laptop Pro', 'amount' => '$1,299', 'status' => 'Completed', 'date' => '2024-01-15'],
                ['id' => '#12346', 'customer' => 'Jane Smith', 'product' => 'Wireless Mouse', 'amount' => '$29', 'status' => 'Pending', 'date' => '2024-01-14'],
                ['id' => '#12347', 'customer' => 'Bob Johnson', 'product' => 'Mechanical Keyboard', 'amount' => '$89', 'status' => 'Shipped', 'date' => '2024-01-13'],
                ['id' => '#12348', 'customer' => 'Alice Brown', 'product' => 'Monitor 4K', 'amount' => '$399', 'status' => 'Completed', 'date' => '2024-01-12'],
                ['id' => '#12349', 'customer' => 'Charlie Wilson', 'product' => 'Gaming Chair', 'amount' => '$199', 'status' => 'Cancelled', 'date' => '2024-01-11'],
                ['id' => '#12350', 'customer' => 'Diana Lee', 'product' => 'USB-C Hub', 'amount' => '$49', 'status' => 'Completed', 'date' => '2024-01-10'],
                ['id' => '#12351', 'customer' => 'Eva Garcia', 'product' => 'Bluetooth Speaker', 'amount' => '$79', 'status' => 'Pending', 'date' => '2024-01-09'],
                ['id' => '#12352', 'customer' => 'Frank Miller', 'product' => 'Webcam HD', 'amount' => '$99', 'status' => 'Shipped', 'date' => '2024-01-08'],
            ],
            'options' => [
                'pageSize' => 5,
                'searchable' => true,
                'sortable' => true,
                'pagination' => true,
                'exportable' => true,
            ],
        ]) ?>
    </div>
</div>

<!-- Additional Chart Examples -->
<div class="row">
    <div class="col-md-6">
        <?= $this->include('components/widgets/chart', [
            'title' => 'Monthly Sales',
            'type' => 'bar',
            'data' => [
                'labels' => ['Q1', 'Q2', 'Q3', 'Q4'],
                'datasets' => [
                    [
                        'label' => '2023',
                        'data' => [45000, 52000, 48000, 61000],
                        'backgroundColor' => '#0d6efd',
                        'borderColor' => '#0d6efd',
                        'borderWidth' => 1,
                    ],
                    [
                        'label' => '2024',
                        'data' => [48000, 55000, 52000, 65000],
                        'backgroundColor' => '#198754',
                        'borderColor' => '#198754',
                        'borderWidth' => 1,
                    ],
                ],
            ],
            'height' => '300px',
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $this->include('components/widgets/chart', [
            'title' => 'User Growth',
            'type' => 'area',
            'data' => [
                'labels' => ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'],
                'datasets' => [
                    [
                        'label' => 'New Users',
                        'data' => [120, 150, 180, 200, 220, 250],
                        'borderColor' => '#ffc107',
                        'backgroundColor' => 'rgba(255, 193, 7, 0.3)',
                        'tension' => 0.4,
                        'fill' => true,
                    ],
                ],
            ],
            'height' => '300px',
        ]) ?>
    </div>
</div>

<!-- Gradient Statistics -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Gradient Statistics</h5>
                <p class="text-muted mb-0">Statistics with gradient backgrounds</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <?= $this->include('components/widgets/statistic', [
                            'title' => 'Total Sales',
                            'value' => '$125,678',
                            'subtitle' => 'This year',
                            'icon' => 'ti ti-chart-line',
                            'trend' => 'up',
                            'trendValue' => '+15.3%',
                            'color' => 'primary',
                            'class' => 'bg-primary',
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->include('components/widgets/statistic', [
                            'title' => 'New Customers',
                            'value' => '1,234',
                            'subtitle' => 'This month',
                            'icon' => 'ti ti-user-plus',
                            'trend' => 'up',
                            'trendValue' => '+22.1%',
                            'color' => 'success',
                            'class' => 'bg-success',
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->include('components/widgets/statistic', [
                            'title' => 'Support Tickets',
                            'value' => '89',
                            'subtitle' => 'Pending',
                            'icon' => 'ti ti-ticket',
                            'trend' => 'down',
                            'trendValue' => '-5.2%',
                            'color' => 'warning',
                            'class' => 'bg-warning',
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->include('components/widgets/statistic', [
                            'title' => 'Server Uptime',
                            'value' => '99.9%',
                            'subtitle' => 'Last 30 days',
                            'icon' => 'ti ti-server',
                            'trend' => 'neutral',
                            'trendValue' => '0.0%',
                            'color' => 'info',
                            'class' => 'bg-info',
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
