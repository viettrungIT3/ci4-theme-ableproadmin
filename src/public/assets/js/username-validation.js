/**
 * Username Uniqueness Validation
 * 
 * Usage:
 * UsernameValidation.init('#username');
 * UsernameValidation.check('username123');
 */

class UsernameValidation {
    static init(selector, options = {}) {
        const usernameInput = document.querySelector(selector);
        if (!usernameInput) return;

        const config = {
            debounceDelay: 500,
            minLength: 3,
            apiEndpoint: '/api/v1/users/check-username',
            ...options
        };

        // Create validation indicator
        const indicator = this.createValidationIndicator(usernameInput);
        
        // Add event listener with debounce
        let timeoutId;
        usernameInput.addEventListener('input', (e) => {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
                this.validateUsername(e.target.value, indicator, config);
            }, config.debounceDelay);
        });

        // Store config for later use
        usernameInput._usernameValidation = config;
    }

    static createValidationIndicator(usernameInput) {
        const container = document.createElement('div');
        container.className = 'username-validation mt-1';
        
        const indicator = document.createElement('div');
        indicator.className = 'validation-indicator';
        indicator.innerHTML = `
            <div class="validation-status d-flex align-items-center">
                <i class="validation-icon me-2"></i>
                <span class="validation-text small"></span>
            </div>
        `;
        
        container.appendChild(indicator);
        usernameInput.parentNode.appendChild(container);
        
        return indicator;
    }

    static async validateUsername(username, indicator, config) {
        const statusEl = indicator.querySelector('.validation-status');
        const iconEl = indicator.querySelector('.validation-icon');
        const textEl = indicator.querySelector('.validation-text');
        
        // Reset classes
        statusEl.className = 'validation-status d-flex align-items-center';
        iconEl.className = 'validation-icon me-2';
        
        if (!username || username.length < config.minLength) {
            statusEl.classList.add('text-muted');
            iconEl.classList.add('ti', 'ti-info-circle');
            textEl.textContent = `Enter at least ${config.minLength} characters`;
            return;
        }

        // Show loading state
        statusEl.classList.add('text-info');
        iconEl.classList.add('ti', 'ti-loader-2', 'spinner');
        textEl.textContent = 'Checking availability...';

        try {
            const response = await fetch(`${config.apiEndpoint}?username=${encodeURIComponent(username)}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (response.ok) {
                if (result.available) {
                    statusEl.classList.remove('text-info');
                    statusEl.classList.add('text-success');
                    iconEl.className = 'validation-icon me-2 ti ti-check-circle';
                    textEl.textContent = 'Username is available';
                } else {
                    statusEl.classList.remove('text-info');
                    statusEl.classList.add('text-danger');
                    iconEl.className = 'validation-icon me-2 ti ti-x-circle';
                    textEl.textContent = 'Username is already taken';
                }
            } else {
                throw new Error(result.message || 'Validation failed');
            }
        } catch (error) {
            statusEl.classList.remove('text-info');
            statusEl.classList.add('text-warning');
            iconEl.className = 'validation-icon me-2 ti ti-alert-triangle';
            textEl.textContent = 'Unable to check username';
        }
    }

    static check(username) {
        return new Promise((resolve) => {
            fetch(`/api/v1/users/check-username?username=${encodeURIComponent(username)}`)
                .then(response => response.json())
                .then(result => resolve(result.available))
                .catch(() => resolve(false));
        });
    }
}

// Auto-initialize if username inputs exist
document.addEventListener('DOMContentLoaded', function() {
    const usernameInputs = document.querySelectorAll('input[name="username"], input[id="username"]');
    usernameInputs.forEach(input => {
        UsernameValidation.init('#' + input.id);
    });
});

// Make available globally
window.UsernameValidation = UsernameValidation;
