<?php
/**
 * Statistic Widget Component.
 *
 * Displays statistical data with icons, values, and trends
 *
 * @param string $title Widget title
 * @param string $value Main value to display
 * @param string $subtitle Subtitle or description
 * @param string $icon Icon class or SVG
 * @param string $trend Trend direction (up, down, neutral)
 * @param string $trendValue Trend percentage or value
 * @param string $color Color theme (primary, success, warning, danger, info)
 * @param string $class Additional CSS classes
 * @param bool $animated Whether to show animated counter
 */

// Default values
$title = $title ?? 'Total Revenue';
$value = $value ?? '$12,345';
$subtitle = $subtitle ?? 'Last 30 days';
$icon = $icon ?? 'ti ti-currency-dollar';
$trend = $trend ?? 'up';
$trendValue = $trendValue ?? '+12.5%';
$color = $color ?? 'primary';
$class = $class ?? '';
$animated = $animated ?? true;

// Color mapping
$colorClasses = [
    'primary' => 'bg-light-primary text-primary',
    'success' => 'bg-light-success text-success',
    'warning' => 'bg-light-warning text-warning',
    'danger' => 'bg-light-danger text-danger',
    'info' => 'bg-light-info text-info',
    'secondary' => 'bg-light-secondary text-secondary',
];

$trendIcons = [
    'up' => 'ti ti-arrow-up-right',
    'down' => 'ti ti-arrow-down-right',
    'neutral' => 'ti ti-minus',
];

$trendColors = [
    'up' => 'text-success',
    'down' => 'text-danger',
    'neutral' => 'text-muted',
];

$colorClass = $colorClasses[$color] ?? $colorClasses['primary'];
$trendIcon = $trendIcons[$trend] ?? $trendIcons['up'];
$trendColor = $trendColors[$trend] ?? $trendColors['up'];
?>

<div class="statistic-widget <?= esc($class) ?>">
    <div class="card h-100">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="statistic-icon <?= esc($colorClass) ?>">
                        <?php if (strpos($icon, 'ti ') === 0): ?>
                            <i class="<?= esc($icon) ?>"></i>
                        <?php else: ?>
                            <svg class="pc-icon">
                                <use xlink:href="#<?= esc($icon) ?>"></use>
                            </svg>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <div class="statistic-content">
                        <h6 class="statistic-title mb-1"><?= esc($title) ?></h6>
                        <div class="statistic-value">
                            <?php if ($animated): ?>
                                <span class="counter" data-target="<?= esc(str_replace(['$', ',', '%'], '', $value)) ?>">
                                    <?= esc($value) ?>
                                </span>
                            <?php else: ?>
                                <?= esc($value) ?>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($subtitle)): ?>
                            <small class="statistic-subtitle text-muted"><?= esc($subtitle) ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (!empty($trendValue)): ?>
                    <div class="flex-shrink-0 ms-3">
                        <div class="statistic-trend <?= esc($trendColor) ?>">
                            <i class="<?= esc($trendIcon) ?>"></i>
                            <span><?= esc($trendValue) ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    .statistic-widget .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: all 0.3s ease;
    }

    .statistic-widget .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .statistic-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .statistic-title {
        font-size: 0.875rem;
        font-weight: 500;
        color: #6c757d;
        margin-bottom: 0.5rem;
    }

    .statistic-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: #495057;
        line-height: 1.2;
        margin-bottom: 0.25rem;
    }

    .statistic-subtitle {
        font-size: 0.75rem;
        color: #6c757d;
    }

    .statistic-trend {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .statistic-trend i {
        font-size: 0.75rem;
    }

    /* Color variants */
    .statistic-widget.bg-primary .card {
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        color: white;
    }

    .statistic-widget.bg-primary .statistic-title,
    .statistic-widget.bg-primary .statistic-subtitle {
        color: rgba(255, 255, 255, 0.8);
    }

    .statistic-widget.bg-primary .statistic-value {
        color: white;
    }

    .statistic-widget.bg-success .card {
        background: linear-gradient(135deg, #198754 0%, #20c997 100%);
        color: white;
    }

    .statistic-widget.bg-success .statistic-title,
    .statistic-widget.bg-success .statistic-subtitle {
        color: rgba(255, 255, 255, 0.8);
    }

    .statistic-widget.bg-success .statistic-value {
        color: white;
    }

    .statistic-widget.bg-warning .card {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        color: white;
    }

    .statistic-widget.bg-warning .statistic-title,
    .statistic-widget.bg-warning .statistic-subtitle {
        color: rgba(255, 255, 255, 0.8);
    }

    .statistic-widget.bg-warning .statistic-value {
        color: white;
    }

    .statistic-widget.bg-danger .card {
        background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
        color: white;
    }

    .statistic-widget.bg-danger .statistic-title,
    .statistic-widget.bg-danger .statistic-subtitle {
        color: rgba(255, 255, 255, 0.8);
    }

    .statistic-widget.bg-danger .statistic-value {
        color: white;
    }

    /* Dark theme support */
    [data-pc-theme="dark"] .statistic-widget .card {
        background-color: #1a1a1a;
        border: 1px solid #404040;
    }

    [data-pc-theme="dark"] .statistic-widget .statistic-title {
        color: #adb5bd;
    }

    [data-pc-theme="dark"] .statistic-widget .statistic-value {
        color: #e9ecef;
    }

    [data-pc-theme="dark"] .statistic-widget .statistic-subtitle {
        color: #6c757d;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .statistic-widget .card-body {
            padding: 1rem;
        }

        .statistic-icon {
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
        }

        .statistic-value {
            font-size: 1.5rem;
        }

        .statistic-trend {
            font-size: 0.75rem;
        }
    }

    /* Animation */
    @keyframes counterUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .statistic-widget .counter {
        animation: counterUp 0.6s ease-out;
    }
</style>

<?php if ($animated): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const counters = document.querySelectorAll('.statistic-widget .counter');

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000; // 2 seconds
                const increment = target / (duration / 16); // 60fps
                let current = 0;

                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.floor(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString();
                    }
                };

                // Start animation when element is visible
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            updateCounter();
                            observer.unobserve(entry.target);
                        }
                    });
                });

                observer.observe(counter);
            });
        });
    </script>
<?php endif; ?>