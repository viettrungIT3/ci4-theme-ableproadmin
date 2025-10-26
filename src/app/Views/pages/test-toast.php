<?php
use App\Helpers\ElementHelper;

// Breadcrumb
echo ElementHelper::breadcrumb([
    ['title' => 'Dashboard', 'url' => base_url()],
    ['title' => 'Test Toast', 'url' => base_url('test-toast'), 'active' => true],
]);
?>

<!-- [ Test Toast ] start -->
<div class="col-sm-12">
    <?= ElementHelper::card(
        '<div class="row">
            <div class="col-md-6">
                <h5>Toast Notifications Demo</h5>
                <p>Click the buttons below to test different toast notifications:</p>
                
                <div class="d-flex flex-column gap-2">
                    ' . ElementHelper::button('Success Toast', [
                    'type' => 'success',
                    'onclick' => 'Toast.success("User created successfully!")',
                ]) . '
                    
                    ' . ElementHelper::button('Error Toast', [
                    'type' => 'danger',
                    'onclick' => 'Toast.error("Something went wrong!")',
                ]) . '
                    
                    ' . ElementHelper::button('Warning Toast', [
                    'type' => 'warning',
                    'onclick' => 'Toast.warning("Please check your input!")',
                ]) . '
                    
                    ' . ElementHelper::button('Info Toast', [
                    'type' => 'info',
                    'onclick' => 'Toast.info("This is an information message")',
                ]) . '
                </div>
            </div>
            
            <div class="col-md-6">
                <h5>Position Options</h5>
                <p>Test different toast positions:</p>
                
                <div class="d-flex flex-column gap-2">
                    ' . ElementHelper::button('Top Center', [
                    'type' => 'primary',
                    'variant' => 'outline',
                    'onclick' => 'Toast.success("Top Center Toast!", {position: "top-center"})',
                ]) . '
                    
                    ' . ElementHelper::button('Top Right', [
                    'type' => 'primary',
                    'variant' => 'outline',
                    'onclick' => 'Toast.success("Top Right Toast!", {position: "top-right"})',
                ]) . '
                    
                    ' . ElementHelper::button('Bottom Right', [
                    'type' => 'primary',
                    'variant' => 'outline',
                    'onclick' => 'Toast.success("Bottom Right Toast!", {position: "bottom-right"})',
                ]) . '
                    
                    ' . ElementHelper::button('Bottom Left', [
                    'type' => 'primary',
                    'variant' => 'outline',
                    'onclick' => 'Toast.success("Bottom Left Toast!", {position: "bottom-left"})',
                ]) . '
                </div>
            </div>
        </div>
        
        <hr>
        
        <div class="row">
            <div class="col-12">
                <h5>Custom Options</h5>
                <p>Test toast with custom duration and title:</p>
                
                <div class="d-flex gap-2">
                    ' . ElementHelper::button('Long Duration (10s)', [
                    'type' => 'secondary',
                    'onclick' => 'Toast.info("This toast will last 10 seconds", {duration: 10000, title: "Long Toast"})',
                ]) . '
                    
                    ' . ElementHelper::button('No Auto Hide', [
                    'type' => 'secondary',
                    'onclick' => 'Toast.warning("This toast will not auto hide", {duration: 0, title: "Persistent Toast"})',
                ]) . '
                </div>
            </div>
        </div>',
        [
            'title' => 'Toast Notification System Test',
        ]
    ) ?>
</div>
<!-- [ Test Toast ] end -->

<!-- Load Simple Toast JS (no Bootstrap dependency) -->
<script src="<?= base_url('assets/js/toast-simple.js') ?>"></script>

<script>
    // Toast test page loaded
    // Toast object available: typeof Toast !== 'undefined'

    // Check if Toast is loaded after a delay
    setTimeout(() => {
        // Toast object after delay: typeof Toast !== 'undefined'
        // Bootstrap available: typeof bootstrap !== 'undefined'
        // Bootstrap Toast available: typeof bootstrap !== 'undefined' && bootstrap.Toast

        if (typeof Toast === 'undefined') {
            console.error('Toast object not found!');
            // Available global objects: Object.keys(window).filter(key => key.includes('Toast') || key.includes('toast'))
        } else {
            // Toast object found! Testing...
            Toast.success('Toast system is working!');
        }
    }, 1000);
</script>