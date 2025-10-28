/**
 * Form Validator
 * 
 * Usage:
 * FormValidator.init('#myForm', rules);
 * FormValidator.validate(formData, rules);
 */

if (!window.FormValidator) {
class FormValidator {
    static init(formSelector, rules = {}) {
        const form = document.querySelector(formSelector);
        if (!form) return;

        // Store rules
        form._validationRules = rules;

        // Add real-time validation
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', () => this.validateField(input, rules));
            input.addEventListener('input', () => this.clearFieldError(input));
        });

        // Add form submit validation
        form.addEventListener('submit', (e) => {
            if (!this.validateForm(form, rules)) {
                e.preventDefault();
            }
        });
    }

    static validateForm(form, rules = {}) {
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        
        const errors = this.validate(data, rules);
        
        if (errors) {
            this.showFormErrors(form, errors);
            return false;
        }
        
        this.clearFormErrors(form);
        return true;
    }

    static validateField(input, rules = {}) {
        const fieldName = input.name;
        const value = input.value;
        const rule = rules[fieldName];
        
        if (!rule) return true;

        const error = this.validateFieldValue(value, rule, fieldName);
        
        if (error) {
            this.showFieldError(input, error);
            return false;
        } else {
            this.clearFieldError(input);
            return true;
        }
    }

    static validate(data, rules = {}) {
        const errors = {};
        
        for (const [field, value] of Object.entries(data)) {
            const rule = rules[field];
            if (!rule) continue;

            const error = this.validateFieldValue(value, rule, field);
            if (error) {
                errors[field] = error;
            }
        }

        return Object.keys(errors).length > 0 ? errors : null;
    }

    static validateFieldValue(value, rule, fieldName) {
        // Required validation
        if (rule.required && (!value || value.trim() === '')) {
            return `${rule.label || fieldName} is required`;
        }

        // Skip other validations if field is empty and not required
        if (!value || value.trim() === '') {
            return null;
        }

        // Email validation
        if (rule.type === 'email' && !this.isValidEmail(value)) {
            return 'Please enter a valid email address';
        }

        // Min length validation
        if (rule.minLength && value.length < rule.minLength) {
            return `${rule.label || fieldName} must be at least ${rule.minLength} characters`;
        }

        // Max length validation
        if (rule.maxLength && value.length > rule.maxLength) {
            return `${rule.label || fieldName} must not exceed ${rule.maxLength} characters`;
        }

        // Pattern validation
        if (rule.pattern && !rule.pattern.test(value)) {
            return rule.message || `${rule.label || fieldName} format is invalid`;
        }

        // Custom validation
        if (rule.custom && typeof rule.custom === 'function') {
            const customError = rule.custom(value);
            if (customError) {
                return customError;
            }
        }

        return null;
    }

    static showFormErrors(form, errors) {
        // Clear existing errors
        this.clearFormErrors(form);

        // Show new errors
        for (const [field, error] of Object.entries(errors)) {
            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
                this.showFieldError(input, error);
            }
        }

        // Focus first error field
        const firstErrorField = form.querySelector('.is-invalid');
        if (firstErrorField) {
            firstErrorField.focus();
        }
    }

    static showFieldError(input, error) {
        // Add error class
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');

        // Create or update error message
        let errorElement = input.parentNode.querySelector('.invalid-feedback');
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'invalid-feedback';
            input.parentNode.appendChild(errorElement);
        }
        errorElement.textContent = error;
    }

    static clearFieldError(input) {
        input.classList.remove('is-invalid');
        
        const errorElement = input.parentNode.querySelector('.invalid-feedback');
        if (errorElement) {
            errorElement.remove();
        }
    }

    static clearFormErrors(form) {
        const errorInputs = form.querySelectorAll('.is-invalid');
        errorInputs.forEach(input => {
            this.clearFieldError(input);
        });
    }

    static isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Predefined validation rules
    static getRules(type) {
        const rules = {
            user: {
                username: {
                    required: true,
                    minLength: 3,
                    maxLength: 50,
                    pattern: /^[a-zA-Z0-9_]+$/,
                    message: 'Username can only contain letters, numbers, and underscores',
                    label: 'Username'
                },
                email: {
                    required: true,
                    type: 'email',
                    label: 'Email'
                },
                first_name: {
                    required: true,
                    minLength: 2,
                    maxLength: 50,
                    label: 'First Name'
                },
                last_name: {
                    required: true,
                    minLength: 2,
                    maxLength: 50,
                    label: 'Last Name'
                },
                password: {
                    required: true,
                    minLength: 6,
                    maxLength: 100,
                    label: 'Password'
                }
            }
        };

        return rules[type] || {};
    }
}

// Auto-initialize common forms
document.addEventListener('DOMContentLoaded', function() {
    // User create form
    const createForm = document.getElementById('createUserForm');
    if (createForm) {
        FormValidator.init('#createUserForm', FormValidator.getRules('user'));
    }

    // User edit form
    const editForm = document.getElementById('editUserForm');
    if (editForm) {
        const editRules = FormValidator.getRules('user');
        // Make password optional for edit
        editRules.password.required = false;
        FormValidator.init('#editUserForm', editRules);
    }
});

// Make available globally
window.FormValidator = FormValidator;
}
