/**
 * Loading States Manager
 * 
 * Usage:
 * LoadingStates.show(element);
 * LoadingStates.hide(element);
 * LoadingStates.setButtonLoading(button, 'Loading...');
 */

class LoadingStates {
    static show(element, options = {}) {
        const config = {
            text: 'Loading...',
            spinner: true,
            overlay: false,
            ...options
        };

        if (element._loadingState) {
            this.hide(element);
        }

        const originalContent = element.innerHTML;
        const originalDisabled = element.disabled;
        
        element._loadingState = {
            originalContent,
            originalDisabled
        };

        if (config.overlay) {
            this.addOverlay(element);
        }

        if (config.spinner) {
            element.innerHTML = `
                <span class="d-flex align-items-center">
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    ${config.text}
                </span>
            `;
        } else {
            element.innerHTML = config.text;
        }

        if (element.disabled !== undefined) {
            element.disabled = true;
        }

        element.classList.add('loading');
    }

    static hide(element) {
        if (!element._loadingState) return;

        const { originalContent, originalDisabled } = element._loadingState;
        
        element.innerHTML = originalContent;
        element.disabled = originalDisabled;
        element.classList.remove('loading');
        
        // Remove overlay if exists
        const overlay = element.querySelector('.loading-overlay');
        if (overlay) {
            overlay.remove();
        }

        delete element._loadingState;
    }

    static setButtonLoading(button, text = 'Loading...') {
        this.show(button, { text, spinner: true });
    }

    static setButtonSuccess(button, text = 'Success!') {
        this.show(button, { 
            text: `<i class="ti ti-check me-1"></i> ${text}`,
            spinner: false 
        });
        
        // Auto hide after 2 seconds
        setTimeout(() => {
            this.hide(button);
        }, 2000);
    }

    static setButtonError(button, text = 'Error!') {
        this.show(button, { 
            text: `<i class="ti ti-x me-1"></i> ${text}`,
            spinner: false 
        });
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            this.hide(button);
        }, 3000);
    }

    static addOverlay(element) {
        const overlay = document.createElement('div');
        overlay.className = 'loading-overlay';
        overlay.innerHTML = `
            <div class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;
        
        element.style.position = 'relative';
        element.appendChild(overlay);
    }

    static showPageLoading() {
        const loader = document.createElement('div');
        loader.id = 'page-loader';
        loader.className = 'page-loader';
        loader.innerHTML = `
            <div class="loader-content">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="loader-text">Loading...</div>
            </div>
        `;
        
        document.body.appendChild(loader);
    }

    static hidePageLoading() {
        const loader = document.getElementById('page-loader');
        if (loader) {
            loader.remove();
        }
    }

    static showInlineLoading(container, text = 'Loading...') {
        const loadingEl = document.createElement('div');
        loadingEl.className = 'inline-loading';
        loadingEl.innerHTML = `
            <div class="d-flex align-items-center justify-content-center p-3">
                <div class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></div>
                <span>${text}</span>
            </div>
        `;
        
        container.innerHTML = '';
        container.appendChild(loadingEl);
    }

    static hideInlineLoading(container, content = '') {
        if (content) {
            container.innerHTML = content;
        } else {
            const loadingEl = container.querySelector('.inline-loading');
            if (loadingEl) {
                loadingEl.remove();
            }
        }
    }

    // Enhanced fetch with loading states
    static async fetchWithLoading(url, options = {}, loadingElement = null) {
        if (loadingElement) {
            this.show(loadingElement);
        }

        try {
            const response = await fetch(url, options);
            return await response.json();
        } finally {
            if (loadingElement) {
                this.hide(loadingElement);
            }
        }
    }

    // Form submission with loading
    static async submitFormWithLoading(form, options = {}) {
        const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
        
        if (submitBtn) {
            this.setButtonLoading(submitBtn, options.loadingText || 'Submitting...');
        }

        try {
            const formData = new FormData(form);
            const response = await fetch(options.url || form.action, {
                method: options.method || form.method || 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...options.headers
                },
                body: options.body || JSON.stringify(Object.fromEntries(formData.entries()))
            });

            const result = await response.json();

            if (response.ok) {
                if (submitBtn && options.successText) {
                    this.setButtonSuccess(submitBtn, options.successText);
                }
            } else {
                if (submitBtn && options.errorText) {
                    this.setButtonError(submitBtn, options.errorText);
                }
            }

            return result;
        } catch (error) {
            if (submitBtn && options.errorText) {
                this.setButtonError(submitBtn, options.errorText);
            }
            throw error;
        }
    }
}

// Auto-initialize loading states for common elements
document.addEventListener('DOMContentLoaded', function() {
    // Add loading states to buttons with data-loading attribute
    const loadingButtons = document.querySelectorAll('[data-loading]');
    loadingButtons.forEach(button => {
        button.addEventListener('click', function() {
            LoadingStates.setButtonLoading(this, this.dataset.loading);
        });
    });

    // Add loading states to forms with data-loading attribute
    const loadingForms = document.querySelectorAll('form[data-loading]');
    loadingForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn) {
                LoadingStates.setButtonLoading(submitBtn, this.dataset.loading || 'Submitting...');
            }
        });
    });
});

// Make available globally
window.LoadingStates = LoadingStates;
