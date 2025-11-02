<?php
/**
 * Chart Widget Component.
 *
 * Displays charts using Chart.js with customizable options
 *
 * @param string $title Chart title
 * @param string $type Chart type (line, bar, doughnut, pie, area)
 * @param array $data Chart data
 * @param array $options Chart options
 * @param string $height Chart height
 * @param string $class Additional CSS classes
 * @param string $chartId Unique chart ID
 */

// Default values
$title = $title ?? 'Chart Title';
$type = $type ?? 'line';
$data = $data ?? [];
$options = $options ?? [];
$height = $height ?? '300px';
$class = $class ?? '';
$chartId = $chartId ?? 'chart_' . uniqid();

// Default data structure
if (empty($data)) {
    $data = [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        'datasets' => [
            [
                'label' => 'Dataset 1',
                'data' => [12, 19, 3, 5, 2, 3],
                'borderColor' => '#0d6efd',
                'backgroundColor' => 'rgba(13, 110, 253, 0.1)',
                'tension' => 0.4,
            ],
        ],
    ];
}

// Default options
$defaultOptions = [
    'responsive' => true,
    'maintainAspectRatio' => false,
    'plugins' => [
        'legend' => [
            'display' => true,
            'position' => 'top',
        ],
        'tooltip' => [
            'enabled' => true,
        ],
    ],
    'scales' => [
        'y' => [
            'beginAtZero' => true,
        ],
    ],
];

// Merge with provided options
$chartOptions = array_merge_recursive($defaultOptions, $options);

// Chart type specific options
switch ($type) {
    case 'doughnut':
    case 'pie':
        $chartOptions['scales'] = [];
        $chartOptions['plugins']['legend']['position'] = 'right';
        break;
    case 'bar':
        $chartOptions['scales']['x'] = [
            'beginAtZero' => true,
        ];
        break;
    case 'area':
        if (isset($data['datasets'][0])) {
            $data['datasets'][0]['fill'] = true;
        }
        break;
}
?>

<div class="chart-widget <?= esc($class) ?>">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0"><?= esc($title) ?></h5>
                <div class="chart-actions">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                type="button" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#" onclick="exportChart('<?= esc($chartId) ?>', 'png')">
                                <i class="ti ti-download me-2"></i>Export PNG
                            </a></li>
                            <li><a class="dropdown-item" href="#" onclick="exportChart('<?= esc($chartId) ?>', 'jpg')">
                                <i class="ti ti-download me-2"></i>Export JPG
                            </a></li>
                            <li><a class="dropdown-item" href="#" onclick="exportChart('<?= esc($chartId) ?>', 'pdf')">
                                <i class="ti ti-file-pdf me-2"></i>Export PDF
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-container" style="height: <?= esc($height) ?>; position: relative;">
                <canvas id="<?= esc($chartId) ?>"></canvas>
            </div>
        </div>
    </div>
</div>

<style>
.chart-widget .card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    transition: all 0.3s ease;
}

.chart-widget .card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.chart-widget .card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 1rem 1.25rem;
}

.chart-widget .card-body {
    padding: 1.25rem;
}

.chart-container {
    position: relative;
    width: 100%;
}

.chart-actions .btn {
    padding: 0.25rem 0.5rem;
    border: none;
    background: none;
    color: #6c757d;
}

.chart-actions .btn:hover {
    color: #495057;
    background-color: #e9ecef;
}

/* Dark theme support */
[data-pc-theme="dark"] .chart-widget .card {
    background-color: #1a1a1a;
    border: 1px solid #404040;
}

[data-pc-theme="dark"] .chart-widget .card-header {
    background-color: #2d2d2d;
    border-bottom-color: #404040;
}

[data-pc-theme="dark"] .chart-widget .card-title {
    color: #e9ecef;
}

[data-pc-theme="dark"] .chart-actions .btn {
    color: #adb5bd;
}

[data-pc-theme="dark"] .chart-actions .btn:hover {
    color: #e9ecef;
    background-color: #404040;
}

/* Responsive */
@media (max-width: 768px) {
    .chart-widget .card-header {
        padding: 0.75rem 1rem;
    }
    
    .chart-widget .card-body {
        padding: 1rem;
    }
    
    .chart-container {
        height: 250px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load Chart.js if not already loaded
    if (typeof Chart === 'undefined') {
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js';
        script.onload = function() {
            initializeChart();
        };
        document.head.appendChild(script);
    } else {
        initializeChart();
    }
    
    function initializeChart() {
        const ctx = document.getElementById('<?= esc($chartId) ?>');
        if (!ctx) return;
        
        const chart = new Chart(ctx, {
            type: '<?= esc($type) ?>',
            data: <?= json_encode($data) ?>,
            options: <?= json_encode($chartOptions) ?>
        });
        
        // Store chart instance for export functionality
        window.chartInstances = window.chartInstances || {};
        window.chartInstances['<?= esc($chartId) ?>'] = chart;
    }
});

// Export chart function
function exportChart(chartId, format) {
    const chart = window.chartInstances?.[chartId];
    if (!chart) {
        console.error('Chart not found:', chartId);
        return;
    }
    
    const url = chart.toBase64Image('image/' + format, 1.0);
    const link = document.createElement('a');
    link.download = 'chart-' + chartId + '.' + format;
    link.href = url;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>
