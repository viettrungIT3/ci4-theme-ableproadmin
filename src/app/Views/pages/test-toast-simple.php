<?php
use App\Helpers\ElementHelper;

// Breadcrumb
echo ElementHelper::breadcrumb([
    ['title' => 'Dashboard', 'url' => base_url()],
    ['title' => 'Test Toast Simple', 'url' => base_url('test-toast-simple'), 'active' => true]
]);
?>

<!-- [ Test Toast Simple ] start -->
<div class="col-sm-12">
    <?= ElementHelper::card(
        '<div class="row">
            <div class="col-12">
                <h5>Simple Toast Test</h5>
                <p>Testing toast without Bootstrap dependency:</p>
                
                <div class="d-flex flex-column gap-2">
                    <button class="btn btn-success" onclick="testToast()">Test Toast</button>
                    <button class="btn btn-primary" onclick="Toast.success(\'Success message!\')">Success Toast</button>
                    <button class="btn btn-danger" onclick="Toast.error(\'Error message!\')">Error Toast</button>
                    <button class="btn btn-warning" onclick="Toast.warning(\'Warning message!\')">Warning Toast</button>
                    <button class="btn btn-info" onclick="Toast.info(\'Info message!\')">Info Toast</button>
                </div>
            </div>
        </div>',
        [
            'title' => 'Simple Toast Test'
        ]
    ) ?>
</div>
<!-- [ Test Toast Simple ] end -->

<script>
    console.log('Simple toast test page loaded');
    console.log('Toast object available:', typeof Toast !== 'undefined');

    function testToast() {
        console.log('Testing toast...');
        if (typeof Toast !== 'undefined') {
            Toast.success('Toast is working!');
        } else {
            alert('Toast object not found!');
        }
    }

    // Test immediately
    setTimeout(() => {
        console.log('Delayed test - Toast available:', typeof Toast !== 'undefined');
        if (typeof Toast !== 'undefined') {
            Toast.info('Auto test message');
        }
    }, 1000);
</script>