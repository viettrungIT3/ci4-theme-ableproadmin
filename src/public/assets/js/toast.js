/**
 * Toast Notification System
 * 
 * Usage:
 * Toast.success('User created successfully!');
 * Toast.error('Something went wrong!');
 * Toast.warning('Please check your input!');
 * Toast.info('Information message');
 */

class Toast {
    static show(message, type = 'info', options = {}) {
        const defaultOptions = {
            title: this.getTitle(type),
            position: 'top-center',
            duration: 5000,
            dismissible: true
        };
        
        const config = { ...defaultOptions, ...options };
        
        // Create toast element
        const toastId = 'toast-' + Date.now();
        const toastHtml = this.createToastHtml(toastId, message, type, config);
        
        // Add to body
        document.body.insertAdjacentHTML('beforeend', toastHtml);
        
        // Show toast
        const toastElement = document.getElementById(toastId);
        if (toastElement) {
            // Check if Bootstrap is available
            if (typeof bootstrap === 'undefined' || !bootstrap.Toast) {
                console.error('Bootstrap Toast not available!');
                // Fallback: show as regular alert
                alert(`${config.title}: ${message}`);
                toastElement.remove();
                return;
            }
            
            const toast = new bootstrap.Toast(toastElement, {
                autohide: config.duration > 0,
                delay: config.duration
            });
            
            toast.show();
            
            // Remove element after hide
            toastElement.addEventListener('hidden.bs.toast', () => {
                toastElement.remove();
            });
        }
    }
    
    static success(message, options = {}) {
        this.show(message, 'success', options);
    }
    
    static error(message, options = {}) {
        this.show(message, 'error', options);
    }
    
    static warning(message, options = {}) {
        this.show(message, 'warning', options);
    }
    
    static info(message, options = {}) {
        this.show(message, 'info', options);
    }
    
    static getTitle(type) {
        const titles = {
            'success': 'Success!',
            'error': 'Error!',
            'warning': 'Warning!',
            'info': 'Info'
        };
        return titles[type] || 'Info';
    }
    
    static createToastHtml(id, message, type, config) {
        const icons = {
            'success': 'ti ti-check-circle',
            'error': 'ti ti-alert-circle',
            'warning': 'ti ti-alert-triangle',
            'info': 'ti ti-info-circle'
        };
        
        const icon = icons[type] || 'ti ti-info-circle';
        const typeClass = `bg-${type === 'error' ? 'danger' : type}`;
        
        return `
            <div id="${id}" class="toast toast-${config.position} ${typeClass}" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header ${typeClass} text-white">
                    <i class="${icon} me-2"></i>
                    <strong class="me-auto">${config.title}</strong>
                    ${config.dismissible ? '<button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>' : ''}
                </div>
                <div class="toast-body text-white">
                    ${message}
                </div>
            </div>
        `;
    }
}

// Make Toast available globally
window.Toast = Toast;
