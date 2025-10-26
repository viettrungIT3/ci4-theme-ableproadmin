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
                        <p class="text-muted text-sm">Choose light or dark mode</p>
                        <div class="row theme-color theme-layout">
                            <div class="col-4">
                                <div class="d-grid">
                                    <button class="preset-btn btn" data-value="light" onclick="layout_change('light');"
                                        data-bs-toggle="tooltip" title="Light">
                                        <svg class="pc-icon text-warning">
                                            <use xlink:href="#custom-sun-1"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-grid">
                                    <button class="preset-btn btn" data-value="dark" onclick="layout_change('dark');"
                                        data-bs-toggle="tooltip" title="Dark">
                                        <svg class="pc-icon">
                                            <use xlink:href="#custom-moon"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- <div class="col-4">
                                <div class="d-grid">
                                    <button class="preset-btn btn" data-value="auto" onclick="layout_change_default();"
                                        data-bs-toggle="tooltip" title="Auto">
                                        <span class="pc-lay-icon d-flex align-items-center justify-content-center">
                                            <i class="ph-duotone ph-cpu"></i>
                                        </span>
                                    </button>
                                </div>
                            </div> -->
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
                                <button class="preset-btn btn" data-value="true"
                                    onclick="layout_theme_contrast_change('true');" data-bs-toggle="tooltip"
                                    title="True">
                                    <svg class="pc-icon">
                                        <use xlink:href="#custom-mask"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-grid">
                                <button class="preset-btn btn active" data-value="false"
                                    onclick="layout_theme_contrast_change('false');" data-bs-toggle="tooltip"
                                    title="False">
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
                        <a href="#" data-bs-toggle="tooltip" title="Preset-1" data-value="preset-1">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Preset-2" data-value="preset-2">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Preset-3" data-value="preset-3">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Preset-4" data-value="preset-4">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Preset-5" data-value="preset-5">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Preset-6" data-value="preset-6">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Preset-7" data-value="preset-7">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Preset-8" data-value="preset-8">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Preset-9" data-value="preset-9">
                            <i class="ti ti-checks"></i>
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Preset-10" data-value="preset-10">
                            <i class="ti ti-checks"></i>
                        </a>
                    </div>
                </li>

                <!-- Theme Layout -->
                <li class="list-group-item">
                    <h6 class="mb-1">Theme layout</h6>
                    <p class="text-muted text-sm">Choose your layout</p>
                    <div class="theme-main-layout d-flex align-center gap-1 w-100">
                        <a href="#" data-bs-toggle="tooltip" title="Vertical" data-value="vertical">
                            <img src="<?= base_url('themes/able-pro-admin/assets/images/customizer/caption-on.svg') ?>"
                                alt="img" class="img-fluid">
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Horizontal" data-value="horizontal">
                            <img src="<?= base_url('themes/able-pro-admin/assets/images/customizer/horizontal.svg') ?>"
                                alt="img" class="img-fluid">
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Color Header" data-value="color-header">
                            <img src="<?= base_url('themes/able-pro-admin/assets/images/customizer/color-header.svg') ?>"
                                alt="img" class="img-fluid">
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Compact" data-value="compact">
                            <img src="<?= base_url('themes/able-pro-admin/assets/images/customizer/compact.svg') ?>"
                                alt="img" class="img-fluid">
                        </a>
                        <a href="#" data-bs-toggle="tooltip" title="Tab" data-value="tab">
                            <img src="<?= base_url('themes/able-pro-admin/assets/images/customizer/tab.svg') ?>"
                                alt="img" class="img-fluid">
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
                                <button class="preset-btn btn-img btn" data-value="true"
                                    onclick="layout_caption_change('true');" data-bs-toggle="tooltip"
                                    title="Caption Show">
                                    <img src="<?= base_url('themes/able-pro-admin/assets/images/customizer/caption-on.svg') ?>"
                                        alt="img" class="img-fluid">
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-grid">
                                <button class="preset-btn btn-img btn" data-value="false"
                                    onclick="layout_caption_change('false');" data-bs-toggle="tooltip"
                                    title="Caption Hide">
                                    <img src="<?= base_url('themes/able-pro-admin/assets/images/customizer/caption-off.svg') ?>"
                                        alt="img" class="img-fluid">
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
                                    <button class="preset-btn btn-img btn" data-value="false"
                                        onclick="layout_rtl_change('false');" data-bs-toggle="tooltip" title="LTR">
                                        <img src="<?= base_url('themes/able-pro-admin/assets/images/customizer/ltr.svg') ?>"
                                            alt="img" class="img-fluid">
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn-img btn" data-value="true"
                                        onclick="layout_rtl_change('true');" data-bs-toggle="tooltip" title="RTL">
                                        <img src="<?= base_url('themes/able-pro-admin/assets/images/customizer/rtl.svg') ?>"
                                            alt="img" class="img-fluid">
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
                                    <button class="preset-btn btn-img btn" data-value="false"
                                        onclick="change_box_container('false')" data-bs-toggle="tooltip"
                                        title="Full Width">
                                        <img src="<?= base_url('themes/able-pro-admin/assets/images/customizer/full.svg') ?>"
                                            alt="img" class="img-fluid">
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn-img btn" data-value="true"
                                        onclick="change_box_container('true')" data-bs-toggle="tooltip"
                                        title="Fixed Width">
                                        <img src="<?= base_url('themes/able-pro-admin/assets/images/customizer/fixed.svg') ?>"
                                            alt="img" class="img-fluid">
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