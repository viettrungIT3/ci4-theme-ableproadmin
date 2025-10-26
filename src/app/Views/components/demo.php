<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Component Library Demo</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Components</a></li>
                        <li class="breadcrumb-item active">Demo</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Buttons Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Buttons</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Basic Buttons</h6>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <?= $this->include('components/index') ?>
                                <?php
                                renderComponent('buttons', 'button', ['text' => 'Primary', 'type' => 'primary']);
                                renderComponent('buttons', 'button', ['text' => 'Secondary', 'type' => 'secondary']);
                                renderComponent('buttons', 'button', ['text' => 'Success', 'type' => 'success']);
                                renderComponent('buttons', 'button', ['text' => 'Danger', 'type' => 'danger']);
                                renderComponent('buttons', 'button', ['text' => 'Warning', 'type' => 'warning']);
                                renderComponent('buttons', 'button', ['text' => 'Info', 'type' => 'info']);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Outline Buttons</h6>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <?php
                                renderComponent('buttons', 'button', ['text' => 'Primary', 'type' => 'primary', 'variant' => 'outline']);
                                renderComponent('buttons', 'button', ['text' => 'Secondary', 'type' => 'secondary', 'variant' => 'outline']);
                                renderComponent('buttons', 'button', ['text' => 'Success', 'type' => 'success', 'variant' => 'outline']);
                                renderComponent('buttons', 'button', ['text' => 'Danger', 'type' => 'danger', 'variant' => 'outline']);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Button Sizes</h6>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <?php
                                renderComponent('buttons', 'button', ['text' => 'Small', 'type' => 'primary', 'size' => 'sm']);
                                renderComponent('buttons', 'button', ['text' => 'Default', 'type' => 'primary']);
                                renderComponent('buttons', 'button', ['text' => 'Large', 'type' => 'primary', 'size' => 'lg']);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Buttons with Icons</h6>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <?php
                                renderComponent('buttons', 'button', ['text' => 'Save', 'type' => 'success', 'icon' => 'ti ti-check', 'iconPosition' => 'left']);
                                renderComponent('buttons', 'button', ['text' => 'Delete', 'type' => 'danger', 'icon' => 'ti ti-trash', 'iconPosition' => 'right']);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Cards</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h6>Basic Card</h6>
                            <?php
                            renderComponent('cards', 'card', [
                                'title' => 'Card Title',
                                'subtitle' => 'Card subtitle',
                                'content' => 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
                            ]);
                            ?>
                        </div>
                        <div class="col-md-4">
                            <h6>Card with Image</h6>
                            <?php
                            renderComponent('cards', 'card', [
                                'title' => 'Card with Image',
                                'content' => 'This card has an image at the top.',
                                'image' => '/assets/images/light-box/l3.jpg',
                                'imagePosition' => 'top'
                            ]);
                            ?>
                        </div>
                        <div class="col-md-4">
                            <h6>Colored Card</h6>
                            <?php
                            renderComponent('cards', 'card', [
                                'title' => 'Success Card',
                                'content' => 'This is a success colored card.',
                                'variant' => 'success'
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Alerts</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Basic Alerts</h6>
                            <?php
                            renderComponent('alerts', 'alert', ['message' => 'A simple primary alert!', 'type' => 'primary']);
                            renderComponent('alerts', 'alert', ['message' => 'A simple success alert!', 'type' => 'success']);
                            renderComponent('alerts', 'alert', ['message' => 'A simple warning alert!', 'type' => 'warning']);
                            renderComponent('alerts', 'alert', ['message' => 'A simple danger alert!', 'type' => 'danger']);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <h6>Dismissible Alerts</h6>
                            <?php
                            renderComponent('alerts', 'alert', ['message' => 'This alert can be dismissed!', 'type' => 'info', 'dismissible' => true]);
                            renderComponent('alerts', 'alert', ['message' => 'Another dismissible alert!', 'type' => 'warning', 'dismissible' => true]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forms Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Inputs</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Basic Inputs</h6>
                            <?php
                            renderComponent('forms', 'input', [
                                'name' => 'username',
                                'label' => 'Username',
                                'placeholder' => 'Enter username',
                                'required' => true
                            ]);
                            renderComponent('forms', 'input', [
                                'name' => 'email',
                                'type' => 'email',
                                'label' => 'Email',
                                'placeholder' => 'Enter email',
                                'required' => true
                            ]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <h6>Input with Validation</h6>
                            <?php
                            renderComponent('forms', 'input', [
                                'name' => 'valid_input',
                                'label' => 'Valid Input',
                                'value' => 'Valid value',
                                'state' => 'valid',
                                'feedback' => 'Looks good!'
                            ]);
                            renderComponent('forms', 'input', [
                                'name' => 'invalid_input',
                                'label' => 'Invalid Input',
                                'value' => 'Invalid value',
                                'state' => 'invalid',
                                'feedback' => 'Please provide a valid value.'
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Breadcrumb</h5>
                </div>
                <div class="card-body">
                    <?php
                    renderComponent('navigation', 'breadcrumb', [
                        'items' => [
                            ['text' => 'Home', 'url' => '/'],
                            ['text' => 'Components', 'url' => '/components'],
                            ['text' => 'Demo', 'url' => '#']
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Modal</h5>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#demoModal">
                        Open Modal
                    </button>
                    
                    <?php
                    renderComponent('modals', 'modal', [
                        'id' => 'demoModal',
                        'title' => 'Demo Modal',
                        'content' => 'This is a demo modal content. You can put any content here.',
                        'footer' => '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><button type="button" class="btn btn-primary">Save changes</button>'
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
