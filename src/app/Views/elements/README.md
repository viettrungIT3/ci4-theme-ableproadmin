# Reusable Elements

This directory contains reusable UI elements extracted from the Able Pro Admin template. These elements can be used throughout the application to maintain consistency and reduce code duplication.

## Available Elements

### 1. Alert (`alert.php`)
Display contextual feedback messages.

```php
echo view('elements/alert', [
    'type' => 'success', // primary, secondary, success, danger, warning, info, dark
    'message' => 'Operation completed successfully!',
    'dismissible' => true,
    'icon' => 'ti ti-check',
    'title' => 'Success'
]);
```

### 2. Button (`button.php`)
Create styled buttons with icons.

```php
echo view('elements/button', [
    'type' => 'primary',
    'variant' => 'solid', // solid, outline, light, link
    'size' => 'md', // sm, md, lg
    'text' => 'Save Changes',
    'icon' => 'ti ti-device-floppy',
    'icon_position' => 'left',
    'href' => '/save', // optional - makes it a link
    'disabled' => false
]);
```

### 3. Card (`card.php`)
Create content containers.

```php
echo view('elements/card', [
    'title' => 'User Information',
    'subtitle' => 'Personal Details',
    'content' => '<p>Card content here</p>',
    'footer' => '<button class="btn btn-primary">Save</button>',
    'class' => 'mb-3'
]);
```

### 4. Badge (`badge.php`)
Display small status indicators.

```php
echo view('elements/badge', [
    'text' => 'New',
    'type' => 'success',
    'size' => 'md', // sm, md, lg
    'pill' => false,
    'class' => 'me-2'
]);
```

### 5. Modal (`modal.php`)
Create modal dialogs.

```php
echo view('elements/modal', [
    'id' => 'confirmModal',
    'title' => 'Confirm Action',
    'size' => 'md', // sm, md, lg, xl
    'content' => '<p>Are you sure you want to delete this item?</p>',
    'footer' => '<button class="btn btn-danger">Delete</button>',
    'centered' => true
]);
```

### 6. Data Table (`data_table.php`)
Create responsive data tables.

```php
echo view('elements/data_table', [
    'id' => 'usersTable',
    'columns' => [
        ['title' => 'ID', 'data' => 'id', 'sortable' => true],
        ['title' => 'Name', 'data' => 'name', 'sortable' => true],
        ['title' => 'Actions', 'data' => 'actions', 'sortable' => false]
    ],
    'data' => $users,
    'searchable' => true,
    'pagination' => true
]);
```

### 7. Form Input (`form_input.php`)
Create form input fields.

```php
echo view('elements/form_input', [
    'name' => 'username',
    'label' => 'Username',
    'type' => 'text',
    'value' => $user['username'] ?? '',
    'placeholder' => 'Enter username',
    'required' => true,
    'help_text' => 'Enter your username',
    'error' => $validation->getError('username')
]);
```

### 8. Form Select (`form_select.php`)
Create dropdown select fields.

```php
echo view('elements/form_select', [
    'name' => 'status',
    'label' => 'Status',
    'options' => [
        '' => 'Select Status',
        '1' => 'Active',
        '0' => 'Inactive'
    ],
    'value' => $user['status'] ?? '',
    'required' => true,
    'help_text' => 'Select user status'
]);
```

### 9. Breadcrumb (`breadcrumb.php`)
Create navigation breadcrumbs.

```php
echo view('elements/breadcrumb', [
    'items' => [
        ['title' => 'Dashboard', 'url' => base_url()],
        ['title' => 'Users', 'url' => base_url('users')],
        ['title' => 'Create', 'url' => base_url('users/create'), 'active' => true]
    ],
    'class' => 'mb-3'
]);
```

### 10. Spinner (`spinner.php`)
Display loading indicators.

```php
echo view('elements/spinner', [
    'size' => 'md', // sm, md, lg
    'type' => 'border', // border, grow
    'color' => 'primary',
    'text' => 'Loading...',
    'class' => 'text-center'
]);
```

## Usage Examples

### In Controllers
```php
public function index()
{
    $data = [
        'users' => $this->userModel->findAll(),
        'breadcrumb' => [
            ['title' => 'Dashboard', 'url' => base_url()],
            ['title' => 'Users', 'url' => base_url('users'), 'active' => true]
        ]
    ];
    
    return $this->renderAdminView('pages/users/index', $data);
}
```

### In Views
```php
<!-- Breadcrumb -->
<?= view('elements/breadcrumb', ['items' => $breadcrumb]) ?>

<!-- Alert -->
<?= view('elements/alert', [
    'type' => 'success',
    'message' => 'User created successfully!',
    'dismissible' => true
]) ?>

<!-- Card with table -->
<?= view('elements/card', [
    'title' => 'Users List',
    'content' => view('elements/data_table', [
        'id' => 'usersTable',
        'columns' => [
            ['title' => 'ID', 'data' => 'id'],
            ['title' => 'Name', 'data' => 'name'],
            ['title' => 'Email', 'data' => 'email']
        ],
        'data' => $users
    ])
]) ?>
```

## Benefits

1. **Consistency**: All elements follow the same design patterns
2. **Reusability**: Use the same element across multiple pages
3. **Maintainability**: Update styling in one place
4. **Flexibility**: Customize elements with parameters
5. **Documentation**: Clear usage examples for each element

## Adding New Elements

To add a new element:

1. Create a new PHP file in the `elements/` directory
2. Follow the naming convention: `element_name.php`
3. Include proper documentation in the file header
4. Update this README with usage examples
5. Test the element in different contexts
