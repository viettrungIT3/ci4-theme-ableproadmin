<?php
/**
 * Dashboard Demo Theme Page.
 *
 * This page demonstrates the dashboard theme with various widgets and components.
 */
$this->extend('layouts/admin');
$this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Dashboard Demo Theme</h5>
                <p class="text-muted mb-0">Demonstrating dashboard widgets and components</p>
            </div>
            <div class="card-body">
                <h3>Welcome to Dashboard Demo</h3>
                <p>This is a demonstration of the dashboard theme with various widgets and components.</p>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statistics Widget</h5>
                                <p class="card-text">Display key metrics and statistics in an attractive format.</p>
                                <a href="<?= base_url('dashboard/demo/form-demo') ?>" class="btn btn-primary">View Form Demo</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Advanced UI Components</h5>
                                <p class="card-text">Showcase advanced UI components like progress bars, tabs, and carousels.</p>
                                <a href="<?= base_url('dashboard/demo/advanced-ui-demo') ?>" class="btn btn-primary">View UI Demo</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Sample Page</h5>
                                <p class="card-text">A simple sample page demonstrating basic functionality.</p>
                                <a href="<?= base_url('dashboard/demo/sample-page') ?>" class="btn btn-secondary">View Sample Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
