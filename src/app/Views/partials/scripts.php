<!-- Required Js -->
<script src="<?= $themePath ?>/assets/js/plugins/popper.min.js"></script>
<script src="<?= $themePath ?>/assets/js/plugins/simplebar.min.js"></script>
<script src="<?= $themePath ?>/assets/js/plugins/bootstrap.min.js"></script>
<script src="<?= $themePath ?>/assets/js/fonts/custom-font.js"></script>
<script src="<?= $themePath ?>/assets/js/pcoded.js"></script>
<script src="<?= $themePath ?>/assets/js/plugins/feather.min.js"></script>

<!-- Toast Notification System -->
<link rel="stylesheet" href="<?= base_url('assets/css/toast.css') ?>">
<script src="<?= base_url('assets/js/toast-simple.js') ?>"></script>

<!-- Password Strength Validation -->
<link rel="stylesheet" href="<?= base_url('assets/css/password-strength.css') ?>">
<script src="<?= base_url('assets/js/password-strength.js') ?>"></script>

<!-- Username Validation -->
<link rel="stylesheet" href="<?= base_url('assets/css/username-validation.css') ?>">
<script src="<?= base_url('assets/js/username-validation.js') ?>"></script>

<!-- Error Handler -->
<script src="<?= base_url('assets/js/error-handler.js') ?>"></script>

<!-- Form Validator -->
<script src="<?= base_url('assets/js/form-validator.js') ?>"></script>

<!-- Loading States -->
<link rel="stylesheet" href="<?= base_url('assets/css/loading-states.css') ?>">
<script src="<?= base_url('assets/js/loading-states.js') ?>"></script>

<!-- Disable Bootstrap auto-initialization -->
<script>
    // Disable Bootstrap auto-initialization to prevent errors
    document.addEventListener('DOMContentLoaded', function () {
        // Override Bootstrap's auto-initialization
        if (typeof bootstrap !== 'undefined') {
            // Disable auto-initialization for problematic components
            const originalGetOrCreateInstance = bootstrap.Dropdown.getOrCreateInstance;
            bootstrap.Dropdown.getOrCreateInstance = function (element, config) {
                try {
                    return originalGetOrCreateInstance.call(this, element, config);
                } catch (e) {
                    console.warn('Bootstrap Dropdown initialization failed:', e);
                    return null;
                }
            };
        }
    });
</script>

<!-- Theme Configuration -->
<script>
    // Theme Settings Manager
    class ThemeManager {
        constructor() {
            this.storageKey = 'ablepro_theme_settings';
            this.defaultSettings = {
                mode: 'light',
                layout: 'vertical',
                sidebar_caption: true,
                direction: 'ltr',
                container: 'full',
                color_preset: 'preset-1',
                contrast: false
            };
            this.init();
        }

        init() {
            // Load settings from localStorage or use defaults
            const settings = this.loadSettings();

            // Apply settings
            this.applySettings(settings);

            // Update UI to show current state
            this.updateUI(settings);

            // Bind event listeners
            this.bindEvents();
        }

        loadSettings() {
            try {
                const stored = localStorage.getItem(this.storageKey);
                if (stored) {
                    return { ...this.defaultSettings, ...JSON.parse(stored) };
                }
            } catch (e) {
                console.warn('Failed to load theme settings from localStorage:', e);
            }
            return this.defaultSettings;
        }

        saveSettings(settings) {
            try {
                localStorage.setItem(this.storageKey, JSON.stringify(settings));
            } catch (e) {
                console.warn('Failed to save theme settings to localStorage:', e);
            }
        }

        updateSetting(key, value) {
            const settings = this.loadSettings();
            settings[key] = value;
            this.saveSettings(settings);
            this.applySetting(key, value);
        }

        applySettings(settings) {
            // Update body attributes
            document.body.setAttribute('data-pc-theme', settings.mode);
            document.body.setAttribute('data-pc-layout', settings.layout);
            document.body.setAttribute('data-pc-sidebar-caption', settings.sidebar_caption ? 'true' : 'false');
            document.body.setAttribute('data-pc-direction', settings.direction);
            document.body.setAttribute('data-pc-preset', settings.color_preset);
            document.body.setAttribute('data-pc-theme_contrast', settings.contrast ? 'true' : 'false');

            // Apply settings with delay to ensure DOM is ready
            setTimeout(() => {
                try {
                    // Apply theme mode - with additional element checks
                    if (typeof layout_change === 'function') {
                        try {
                            // Check if required elements exist before calling layout_change
                            const requiredElements = [
                                '.theme-layout .btn',
                                '.pc-sidebar .m-header .logo-lg',
                                '.navbar-brand .logo-lg'
                            ];

                            let elementsReady = true;
                            for (const selector of requiredElements) {
                                if (!document.querySelector(selector)) {
                                    elementsReady = false;
                                    break;
                                }
                            }

                            if (elementsReady) {
                                layout_change(settings.mode);
                            } else {
                                console.warn('Required elements not ready for layout_change, retrying in 200ms...');
                                // Retry after 200ms
                                setTimeout(() => {
                                    try {
                                        layout_change(settings.mode);
                                    } catch (e) {
                                        console.warn('layout_change retry failed:', e);
                                    }
                                }, 200);
                            }
                        } catch (e) {
                            console.warn('layout_change failed:', e);
                        }
                    }

                    // Apply layout
                    if (typeof main_layout_change === 'function') {
                        try {
                            main_layout_change(settings.layout);
                        } catch (e) {
                            console.warn('main_layout_change failed:', e);
                        }
                    }

                    // Apply sidebar caption
                    if (typeof layout_caption_change === 'function') {
                        try {
                            layout_caption_change(settings.sidebar_caption ? 'true' : 'false');
                        } catch (e) {
                            console.warn('layout_caption_change failed:', e);
                        }
                    }

                    // Apply direction
                    if (typeof layout_rtl_change === 'function') {
                        try {
                            layout_rtl_change(settings.direction === 'rtl' ? 'true' : 'false');
                        } catch (e) {
                            console.warn('layout_rtl_change failed:', e);
                        }
                    }

                    // Apply container
                    if (typeof change_box_container === 'function') {
                        try {
                            change_box_container(settings.container === 'container' ? 'true' : 'false');
                        } catch (e) {
                            console.warn('change_box_container failed:', e);
                        }
                    }

                    // Apply preset
                    if (typeof preset_change === 'function') {
                        try {
                            preset_change(settings.color_preset);
                        } catch (e) {
                            console.warn('preset_change failed:', e);
                        }
                    }

                    // Apply contrast
                    if (typeof layout_theme_contrast_change === 'function') {
                        try {
                            layout_theme_contrast_change(settings.contrast ? 'true' : 'false');
                        } catch (e) {
                            console.warn('layout_theme_contrast_change failed:', e);
                        }
                    }
                } catch (error) {
                    console.warn('Theme functions not ready yet:', error);
                }
            }, 500);
        }

        applySetting(key, value) {
            // Update body attribute
            switch (key) {
                case 'mode':
                    document.body.setAttribute('data-pc-theme', value);
                    if (typeof layout_change === 'function') {
                        try {
                            layout_change(value);
                        } catch (e) {
                            console.warn('layout_change failed:', e);
                        }
                    }
                    break;
                case 'layout':
                    document.body.setAttribute('data-pc-layout', value);
                    if (typeof main_layout_change === 'function') {
                        try {
                            main_layout_change(value);
                        } catch (e) {
                            console.warn('main_layout_change failed:', e);
                        }
                    }
                    break;
                case 'sidebar_caption':
                    document.body.setAttribute('data-pc-sidebar-caption', value ? 'true' : 'false');
                    if (typeof layout_caption_change === 'function') {
                        try {
                            layout_caption_change(value ? 'true' : 'false');
                        } catch (e) {
                            console.warn('layout_caption_change failed:', e);
                        }
                    }
                    break;
                case 'direction':
                    document.body.setAttribute('data-pc-direction', value);
                    if (typeof layout_rtl_change === 'function') {
                        try {
                            layout_rtl_change(value === 'rtl' ? 'true' : 'false');
                        } catch (e) {
                            console.warn('layout_rtl_change failed:', e);
                        }
                    }
                    break;
                case 'container':
                    document.body.setAttribute('data-pc-container', value === 'container' ? 'true' : 'false');
                    if (typeof change_box_container === 'function') {
                        try {
                            change_box_container(value === 'container' ? 'true' : 'false');
                        } catch (e) {
                            console.warn('change_box_container failed:', e);
                        }
                    }
                    break;
                case 'color_preset':
                    document.body.setAttribute('data-pc-preset', value);
                    if (typeof preset_change === 'function') {
                        try {
                            preset_change(value);
                        } catch (e) {
                            console.warn('preset_change failed:', e);
                        }
                    }
                    break;
                case 'contrast':
                    document.body.setAttribute('data-pc-theme_contrast', value ? 'true' : 'false');
                    if (typeof layout_theme_contrast_change === 'function') {
                        try {
                            layout_theme_contrast_change(value ? 'true' : 'false');
                        } catch (e) {
                            console.warn('layout_theme_contrast_change failed:', e);
                        }
                    }
                    break;
            }
        }

        bindEvents() {
            // Theme mode buttons
            document.querySelectorAll('[onclick*="layout_change"]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const mode = e.target.closest('[onclick*="layout_change"]').getAttribute('onclick').match(/layout_change\('([^']+)'\)/)?.[1];
                    if (mode) {
                        this.updateSetting('mode', mode);
                    }
                });
            });

            // Layout buttons
            document.querySelectorAll('[data-value]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const value = e.target.closest('[data-value]').getAttribute('data-value');
                    const setting = e.target.closest('[data-value]').closest('.list-group-item');

                    if (setting) {
                        if (setting.querySelector('.theme-layout')) {
                            this.updateSetting('layout', value);
                        } else if (setting.querySelector('.theme-nav-caption')) {
                            this.updateSetting('sidebar_caption', value === 'true');
                        } else if (setting.querySelector('.theme-direction')) {
                            this.updateSetting('direction', value === 'true' ? 'rtl' : 'ltr');
                        } else if (setting.querySelector('.theme-container')) {
                            this.updateSetting('container', value === 'true' ? 'container' : 'full');
                        } else if (setting.querySelector('.preset-color')) {
                            this.updateSetting('color_preset', value);
                        } else if (setting.querySelector('.theme-contrast')) {
                            this.updateSetting('contrast', value === 'true');
                        }
                    }
                });
            });

            // Reset button
            const resetBtn = document.getElementById('layoutreset');
            if (resetBtn) {
                resetBtn.addEventListener('click', () => {
                    this.resetSettings();
                });
            }
        }

        resetSettings() {
            localStorage.removeItem(this.storageKey);
            this.applySettings(this.defaultSettings);

            // Update UI to show default state
            this.updateUI(this.defaultSettings);
        }

        updateUI(settings) {
            // Update active states for theme mode
            document.querySelectorAll('.theme-layout button').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('onclick')?.includes(`layout_change('${settings.mode}')`)) {
                    btn.classList.add('active');
                }
            });

            // Update active states for layout
            document.querySelectorAll('.theme-main-layout a').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-value') === settings.layout) {
                    link.classList.add('active');
                }
            });

            // Update active states for other settings
            document.querySelectorAll('.theme-nav-caption button').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-value') === (settings.sidebar_caption ? 'true' : 'false')) {
                    btn.classList.add('active');
                }
            });

            document.querySelectorAll('.theme-direction button').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-value') === (settings.direction === 'rtl' ? 'true' : 'false')) {
                    btn.classList.add('active');
                }
            });

            document.querySelectorAll('.theme-container button').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-value') === (settings.container === 'container' ? 'true' : 'false')) {
                    btn.classList.add('active');
                }
            });

            document.querySelectorAll('.preset-color a').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-value') === settings.color_preset) {
                    link.classList.add('active');
                }
            });

            document.querySelectorAll('.theme-contrast button').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-value') === (settings.contrast ? 'true' : 'false')) {
                    btn.classList.add('active');
                }
            });
        }
    }

    // Initialize theme manager when DOM is ready and all scripts loaded
    document.addEventListener('DOMContentLoaded', function () {
        // Wait for pcoded.js to be fully loaded
        setTimeout(() => {
            window.themeManager = new ThemeManager();
        }, 200);
    });

    // Fix Bootstrap initialization errors
    document.addEventListener('DOMContentLoaded', function () {
        // Wait for all elements to be ready
        setTimeout(() => {
            try {
                // Initialize Bootstrap tooltips safely
                if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                        try {
                            new bootstrap.Tooltip(tooltipTriggerEl);
                        } catch (e) {
                            console.warn('Tooltip initialization failed:', e);
                        }
                    });
                }

                // Initialize Bootstrap popovers safely
                if (typeof bootstrap !== 'undefined' && bootstrap.Popover) {
                    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                    popoverTriggerList.forEach(function (popoverTriggerEl) {
                        try {
                            new bootstrap.Popover(popoverTriggerEl);
                        } catch (e) {
                            console.warn('Popover initialization failed:', e);
                        }
                    });
                }

                // Initialize Bootstrap dropdowns safely
                if (typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
                    const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
                    dropdownElementList.forEach(function (dropdownToggleEl) {
                        try {
                            // Check if element exists and has required attributes
                            if (dropdownToggleEl &&
                                dropdownToggleEl.getAttribute('data-bs-toggle') === 'dropdown' &&
                                dropdownToggleEl.parentNode &&
                                dropdownToggleEl.parentNode.querySelector('.dropdown-menu')) {
                                new bootstrap.Dropdown(dropdownToggleEl);
                            }
                        } catch (e) {
                            console.warn('Dropdown initialization failed:', e);
                        }
                    });
                }

                // Initialize Bootstrap modals safely
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    const modalElementList = [].slice.call(document.querySelectorAll('.modal'));
                    modalElementList.forEach(function (modalEl) {
                        try {
                            new bootstrap.Modal(modalEl);
                        } catch (e) {
                            console.warn('Modal initialization failed:', e);
                        }
                    });
                }

                // Initialize Bootstrap offcanvas safely
                if (typeof bootstrap !== 'undefined' && bootstrap.Offcanvas) {
                    const offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'));
                    offcanvasElementList.forEach(function (offcanvasEl) {
                        try {
                            new bootstrap.Offcanvas(offcanvasEl);
                        } catch (e) {
                            console.warn('Offcanvas initialization failed:', e);
                        }
                    });
                }
            } catch (error) {
                console.warn('Bootstrap initialization failed:', error);
            }
        }, 600);
    });
</script>

<?php if (isset($additionalJs) && is_array($additionalJs)): ?>
    <?php foreach ($additionalJs as $js): ?>
        <script src="<?= $js ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>