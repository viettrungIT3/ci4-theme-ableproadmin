<?php
/**
 * Sample Page.
 *
 * This is a sample page demonstrating basic functionality.
 */
$this->extend('layouts/admin');
$this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Sample Page</h5>
            </div>
            <div class="card-body">
                <h3>Welcome to Sample Page</h3>
                <p>This is a sample page demonstrating basic functionality.</p>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card Title</h5>
                                <p class="card-text">This is a sample card content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Another Card</h5>
                                <p class="card-text">Another sample card content.</p>
                                <a href="#" class="btn btn-secondary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
