<!-- [ Settings Panel ] start -->
<div class="pct-c-btn">
    <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pc_layout">
        <i class="ph-duotone ph-gear-six"></i>
    </a>
</div>

<div class="offcanvas border-0 pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Settings</h5>
        <button type="button" class="btn btn-icon btn-link-danger ms-auto" data-bs-dismiss="offcanvas"
            aria-label="Close">
            <i class="ti ti-x"></i>
        </button>
    </div>
    <div class="pct-body customizer-body">
        <div class="offcanvas-body py-0">
            <ul class="list-group list-group-flush">
                <!-- Theme Mode -->
                <li class="list-group-item">
                    <div class="pc-dark">
                        <h6 class="mb-1">Theme Mode</h6>
                        <p class="text-muted text-sm">Choose light or dark mode or Auto</p>
                        <div class="row theme-color theme-layout">
                            <div class="col-4">
                                <div class="d-grid">
                                    <button class="preset-btn btn <?= $theme['mode'] === 'light' ? 'active' : '' ?>"
                                        data-value="true" onclick="layout_change('light');" data-bs-toggle="tooltip"
                                        title="Light">
                                        <svg class="pc-icon text-warning">
                                            <use xlink:href="#custom-sun-1"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-grid">
                                    <button class="preset-btn btn <?= $theme['mode'] === 'dark' ? 'active' : '' ?>"
                                        data-value="false" onclick="layout_change('dark');" data-bs-toggle="tooltip"
                                        title="Dark">
                                        <svg class="pc-icon">
                                            <use xlink:href="#custom-moon"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-grid">
                                    <button class="preset-btn btn <?= $theme['mode'] === 'auto' ? 'active' : '' ?>"
                                        data-value="default" onclick="layout_change_default();" data-bs-toggle="tooltip"
                                        title="Automatically sets the theme based on user's operating system's color scheme.">
                                        <span class="pc-lay-icon d-flex align-items-center justify-content-center">
                                            <i class="ph-duotone ph-cpu"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Theme Contrast -->
                <li class="list-group-item">
                    <h6 class="mb-1">Theme Contrast</h6>
                    <p class="text-muted text-sm">Choose theme contrast</p>
                    <div class="row theme-contrast">
                        <div class="col-6">
                            <div class="d-grid">
                                <button class="preset-btn btn <?= $theme['contrast'] ? 'active' : '' ?>"
                                    data-value="true" onclick="layout_theme_contrast_change('true');"
                                    data-bs-toggle="tooltip" title="True">
                                    <svg class="pc-icon">
                                        <use xlink:href="#custom-mask"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-grid">
                                <button class="preset-btn btn <?= !$theme['contrast'] ? 'active' : '' ?>"
                                    data-value="false" onclick="layout_theme_contrast_change('false');"
                                    data-bs-toggle="tooltip" title="False">
                                    <svg class="pc-icon">
                                        <use xlink:href="#custom-mask-1-outline"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Custom Theme -->
                <li class="list-group-item">
                    <h6 class="mb-1">Custom Theme</h6>
                    <p class="text-muted text-sm">Choose your primary theme color</p>
                    <div class="theme-color preset-color">
                        <a href="#!" data-bs-toggle="tooltip" title="Blue"
                            class="<?= $theme['color_preset'] === 'preset-1' ? 'active' : '' ?>" data-value="preset-1">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Indigo"
                            class="<?= $theme['color_preset'] === 'preset-2' ? 'active' : '' ?>" data-value="preset-2">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Purple"
                            class="<?= $theme['color_preset'] === 'preset-3' ? 'active' : '' ?>" data-value="preset-3">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Pink"
                            class="<?= $theme['color_preset'] === 'preset-4' ? 'active' : '' ?>" data-value="preset-4">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Red"
                            class="<?= $theme['color_preset'] === 'preset-5' ? 'active' : '' ?>" data-value="preset-5">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Orange"
                            class="<?= $theme['color_preset'] === 'preset-6' ? 'active' : '' ?>" data-value="preset-6">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Yellow"
                            class="<?= $theme['color_preset'] === 'preset-7' ? 'active' : '' ?>" data-value="preset-7">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Green"
                            class="<?= $theme['color_preset'] === 'preset-8' ? 'active' : '' ?>" data-value="preset-8">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Teal"
                            class="<?= $theme['color_preset'] === 'preset-9' ? 'active' : '' ?>" data-value="preset-9">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Cyan"
                            class="<?= $theme['color_preset'] === 'preset-10' ? 'active' : '' ?>"
                            data-value="preset-10">
                            <i class="ti ti-checks"></i>
                        </a>
                    </div>
                </li>

                <!-- Theme Layout -->
                <li class="list-group-item">
                    <h6 class="mb-1">Theme Layout</h6>
                    <p class="text-muted text-sm">Choose your layout</p>
                    <div class="theme-main-layout d-flex align-center gap-1 w-100">
                        <a href="#!" data-bs-toggle="tooltip" title="Vertical"
                            class="<?= $theme['layout'] === 'vertical' ? 'active' : '' ?>" data-value="vertical">
                            <img src="<?= $themePath ?>/assets/images/customizer/caption-on.svg" alt="img"
                                class="img-fluid">
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Horizontal"
                            class="<?= $theme['layout'] === 'horizontal' ? 'active' : '' ?>" data-value="horizontal">
                            <img src="<?= $themePath ?>/assets/images/customizer/horizontal.svg" alt="img"
                                class="img-fluid">
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Color Header"
                            class="<?= $theme['layout'] === 'color-header' ? 'active' : '' ?>"
                            data-value="color-header">
                            <img src="<?= $themePath ?>/assets/images/customizer/color-header.svg" alt="img"
                                class="img-fluid">
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Compact"
                            class="<?= $theme['layout'] === 'compact' ? 'active' : '' ?>" data-value="compact">
                            <img src="<?= $themePath ?>/assets/images/customizer/compact.svg" alt="img"
                                class="img-fluid">
                        </a>
                        <a href="#!" data-bs-toggle="tooltip" title="Tab"
                            class="<?= $theme['layout'] === 'tab' ? 'active' : '' ?>" data-value="tab">
                            <img src="<?= $themePath ?>/assets/images/customizer/tab.svg" alt="img" class="img-fluid">
                        </a>
                    </div>
                </li>

                <!-- Sidebar Caption -->
                <li class="list-group-item">
                    <h6 class="mb-1">Sidebar Caption</h6>
                    <p class="text-muted text-sm">Sidebar Caption Hide/Show</p>
                    <div class="row theme-color theme-nav-caption">
                        <div class="col-6">
                            <div class="d-grid">
                                <button class="preset-btn btn-img btn <?= $theme['sidebar_caption'] ? 'active' : '' ?>"
                                    data-value="true" onclick="layout_caption_change('true');" data-bs-toggle="tooltip"
                                    title="Caption Show">
                                    <img src="<?= $themePath ?>/assets/images/customizer/caption-on.svg" alt="img"
                                        class="img-fluid">
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-grid">
                                <button class="preset-btn btn-img btn <?= !$theme['sidebar_caption'] ? 'active' : '' ?>"
                                    data-value="false" onclick="layout_caption_change('false');"
                                    data-bs-toggle="tooltip" title="Caption Hide">
                                    <img src="<?= $themePath ?>/assets/images/customizer/caption-off.svg" alt="img"
                                        class="img-fluid">
                                </button>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Theme Layout (LTR/RTL) -->
                <li class="list-group-item">
                    <div class="pc-rtl">
                        <h6 class="mb-1">Theme Layout</h6>
                        <p class="text-muted text-sm">LTR/RTL</p>
                        <div class="row theme-color theme-direction">
                            <div class="col-6">
                                <div class="d-grid">
                                    <button
                                        class="preset-btn btn-img btn <?= $theme['direction'] === 'ltr' ? 'active' : '' ?>"
                                        data-value="false" onclick="layout_rtl_change('false');"
                                        data-bs-toggle="tooltip" title="LTR">
                                        <img src="<?= $themePath ?>/assets/images/customizer/ltr.svg" alt="img"
                                            class="img-fluid">
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-grid">
                                    <button
                                        class="preset-btn btn-img btn <?= $theme['direction'] === 'rtl' ? 'active' : '' ?>"
                                        data-value="true" onclick="layout_rtl_change('true');" data-bs-toggle="tooltip"
                                        title="RTL">
                                        <img src="<?= $themePath ?>/assets/images/customizer/rtl.svg" alt="img"
                                            class="img-fluid">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Layout Width -->
                <li class="list-group-item pc-box-width">
                    <div class="pc-container-width">
                        <h6 class="mb-1">Layout Width</h6>
                        <p class="text-muted text-sm">Choose Full or Container Layout</p>
                        <div class="row theme-color theme-container">
                            <div class="col-6">
                                <div class="d-grid">
                                    <button
                                        class="preset-btn btn-img btn <?= $theme['container'] === 'full' ? 'active' : '' ?>"
                                        data-value="false" onclick="change_box_container('false')"
                                        data-bs-toggle="tooltip" title="Full Width">
                                        <img src="<?= $themePath ?>/assets/images/customizer/full.svg" alt="img"
                                            class="img-fluid">
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-grid">
                                    <button
                                        class="preset-btn btn-img btn <?= $theme['container'] === 'container' ? 'active' : '' ?>"
                                        data-value="true" onclick="change_box_container('true')"
                                        data-bs-toggle="tooltip" title="Fixed Width">
                                        <img src="<?= $themePath ?>/assets/images/customizer/fixed.svg" alt="img"
                                            class="img-fluid">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Reset Layout -->
                <li class="list-group-item">
                    <div class="d-grid">
                        <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- [ Settings Panel ] end -->