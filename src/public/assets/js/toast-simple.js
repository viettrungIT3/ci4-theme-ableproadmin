/**
 * Simple Toast Notification System (No Bootstrap dependency)
 * 
 * Usage:
 * Toast.success('User created successfully!');
 * Toast.error('Something went wrong!');
 * Toast.warning('Please check your input!');
 * Toast.info('Information message');
 */

if (!window.Toast) {
class Toast {
    static show(message, type = 'info', options = {}) {
        const defaultOptions = {
            title: this.getTitle(type),
            position: 'top-center',
            duration: 5000,
            dismissible: true,
            stack: true,
            maxToasts: 5
        };
        
        const config = { ...defaultOptions, ...options };
        
        // Manage toast stack
        this.manageToastStack(config.position, config.maxToasts);
        
        // Create toast element
        const toastId = 'toast-' + Date.now();
        const toastElement = this.createToastElement(toastId, message, type, config);
        
        // Add to body
        document.body.appendChild(toastElement);
        
        // Show toast with animation
        setTimeout(() => {
            toastElement.classList.add('show');
        }, 10);
        
        // Auto hide
        if (config.duration > 0) {
            setTimeout(() => {
                this.hide(toastElement);
            }, config.duration);
        }
    }
    
    static hide(toastElement) {
        toastElement.classList.remove('show');
        setTimeout(() => {
            if (toastElement.parentNode) {
                toastElement.parentNode.removeChild(toastElement);
            }
        }, 300);
    }

    static manageToastStack(position, maxToasts) {
        const existingToasts = document.querySelectorAll(`.toast-${position}`);
        
        if (existingToasts.length >= maxToasts) {
            // Remove oldest toast
            const oldestToast = existingToasts[0];
            this.hide(oldestToast);
        }
    }

    static clearAll(position = null) {
        const selector = position ? `.toast-${position}` : '.toast';
        const toasts = document.querySelectorAll(selector);
        
        toasts.forEach(toast => {
            this.hide(toast);
        });
    }

    static pauseAll() {
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach(toast => {
            toast.classList.add('paused');
        });
    }

    static resumeAll() {
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach(toast => {
            toast.classList.remove('paused');
        });
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
    
    static createToastElement(id, message, type, config) {
        const icons = {
            'success': 'ti ti-check-circle',
            'error': 'ti ti-alert-circle',
            'warning': 'ti ti-alert-triangle',
            'info': 'ti ti-info-circle'
        };
        
        const icon = icons[type] || 'ti ti-info-circle';
        const typeClass = `bg-${type === 'error' ? 'danger' : type}`;
        
        const toast = document.createElement('div');
        toast.id = id;
        toast.className = `toast toast-${config.position} ${typeClass}`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="toast-header ${typeClass} text-white">
                <i class="${icon} me-2"></i>
                <strong class="me-auto">${config.title}</strong>
                ${config.dismissible ? '<button type="button" class="btn-close btn-close-white" onclick="Toast.hide(this.closest(\'.toast\'))" aria-label="Close"></button>' : ''}
            </div>
            <div class="toast-body text-white">
                ${message}
            </div>
        `;
        
        return toast;
    }
}

// Make Toast available globally
window.Toast = Toast;
}

// Simple Toast system loaded
