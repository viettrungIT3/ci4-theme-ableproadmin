<?php

/**
 * Component Library Index.
 *
 * This file provides a centralized way to include components
 * and manage the component library
 */

// Component paths
$componentPaths = [
    'buttons' => [
        'button' => 'components/buttons/button.php',
    ],
    'cards' => [
        'card' => 'components/cards/card.php',
    ],
    'alerts' => [
        'alert' => 'components/alerts/alert.php',
    ],
    'forms' => [
        'input' => 'components/forms/input.php',
        'select' => 'components/forms/select.php',
        'textarea' => 'components/forms/textarea.php',
        'checkbox' => 'components/forms/checkbox.php',
        'radio' => 'components/forms/radio.php',
        'file-upload' => 'components/forms/file-upload.php',
    ],
    'modals' => [
        'modal' => 'components/modals/modal.php',
    ],
    'navigation' => [
        'breadcrumb' => 'components/navigation/breadcrumb.php',
        'mobile-menu' => 'components/navigation/mobile-menu.php',
    ],
    'ui' => [
        'progress-bar' => 'components/ui/progress-bar.php',
        'loading-spinner' => 'components/ui/loading-spinner.php',
        'tooltip' => 'components/ui/tooltip.php',
        'tabs' => 'components/ui/tabs.php',
        'accordion' => 'components/ui/accordion.php',
        'carousel' => 'components/ui/carousel.php',
        'image-gallery' => 'components/ui/image-gallery.php',
    ],
];

/**
 * Include a component.
 *
 * @param string $category Component category
 * @param string $component Component name
 * @param array $data Component data
 * @return string Component HTML
 */
function includeComponent($category, $component, $data = [])
{
    global $componentPaths;

    if (!isset($componentPaths[$category][$component])) {
        throw new Exception("Component {$category}/{$component} not found");
    }

    $componentPath = $componentPaths[$category][$component];

    // Extract data to variables
    extract($data);

    // Start output buffering
    ob_start();

    // Include the component
    include $componentPath;

    // Get the output
    $output = ob_get_clean();

    return $output;
}

/**
 * Render a component.
 *
 * @param string $category Component category
 * @param string $component Component name
 * @param array $data Component data
 */
function renderComponent($category, $component, $data = [])
{
    echo includeComponent($category, $component, $data);
}

/**
 * Get component path.
 *
 * @param string $category Component category
 * @param string $component Component name
 * @return string Component path
 */
function getComponentPath($category, $component)
{
    global $componentPaths;

    if (!isset($componentPaths[$category][$component])) {
        throw new Exception("Component {$category}/{$component} not found");
    }

    return $componentPaths[$category][$component];
}

/**
 * List all available components.
 *
 * @return array Available components
 */
function getAvailableComponents()
{
    global $componentPaths;

    return $componentPaths;
}
