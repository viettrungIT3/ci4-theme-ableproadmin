<?php

namespace App\Helpers;

/**
 * Navigation Helper Class.
 *
 * Provides methods for managing navigation menus, breadcrumbs, and active states
 */
class NavigationHelper
{
    /**
     * Get default navigation menu items.
     *
     * @return array
     */
    public static function getDefaultMenuItems(): array
    {
        return [
            [
                'id' => 'dashboard',
                'title' => 'Dashboard',
                'icon' => 'custom-status-up',
                'url' => base_url('dashboard'),
                'badge' => '2',
                'submenu' => [
                    [
                        'id' => 'dashboard-default',
                        'title' => 'Default',
                        'url' => base_url('dashboard'),
                    ],
                    [
                        'id' => 'dashboard-analytics',
                        'title' => 'Analytics',
                        'url' => base_url('dashboard/analytics'),
                    ],
                    [
                        'id' => 'dashboard-finance',
                        'title' => 'Finance',
                        'url' => base_url('dashboard/finance'),
                    ],
                ],
            ],
            [
                'caption' => 'Navigation',
            ],
            [
                'id' => 'layouts',
                'title' => 'Layouts',
                'icon' => 'custom-document',
                'submenu' => [
                    [
                        'id' => 'layout-vertical',
                        'title' => 'Vertical',
                        'url' => base_url('demo/layout-vertical'),
                    ],
                    [
                        'id' => 'layout-horizontal',
                        'title' => 'Horizontal',
                        'url' => base_url('demo/layout-horizontal'),
                    ],
                    [
                        'id' => 'layout-compact',
                        'title' => 'Compact',
                        'url' => base_url('demo/layout-compact'),
                    ],
                    [
                        'id' => 'layout-tab',
                        'title' => 'Tab',
                        'url' => base_url('demo/layout-tab'),
                    ],
                ],
            ],
            [
                'caption' => 'Widget',
            ],
            [
                'id' => 'statistics',
                'title' => 'Statistics',
                'icon' => 'custom-story',
                'url' => base_url('widget/statistics'),
            ],
            [
                'id' => 'data',
                'title' => 'Data',
                'icon' => 'custom-fatrows',
                'url' => base_url('widget/data'),
            ],
            [
                'id' => 'chart',
                'title' => 'Chart',
                'icon' => 'custom-presentation-chart',
                'url' => base_url('widget/chart'),
            ],
            [
                'caption' => 'Admin Panel',
            ],
            [
                'id' => 'courses',
                'title' => 'Online Courses',
                'icon' => 'custom-layer',
                'submenu' => [
                    [
                        'id' => 'course-dashboard',
                        'title' => 'Dashboard',
                        'url' => base_url('admin/courses/dashboard'),
                    ],
                    [
                        'id' => 'teachers',
                        'title' => 'Teacher',
                        'submenu' => [
                            [
                                'id' => 'teacher-list',
                                'title' => 'List',
                                'url' => base_url('admin/courses/teachers'),
                            ],
                            [
                                'id' => 'teacher-apply',
                                'title' => 'Apply',
                                'url' => base_url('admin/courses/teachers/apply'),
                            ],
                            [
                                'id' => 'teacher-add',
                                'title' => 'Add',
                                'url' => base_url('admin/courses/teachers/add'),
                            ],
                        ],
                    ],
                    [
                        'id' => 'students',
                        'title' => 'Student',
                        'submenu' => [
                            [
                                'id' => 'student-list',
                                'title' => 'List',
                                'url' => base_url('admin/courses/students'),
                            ],
                            [
                                'id' => 'student-apply',
                                'title' => 'Apply',
                                'url' => base_url('admin/courses/students/apply'),
                            ],
                            [
                                'id' => 'student-add',
                                'title' => 'Add',
                                'url' => base_url('admin/courses/students/add'),
                            ],
                        ],
                    ],
                ],
            ],
            [
                'id' => 'membership',
                'title' => 'Membership',
                'icon' => 'custom-user',
                'submenu' => [
                    [
                        'id' => 'membership-dashboard',
                        'title' => 'Dashboard',
                        'url' => base_url('admin/membership/dashboard'),
                    ],
                    [
                        'id' => 'membership-list',
                        'title' => 'List',
                        'url' => base_url('admin/membership'),
                    ],
                    [
                        'id' => 'membership-pricing',
                        'title' => 'Pricing',
                        'url' => base_url('admin/membership/pricing'),
                    ],
                    [
                        'id' => 'membership-setting',
                        'title' => 'Setting',
                        'url' => base_url('admin/membership/settings'),
                    ],
                ],
            ],
            [
                'caption' => 'UI Components',
            ],
            [
                'id' => 'components',
                'title' => 'Components',
                'icon' => 'custom-box-1',
                'url' => base_url('elements/components'),
                'target' => '_blank',
            ],
            [
                'id' => 'animation',
                'title' => 'Animation',
                'icon' => 'custom-flag',
                'url' => base_url('elements/animation'),
            ],
            [
                'id' => 'icons',
                'title' => 'Icons',
                'icon' => 'custom-mouse-circle',
                'submenu' => [
                    [
                        'id' => 'icon-feather',
                        'title' => 'Feather',
                        'url' => base_url('elements/icons/feather'),
                    ],
                    [
                        'id' => 'icon-fontawesome',
                        'title' => 'Font Awesome 5',
                        'url' => base_url('elements/icons/fontawesome'),
                    ],
                    [
                        'id' => 'icon-material',
                        'title' => 'Material',
                        'url' => base_url('elements/icons/material'),
                    ],
                    [
                        'id' => 'icon-tabler',
                        'title' => 'Tabler',
                        'url' => base_url('elements/icons/tabler'),
                    ],
                    [
                        'id' => 'icon-phosphor',
                        'title' => 'Phosphor',
                        'url' => base_url('elements/icons/phosphor'),
                    ],
                    [
                        'id' => 'icon-custom',
                        'title' => 'Custom',
                        'url' => base_url('elements/icons/custom'),
                    ],
                ],
            ],
        ];
    }

    /**
     * Get breadcrumb items based on current route.
     *
     * @param string $currentRoute Current route
     * @param array  $customItems Custom breadcrumb items
     *
     * @return array
     */
    public static function getBreadcrumbItems(string $currentRoute = '', array $customItems = []): array
    {
        if (!empty($customItems)) {
            return $customItems;
        }

        $breadcrumbs = [
            [
                'text' => 'Home',
                'url' => base_url(),
                'icon' => 'ti ti-home',
            ],
        ];

        // Map routes to breadcrumb items
        $routeMap = [
            'dashboard' => [
                'text' => 'Dashboard',
                'url' => base_url('dashboard'),
                'icon' => 'ti ti-dashboard',
            ],
            'dashboard/analytics' => [
                'text' => 'Analytics',
                'url' => base_url('dashboard/analytics'),
                'icon' => 'ti ti-chart-line',
            ],
            'dashboard/finance' => [
                'text' => 'Finance',
                'url' => base_url('dashboard/finance'),
                'icon' => 'ti ti-currency-dollar',
            ],
            'admin/users' => [
                'text' => 'Users',
                'url' => base_url('admin/users'),
                'icon' => 'ti ti-users',
            ],
            'admin/users/create' => [
                'text' => 'Create User',
                'url' => base_url('admin/users/create'),
                'icon' => 'ti ti-user-plus',
            ],
            'admin/users/edit' => [
                'text' => 'Edit User',
                'url' => base_url('admin/users/edit'),
                'icon' => 'ti ti-user-edit',
            ],
            'admin/settings' => [
                'text' => 'Settings',
                'url' => base_url('admin/settings'),
                'icon' => 'ti ti-settings',
            ],
            'profile' => [
                'text' => 'Profile',
                'url' => base_url('profile'),
                'icon' => 'ti ti-user',
            ],
        ];

        // Add breadcrumb items based on current route
        if (!empty($currentRoute) && isset($routeMap[$currentRoute])) {
            $breadcrumbs[] = $routeMap[$currentRoute];
        }

        // Mark last item as active
        if (!empty($breadcrumbs)) {
            $lastIndex = count($breadcrumbs) - 1;
            $breadcrumbs[$lastIndex]['active'] = true;
        }

        return $breadcrumbs;
    }

    /**
     * Check if a menu item is active.
     *
     * @param string $itemId      Menu item ID
     * @param string $currentRoute Current route
     *
     * @return bool
     */
    public static function isMenuItemActive(string $itemId, string $currentRoute = ''): bool
    {
        if (empty($currentRoute)) {
            return false;
        }

        // Direct match
        if ($itemId === $currentRoute) {
            return true;
        }

        // Check if current route starts with item ID
        if (strpos($currentRoute, $itemId) === 0) {
            return true;
        }

        return false;
    }

    /**
     * Get active menu item from current route.
     *
     * @param string $currentRoute Current route
     * @param array  $menuItems   Menu items to search
     *
     * @return string
     */
    public static function getActiveMenuItem(string $currentRoute = '', array $menuItems = []): string
    {
        if (empty($currentRoute) || empty($menuItems)) {
            return '';
        }

        foreach ($menuItems as $menu) {
            if (isset($menu['id']) && self::isMenuItemActive($menu['id'], $currentRoute)) {
                return $menu['id'];
            }

            // Check submenu items
            if (!empty($menu['submenu'])) {
                foreach ($menu['submenu'] as $submenu) {
                    if (isset($submenu['id']) && self::isMenuItemActive($submenu['id'], $currentRoute)) {
                        return $submenu['id'];
                    }

                    // Check sub-submenu items
                    if (!empty($submenu['submenu'])) {
                        foreach ($submenu['submenu'] as $subsubmenu) {
                            if (isset($subsubmenu['id']) && self::isMenuItemActive($subsubmenu['id'], $currentRoute)) {
                                return $subsubmenu['id'];
                            }
                        }
                    }
                }
            }
        }

        return '';
    }

    /**
     * Filter menu items based on user permissions.
     *
     * @param array $menuItems Menu items
     * @param array $userPermissions User permissions
     *
     * @return array
     */
    public static function filterMenuByPermissions(array $menuItems, array $userPermissions = []): array
    {
        if (empty($userPermissions)) {
            return $menuItems;
        }

        $filtered = [];

        foreach ($menuItems as $menu) {
            // Skip if menu requires permission and user doesn't have it
            if (isset($menu['permission']) && !in_array($menu['permission'], $userPermissions, true)) {
                continue;
            }

            // Filter submenu items
            if (!empty($menu['submenu'])) {
                $menu['submenu'] = self::filterMenuByPermissions($menu['submenu'], $userPermissions);
            }

            $filtered[] = $menu;
        }

        return $filtered;
    }

    /**
     * Generate menu HTML attributes.
     *
     * @param array $item Menu item
     *
     * @return string
     */
    public static function getMenuAttributes(array $item): string
    {
        $attributes = [];

        if (isset($item['target'])) {
            $attributes[] = 'target="' . esc($item['target']) . '"';
        }

        if (isset($item['rel'])) {
            $attributes[] = 'rel="' . esc($item['rel']) . '"';
        }

        if (isset($item['data-bs-toggle'])) {
            $attributes[] = 'data-bs-toggle="' . esc($item['data-bs-toggle']) . '"';
        }

        if (isset($item['data-bs-target'])) {
            $attributes[] = 'data-bs-target="' . esc($item['data-bs-target']) . '"';
        }

        return implode(' ', $attributes);
    }
}
