# Component Library

A reusable component library for CI4 Theme Able Pro Admin based on Bootstrap 5.

## Available Components

### Buttons
- **Button** (`buttons/button.php`) - Reusable button component with various styles and sizes

### Cards
- **Card** (`cards/card.php`) - Flexible card component with multiple layouts

### Alerts
- **Alert** (`alerts/alert.php`) - Alert component for displaying messages

### Forms
- **Input** (`forms/input.php`) - Form input component with validation states
- **Select** (`forms/select.php`) - Select dropdown component with customizable options
- **Textarea** (`forms/textarea.php`) - Textarea component with character counting
- **Checkbox** (`forms/checkbox.php`) - Checkbox component with custom styling
- **Radio** (`forms/radio.php`) - Radio button group component with multiple layouts
- **File Upload** (`forms/file-upload.php`) - File upload component with drag & drop

### Modals
- **Modal** (`modals/modal.php`) - Modal dialog component

### Navigation
- **Breadcrumb** (`navigation/breadcrumb.php`) - Breadcrumb navigation component
- **Mobile Menu** (`navigation/mobile-menu.php`) - Full-screen overlay mobile menu

### Widgets
- **Statistic** (`widgets/statistic.php`) - Statistical data widget with icons and trends
- **Chart** (`widgets/chart.php`) - Chart widget using Chart.js
- **Data Table** (`widgets/data-table.php`) - Responsive data table with sorting and pagination

## Usage

### Basic Usage

```php
<?= $this->include('components/index') ?>

<?php
// Render a button
renderComponent('buttons', 'button', [
    'text' => 'Click Me',
    'type' => 'primary',
    'size' => 'lg'
]);

// Render a card
renderComponent('cards', 'card', [
    'title' => 'Card Title',
    'content' => 'Card content goes here',
    'variant' => 'primary'
]);

// Render an alert
renderComponent('alerts', 'alert', [
    'message' => 'This is an alert message',
    'type' => 'success',
    'dismissible' => true
]);
?>
```

### Advanced Usage

```php
<?php
// Button with icon
renderComponent('buttons', 'button', [
    'text' => 'Save',
    'type' => 'success',
    'icon' => 'ti ti-check',
    'iconPosition' => 'left',
    'class' => 'me-2'
]);

// Card with image
renderComponent('cards', 'card', [
    'title' => 'Product Card',
    'content' => 'Product description',
    'image' => '/assets/images/product.jpg',
    'imagePosition' => 'top',
    'footer' => '<button class="btn btn-primary">Buy Now</button>'
]);

// Form input with validation
renderComponent('forms', 'input', [
    'name' => 'email',
    'type' => 'email',
    'label' => 'Email Address',
    'placeholder' => 'Enter your email',
    'required' => true,
    'state' => 'valid',
    'feedback' => 'Looks good!'
]);

// Select dropdown
renderComponent('forms', 'select', [
    'name' => 'country',
    'label' => 'Country',
    'options' => [
        'us' => 'United States',
        'uk' => 'United Kingdom',
        'ca' => 'Canada'
    ],
    'placeholder' => 'Select your country',
    'required' => true
]);

// Textarea with character count
renderComponent('forms', 'textarea', [
    'name' => 'message',
    'label' => 'Message',
    'placeholder' => 'Enter your message...',
    'rows' => 4,
    'maxlength' => 500,
    'help' => 'Maximum 500 characters'
]);

// Checkbox
renderComponent('forms', 'checkbox', [
    'name' => 'newsletter',
    'label' => 'Subscribe to newsletter',
    'checked' => true,
    'help' => 'Receive updates about new features'
]);

// Radio buttons
renderComponent('forms', 'radio', [
    'name' => 'plan',
    'label' => 'Choose your plan',
    'options' => [
        'basic' => 'Basic Plan - $9/month',
        'pro' => 'Pro Plan - $29/month',
        'enterprise' => 'Enterprise Plan - $99/month'
    ],
    'value' => 'pro',
    'layout' => 'vertical'
]);

// File upload
renderComponent('forms', 'file-upload', [
    'name' => 'images',
    'label' => 'Upload Images',
    'accept' => 'image/*',
    'multiple' => true,
    'maxSize' => 10485760, // 10MB
    'help' => 'Upload profile pictures or gallery images'
]);
?>
```

## Component Parameters

### Button Component
- `text` - Button text
- `type` - Button type (primary, secondary, success, danger, warning, info, light, dark, link)
- `size` - Button size (sm, lg, default)
- `variant` - Button variant (default, outline, light, link)
- `disabled` - Whether button is disabled
- `icon` - Icon class
- `iconPosition` - Icon position (left, right)
- `class` - Additional CSS classes
- `attributes` - Additional HTML attributes
- `id` - Button ID

### Card Component
- `title` - Card title
- `subtitle` - Card subtitle
- `content` - Card content
- `image` - Card image URL
- `imagePosition` - Image position (top, bottom, overlay)
- `header` - Card header content
- `footer` - Card footer content
- `variant` - Card variant (default, primary, secondary, success, danger, warning, info, light, dark)
- `alignment` - Text alignment (left, center, right)
- `shadow` - Whether to add shadow
- `class` - Additional CSS classes
- `attributes` - Additional HTML attributes
- `id` - Card ID

### Alert Component
- `message` - Alert message
- `type` - Alert type (primary, secondary, success, danger, warning, info, dark)
- `title` - Alert title
- `dismissible` - Whether alert can be dismissed
- `icon` - Icon class
- `class` - Additional CSS classes
- `attributes` - Additional HTML attributes
- `id` - Alert ID

### Input Component
- `name` - Input name
- `type` - Input type (text, email, password, number, tel, url, search, etc.)
- `value` - Input value
- `placeholder` - Input placeholder
- `label` - Input label
- `help` - Help text
- `required` - Whether input is required
- `disabled` - Whether input is disabled
- `readonly` - Whether input is readonly
- `size` - Input size (sm, lg, default)
- `state` - Input state (valid, invalid, default)
- `feedback` - Validation feedback message
- `icon` - Icon class
- `iconPosition` - Icon position (left, right)
- `class` - Additional CSS classes
- `attributes` - Additional HTML attributes
- `id` - Input ID

### Select Component
- `name` - Input name
- `options` - Array of options (value => label)
- `value` - Selected value
- `label` - Label text
- `placeholder` - Placeholder text
- `help` - Help text
- `required` - Whether field is required
- `disabled` - Whether field is disabled
- `multiple` - Whether multiple selection is allowed
- `size` - Select size (sm, lg, default)
- `state` - Validation state (valid, invalid, default)
- `feedback` - Validation feedback message
- `icon` - Icon class
- `iconPosition` - Icon position (left, right)
- `class` - Additional CSS classes
- `attributes` - Additional HTML attributes
- `id` - Input ID

### Textarea Component
- `name` - Input name
- `value` - Textarea value
- `label` - Label text
- `placeholder` - Placeholder text
- `help` - Help text
- `required` - Whether field is required
- `disabled` - Whether field is disabled
- `readonly` - Whether field is readonly
- `rows` - Number of rows
- `cols` - Number of columns
- `maxlength` - Maximum length
- `size` - Textarea size (sm, lg, default)
- `state` - Validation state (valid, invalid, default)
- `feedback` - Validation feedback message
- `class` - Additional CSS classes
- `attributes` - Additional HTML attributes
- `id` - Input ID

### Checkbox Component
- `name` - Input name
- `value` - Checkbox value
- `checked` - Whether checkbox is checked
- `label` - Label text
- `help` - Help text
- `required` - Whether field is required
- `disabled` - Whether field is disabled
- `size` - Checkbox size (sm, lg, default)
- `state` - Validation state (valid, invalid, default)
- `feedback` - Validation feedback message
- `class` - Additional CSS classes
- `attributes` - Additional HTML attributes
- `id` - Input ID

### Radio Component
- `name` - Input name
- `options` - Array of radio options (value => label)
- `value` - Selected value
- `label` - Group label text
- `help` - Help text
- `required` - Whether field is required
- `disabled` - Whether field is disabled
- `size` - Radio size (sm, lg, default)
- `state` - Validation state (valid, invalid, default)
- `feedback` - Validation feedback message
- `layout` - Layout style (vertical, horizontal, inline)
- `class` - Additional CSS classes
- `attributes` - Additional HTML attributes
- `id` - Input ID prefix

### File Upload Component
- `name` - Input name
- `label` - Label text
- `help` - Help text
- `required` - Whether field is required
- `disabled` - Whether field is disabled
- `multiple` - Whether multiple files are allowed
- `accept` - Accepted file types (e.g., "image/*", ".pdf,.doc")
- `maxSize` - Maximum file size in bytes
- `size` - Input size (sm, lg, default)
- `state` - Validation state (valid, invalid, default)
- `feedback` - Validation feedback message
- `class` - Additional CSS classes
- `attributes` - Additional HTML attributes
- `id` - Input ID

### Modal Component
- `id` - Modal ID (required)
- `title` - Modal title
- `content` - Modal content
- `footer` - Modal footer content
- `size` - Modal size (sm, lg, xl, default)
- `centered` - Whether modal is centered
- `scrollable` - Whether modal is scrollable
- `backdrop` - Whether to show backdrop
- `keyboard` - Whether to close on ESC key
- `class` - Additional CSS classes
- `attributes` - Additional HTML attributes

### Breadcrumb Component
- `items` - Array of breadcrumb items
- `separator` - Separator between items
- `class` - Additional CSS classes
- `attributes` - Additional HTML attributes
- `id` - Breadcrumb ID

### Mobile Menu Component
- `menuItems` - Array of menu items
- `user` - User information array
- `brandLogo` - Brand logo path
- `brandUrl` - Brand logo URL

### Statistic Widget
- `title` - Widget title
- `value` - Main value to display
- `subtitle` - Subtitle or description
- `icon` - Icon class or SVG
- `trend` - Trend direction (up, down, neutral)
- `trendValue` - Trend percentage or value
- `color` - Color theme (primary, success, warning, danger, info)
- `class` - Additional CSS classes
- `animated` - Whether to show animated counter

### Chart Widget
- `title` - Chart title
- `type` - Chart type (line, bar, doughnut, pie, area)
- `data` - Chart data
- `options` - Chart options
- `height` - Chart height
- `class` - Additional CSS classes
- `chartId` - Unique chart ID

### Data Table Widget
- `title` - Table title
- `headers` - Table headers array
- `data` - Table data array
- `options` - Table options
- `class` - Additional CSS classes
- `tableId` - Unique table ID

## Examples

### Button Examples
```php
// Primary button
renderComponent('buttons', 'button', ['text' => 'Primary', 'type' => 'primary']);

// Outline button
renderComponent('buttons', 'button', ['text' => 'Outline', 'type' => 'primary', 'variant' => 'outline']);

// Button with icon
renderComponent('buttons', 'button', [
    'text' => 'Save',
    'type' => 'success',
    'icon' => 'ti ti-check',
    'iconPosition' => 'left'
]);
```

### Card Examples
```php
// Basic card
renderComponent('cards', 'card', [
    'title' => 'Card Title',
    'content' => 'Card content goes here'
]);

// Card with image
renderComponent('cards', 'card', [
    'title' => 'Product',
    'content' => 'Product description',
    'image' => '/assets/images/product.jpg',
    'imagePosition' => 'top'
]);

// Colored card
renderComponent('cards', 'card', [
    'title' => 'Success Card',
    'content' => 'This is a success card',
    'variant' => 'success'
]);
```

### Alert Examples
```php
// Basic alert
renderComponent('alerts', 'alert', [
    'message' => 'This is an alert',
    'type' => 'info'
]);

// Dismissible alert
renderComponent('alerts', 'alert', [
    'message' => 'This alert can be dismissed',
    'type' => 'warning',
    'dismissible' => true
]);

// Alert with title
renderComponent('alerts', 'alert', [
    'title' => 'Success!',
    'message' => 'Your action was completed successfully',
    'type' => 'success'
]);
```

### Widget Examples
```php
// Statistic widget
renderComponent('widgets', 'statistic', [
    'title' => 'Total Revenue',
    'value' => '$45,678',
    'subtitle' => 'Last 30 days',
    'icon' => 'ti ti-currency-dollar',
    'trend' => 'up',
    'trendValue' => '+12.5%',
    'color' => 'success'
]);

// Chart widget
renderComponent('widgets', 'chart', [
    'title' => 'Sales Analytics',
    'type' => 'line',
    'data' => [
        'labels' => ['Jan', 'Feb', 'Mar'],
        'datasets' => [
            [
                'label' => 'Sales',
                'data' => [12000, 19000, 15000],
                'borderColor' => '#0d6efd'
            ]
        ]
    ],
    'height' => '400px'
]);

// Data table widget
renderComponent('widgets', 'data-table', [
    'title' => 'Recent Orders',
    'headers' => [
        ['key' => 'id', 'label' => 'Order ID', 'sortable' => true],
        ['key' => 'customer', 'label' => 'Customer', 'sortable' => true]
    ],
    'data' => [
        ['id' => '#12345', 'customer' => 'John Doe'],
        ['id' => '#12346', 'customer' => 'Jane Smith']
    ],
    'options' => [
        'pageSize' => 10,
        'searchable' => true,
        'sortable' => true
    ]
]);
```

## Styling

All components are built with Bootstrap 5 classes and follow the Able Pro Admin theme styling. You can customize components by:

1. Adding custom CSS classes via the `class` parameter
2. Modifying the component files directly
3. Overriding styles in your custom CSS

## Contributing

When adding new components:

1. Create the component file in the appropriate category folder
2. Add the component to the `$componentPaths` array in `index.php`
3. Update this README with component documentation
4. Follow the existing naming conventions and parameter structure

## Dependencies

- Bootstrap 5
- Chart.js (for chart widgets)
- Tabler Icons
- Phosphor Icons
- Feather Icons
- Font Awesome Icons
- Material Icons
