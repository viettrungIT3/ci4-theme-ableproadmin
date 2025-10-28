<?php
/**
 * File Upload Component.
 *
 * Renders a file upload input with drag & drop functionality
 *
 * @param string $name Input name attribute
 * @param string $label Label text
 * @param string $help Help text
 * @param bool $required Whether field is required
 * @param bool $disabled Whether field is disabled
 * @param bool $multiple Whether multiple files are allowed
 * @param string $accept Accepted file types (e.g., "image/*", ".pdf,.doc")
 * @param int $maxSize Maximum file size in bytes
 * @param string $size Input size (sm, lg, default)
 * @param string $state Validation state (valid, invalid, default)
 * @param string $feedback Validation feedback message
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 * @param string $id Input ID
 */

// Default values
$name = $name ?? 'file';
$label = $label ?? '';
$help = $help ?? '';
$required = $required ?? false;
$disabled = $disabled ?? false;
$multiple = $multiple ?? false;
$accept = $accept ?? '';
$maxSize = $maxSize ?? 5242880; // 5MB default
$size = $size ?? 'default';
$state = $state ?? 'default';
$feedback = $feedback ?? '';
$class = $class ?? '';
$attributes = $attributes ?? [];
$id = $id ?? 'file_' . uniqid();

// Size classes
$sizeClasses = [
    'sm' => 'form-control-sm',
    'lg' => 'form-control-lg',
    'default' => '',
];

// State classes
$stateClasses = [
    'valid' => 'is-valid',
    'invalid' => 'is-invalid',
    'default' => '',
];

// Build attributes
$inputAttributes = array_merge([
    'id' => $id,
    'name' => $name,
    'type' => 'file',
    'class' => 'form-control ' . $sizeClasses[$size] . ' ' . $stateClasses[$state] . ' ' . $class,
], $attributes);

if ($required) {
    $inputAttributes['required'] = 'required';
}

if ($disabled) {
    $inputAttributes['disabled'] = 'disabled';
}

if ($multiple) {
    $inputAttributes['multiple'] = 'multiple';
}

if (!empty($accept)) {
    $inputAttributes['accept'] = $accept;
}

// Convert attributes array to string
$inputAttributesString = '';
foreach ($inputAttributes as $key => $val) {
    if (is_bool($val)) {
        if ($val) {
            $inputAttributesString .= ' ' . $key;
        }
    } else {
        $inputAttributesString .= ' ' . $key . '="' . esc($val) . '"';
    }
}

// Format file size
if (!function_exists('formatFileSize')) {
    function formatFileSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
?>

<div class="form-group mb-3">
    <?php if (!empty($label)): ?>
        <label for="<?= esc($id) ?>" class="form-label">
            <?= esc($label) ?>
            <?php if ($required): ?>
                <span class="text-danger">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <div class="file-upload-container">
        <div class="file-upload-area" id="<?= esc($id) ?>_dropzone">
            <div class="file-upload-content">
                <i class="ti ti-cloud-upload file-upload-icon"></i>
                <p class="file-upload-text">
                    <span class="file-upload-primary">Click to upload</span> or drag and drop
                </p>
                <?php if (!empty($accept)): ?>
                    <p class="file-upload-secondary"><?= esc($accept) ?></p>
                <?php endif; ?>
                <?php if ($maxSize): ?>
                    <p class="file-upload-secondary">Max size: <?= formatFileSize($maxSize) ?></p>
                <?php endif; ?>
            </div>
            <input<?= $inputAttributesString ?> class="file-upload-input">
        </div>
        
        <div class="file-preview-container" id="<?= esc($id) ?>_preview" style="display: none;">
            <div class="file-preview-list"></div>
        </div>
    </div>

    <?php if (!empty($help)): ?>
        <div class="form-text"><?= esc($help) ?></div>
    <?php endif; ?>

    <?php if (!empty($feedback) && $state === 'invalid'): ?>
        <div class="invalid-feedback"><?= esc($feedback) ?></div>
    <?php elseif (!empty($feedback) && $state === 'valid'): ?>
        <div class="valid-feedback"><?= esc($feedback) ?></div>
    <?php endif; ?>
</div>

<style>
.file-upload-container {
    position: relative;
}

.file-upload-area {
    border: 2px dashed #ced4da;
    border-radius: 0.375rem;
    padding: 2rem;
    text-align: center;
    background-color: #f8f9fa;
    transition: all 0.15s ease-in-out;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.file-upload-area:hover {
    border-color: #86b7fe;
    background-color: #f0f8ff;
}

.file-upload-area.dragover {
    border-color: #0d6efd;
    background-color: #e7f3ff;
    transform: scale(1.02);
}

.file-upload-area.is-valid {
    border-color: #198754;
    background-color: #f0fff4;
}

.file-upload-area.is-invalid {
    border-color: #dc3545;
    background-color: #fff5f5;
}

.file-upload-content {
    pointer-events: none;
}

.file-upload-icon {
    font-size: 3rem;
    color: #6c757d;
    margin-bottom: 1rem;
    display: block;
}

.file-upload-text {
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.file-upload-primary {
    color: #0d6efd;
    font-weight: 500;
}

.file-upload-secondary {
    color: #6c757d;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.file-upload-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.file-preview-container {
    margin-top: 1rem;
}

.file-preview-item {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;
    transition: all 0.15s ease-in-out;
}

.file-preview-item:hover {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.file-preview-icon {
    width: 2.5rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    border-radius: 0.25rem;
    margin-right: 0.75rem;
    font-size: 1.25rem;
    color: #6c757d;
}

.file-preview-info {
    flex: 1;
    min-width: 0;
}

.file-preview-name {
    font-weight: 500;
    color: #212529;
    margin-bottom: 0.25rem;
    word-break: break-word;
}

.file-preview-size {
    font-size: 0.875rem;
    color: #6c757d;
}

.file-preview-remove {
    background: none;
    border: none;
    color: #dc3545;
    font-size: 1.25rem;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 0.25rem;
    transition: background-color 0.15s ease-in-out;
}

.file-preview-remove:hover {
    background-color: #f8d7da;
}

.file-upload-area.form-control-sm {
    padding: 1rem;
}

.file-upload-area.form-control-sm .file-upload-icon {
    font-size: 2rem;
}

.file-upload-area.form-control-lg {
    padding: 3rem;
}

.file-upload-area.form-control-lg .file-upload-icon {
    font-size: 4rem;
}

/* Dark theme support */
[data-pc-theme="dark"] .file-upload-area {
    background-color: #2d2d2d;
    border-color: #404040;
}

[data-pc-theme="dark"] .file-upload-area:hover {
    background-color: #1a1a1a;
    border-color: #86b7fe;
}

[data-pc-theme="dark"] .file-upload-area.dragover {
    background-color: #0d1b2a;
    border-color: #0d6efd;
}

[data-pc-theme="dark"] .file-upload-icon {
    color: #adb5bd;
}

[data-pc-theme="dark"] .file-upload-primary {
    color: #86b7fe;
}

[data-pc-theme="dark"] .file-upload-secondary {
    color: #adb5bd;
}

[data-pc-theme="dark"] .file-preview-item {
    background-color: #1a1a1a;
    border-color: #404040;
}

[data-pc-theme="dark"] .file-preview-icon {
    background-color: #2d2d2d;
    color: #adb5bd;
}

[data-pc-theme="dark"] .file-preview-name {
    color: #e9ecef;
}

[data-pc-theme="dark"] .file-preview-size {
    color: #adb5bd;
}

[data-pc-theme="dark"] .file-preview-remove:hover {
    background-color: #2d1b1b;
}

/* Responsive */
@media (max-width: 768px) {
    .file-upload-area {
        padding: 1.5rem 1rem;
    }
    
    .file-upload-icon {
        font-size: 2.5rem;
    }
    
    .file-preview-item {
        padding: 0.5rem;
    }
    
    .file-preview-icon {
        width: 2rem;
        height: 2rem;
        font-size: 1rem;
        margin-right: 0.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropzone = document.getElementById('<?= esc($id) ?>_dropzone');
    const fileInput = dropzone.querySelector('.file-upload-input');
    const previewContainer = document.getElementById('<?= esc($id) ?>_preview');
    const previewList = previewContainer.querySelector('.file-preview-list');
    
    if (!dropzone || !fileInput || !previewContainer) return;
    
    const maxSize = <?= $maxSize ?>;
    const acceptTypes = '<?= esc($accept) ?>';
    
    // Drag and drop events
    dropzone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropzone.classList.add('dragover');
    });
    
    dropzone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropzone.classList.remove('dragover');
    });
    
    dropzone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropzone.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        handleFiles(files);
    });
    
    // Click to upload
    dropzone.addEventListener('click', function() {
        fileInput.click();
    });
    
    // File input change
    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });
    
    function handleFiles(files) {
        const fileArray = Array.from(files);
        
        fileArray.forEach(file => {
            if (validateFile(file)) {
                addFilePreview(file);
            }
        });
        
        if (previewList.children.length > 0) {
            previewContainer.style.display = 'block';
        }
    }
    
    function validateFile(file) {
        // Check file size
        if (file.size > maxSize) {
            alert(`File "${file.name}" is too large. Maximum size is ${formatFileSize(maxSize)}.`);
            return false;
        }
        
        // Check file type
        if (acceptTypes && !isFileTypeAccepted(file, acceptTypes)) {
            alert(`File "${file.name}" is not an accepted file type.`);
            return false;
        }
        
        return true;
    }
    
    function isFileTypeAccepted(file, acceptTypes) {
        const types = acceptTypes.split(',').map(type => type.trim());
        
        return types.some(type => {
            if (type.startsWith('.')) {
                return file.name.toLowerCase().endsWith(type.toLowerCase());
            } else if (type.includes('/*')) {
                const baseType = type.split('/')[0];
                return file.type.startsWith(baseType);
            } else {
                return file.type === type;
            }
        });
    }
    
    function addFilePreview(file) {
        const previewItem = document.createElement('div');
        previewItem.className = 'file-preview-item';
        
        const icon = getFileIcon(file.type);
        
        previewItem.innerHTML = `
            <div class="file-preview-icon">
                <i class="${icon}"></i>
            </div>
            <div class="file-preview-info">
                <div class="file-preview-name">${file.name}</div>
                <div class="file-preview-size">${formatFileSize(file.size)}</div>
            </div>
            <button type="button" class="file-preview-remove" onclick="removeFilePreview(this)">
                <i class="ti ti-x"></i>
            </button>
        `;
        
        previewList.appendChild(previewItem);
    }
    
    function getFileIcon(fileType) {
        if (fileType.startsWith('image/')) return 'ti ti-photo';
        if (fileType.startsWith('video/')) return 'ti ti-video';
        if (fileType.startsWith('audio/')) return 'ti ti-music';
        if (fileType.includes('pdf')) return 'ti ti-file-text';
        if (fileType.includes('word')) return 'ti ti-file-text';
        if (fileType.includes('excel') || fileType.includes('spreadsheet')) return 'ti ti-file-spreadsheet';
        if (fileType.includes('powerpoint') || fileType.includes('presentation')) return 'ti ti-presentation';
        if (fileType.includes('zip') || fileType.includes('rar')) return 'ti ti-file-zip';
        return 'ti ti-file';
    }
    
    function formatFileSize(bytes) {
        const units = ['B', 'KB', 'MB', 'GB'];
        let size = Math.max(bytes, 0);
        const pow = Math.floor((size ? Math.log(size) : 0) / Math.log(1024));
        const unitPow = Math.min(pow, units.length - 1);
        size = size / Math.pow(1024, unitPow);
        return Math.round(size * 100) / 100 + ' ' + units[unitPow];
    }
    
    // Global function for removing file previews
    window.removeFilePreview = function(button) {
        const previewItem = button.closest('.file-preview-item');
        previewItem.remove();
        
        if (previewList.children.length === 0) {
            previewContainer.style.display = 'none';
        }
    };
});
</script>
