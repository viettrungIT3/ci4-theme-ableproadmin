/**
 * Global Error Handler
 * 
 * Usage:
 * ErrorHandler.handle(error, context);
 * ErrorHandler.showNetworkError();
 * ErrorHandler.showValidationError(errors);
 */

if (!window.ErrorHandler) {
class ErrorHandler {
    static handle(error, context = '') {
        console.error('Error in', context, ':', error);
        
        if (error.name === 'TypeError' && error.message.includes('fetch')) {
            this.showNetworkError();
        } else if (error.name === 'ValidationError') {
            this.showValidationError(error.errors);
        } else {
            this.showGenericError(error.message || 'An unexpected error occurred');
        }
    }

    static showNetworkError() {
        if (typeof Toast !== 'undefined') {
            Toast.error('Network error. Please check your connection and try again.', {
                duration: 8000,
                position: 'top-center'
            });
        } else {
            alert('ERROR: Network error. Please check your connection and try again.');
        }
    }

    static showValidationError(errors) {
        let errorMessage = 'Please fix the following errors:';
        
        if (Array.isArray(errors)) {
            errorMessage += '\n• ' + errors.join('\n• ');
        } else if (typeof errors === 'object') {
            errorMessage += '\n• ' + Object.values(errors).join('\n• ');
        } else {
            errorMessage += '\n• ' + errors;
        }

        if (typeof Toast !== 'undefined') {
            Toast.error(errorMessage, {
                duration: 10000,
                position: 'top-center'
            });
        } else {
            alert('VALIDATION ERROR:\n' + errorMessage);
        }
    }

    static showGenericError(message) {
        if (typeof Toast !== 'undefined') {
            Toast.error(message, {
                duration: 6000,
                position: 'top-center'
            });
        } else {
            alert('ERROR: ' + message);
        }
    }

    static showSuccess(message) {
        if (typeof Toast !== 'undefined') {
            Toast.success(message, {
                duration: 4000,
                position: 'top-center'
            });
        } else {
            alert('SUCCESS: ' + message);
        }
    }

    static showInfo(message) {
        if (typeof Toast !== 'undefined') {
            Toast.info(message, {
                duration: 4000,
                position: 'top-center'
            });
        } else {
            alert('INFO: ' + message);
        }
    }

    static showWarning(message) {
        if (typeof Toast !== 'undefined') {
            Toast.warning(message, {
                duration: 6000,
                position: 'top-center'
            });
        } else {
            alert('WARNING: ' + message);
        }
    }

    // Enhanced fetch wrapper with error handling
    static async fetchWithErrorHandling(url, options = {}) {
        try {
            const response = await fetch(url, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...options.headers
                },
                ...options
            });

            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.message || `HTTP ${response.status}: ${response.statusText}`);
            }

            return await response.json();
        } catch (error) {
            this.handle(error, `fetch ${url}`);
            throw error;
        }
    }

    // Form validation helper
    static validateForm(formData, rules = {}) {
        const errors = {};
        
        for (const [field, value] of Object.entries(formData)) {
            const rule = rules[field];
            if (!rule) continue;

            // Required validation
            if (rule.required && (!value || value.trim() === '')) {
                errors[field] = `${rule.label || field} is required`;
                continue;
            }

            // Email validation
            if (rule.type === 'email' && value && !this.isValidEmail(value)) {
                errors[field] = 'Please enter a valid email address';
                continue;
            }

            // Min length validation
            if (rule.minLength && value && value.length < rule.minLength) {
                errors[field] = `${rule.label || field} must be at least ${rule.minLength} characters`;
                continue;
            }

            // Max length validation
            if (rule.maxLength && value && value.length > rule.maxLength) {
                errors[field] = `${rule.label || field} must not exceed ${rule.maxLength} characters`;
                continue;
            }

            // Pattern validation
            if (rule.pattern && value && !rule.pattern.test(value)) {
                errors[field] = rule.message || `${rule.label || field} format is invalid`;
                continue;
            }
        }

        return Object.keys(errors).length > 0 ? errors : null;
    }

    static isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Retry mechanism for failed requests
    static async retryRequest(requestFn, maxRetries = 3, delay = 1000) {
        for (let i = 0; i < maxRetries; i++) {
            try {
                return await requestFn();
            } catch (error) {
                if (i === maxRetries - 1) {
                    throw error;
                }
                await new Promise(resolve => setTimeout(resolve, delay * (i + 1)));
            }
        }
    }
}

// Global error handler for unhandled promises
window.addEventListener('unhandledrejection', function(event) {
    ErrorHandler.handle(event.reason, 'Unhandled Promise Rejection');
    event.preventDefault();
});

// Global error handler for JavaScript errors
window.addEventListener('error', function(event) {
    ErrorHandler.handle(event.error, 'JavaScript Error');
});

// Make available globally
window.ErrorHandler = ErrorHandler;
}
