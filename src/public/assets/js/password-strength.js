/**
 * Password Strength Validation
 * 
 * Usage:
 * PasswordStrength.init('#password');
 * PasswordStrength.check('password123');
 */

if (!window.PasswordStrength) {
class PasswordStrength {
    static init(selector) {
        const passwordInput = document.querySelector(selector);
        if (!passwordInput) return;

        // Create strength meter
        const strengthMeter = this.createStrengthMeter(passwordInput);
        
        // Add event listener
        passwordInput.addEventListener('input', (e) => {
            this.updateStrengthMeter(e.target.value, strengthMeter);
        });
    }

    static createStrengthMeter(passwordInput) {
        const container = document.createElement('div');
        container.className = 'password-strength-meter mt-2';
        
        const meter = document.createElement('div');
        meter.className = 'strength-meter';
        meter.innerHTML = `
            <div class="strength-bar">
                <div class="strength-fill" style="width: 0%; background-color: #dc3545;"></div>
            </div>
            <div class="strength-text text-muted small mt-1">Enter a password</div>
        `;
        
        container.appendChild(meter);
        passwordInput.parentNode.appendChild(container);
        
        return meter;
    }

    static updateStrengthMeter(password, meter) {
        const strength = this.calculateStrength(password);
        const fill = meter.querySelector('.strength-fill');
        const text = meter.querySelector('.strength-text');
        
        // Update bar
        fill.style.width = strength.score * 25 + '%';
        
        // Update colors and text
        const colors = ['#dc3545', '#fd7e14', '#ffc107', '#28a745'];
        const messages = ['Very Weak', 'Weak', 'Fair', 'Strong'];
        
        fill.style.backgroundColor = colors[strength.score];
        text.textContent = messages[strength.score];
        text.className = `strength-text small mt-1 text-${strength.score < 2 ? 'danger' : strength.score < 3 ? 'warning' : 'success'}`;
        
        // Add feedback
        if (strength.feedback.length > 0) {
            const feedback = meter.querySelector('.strength-feedback') || document.createElement('div');
            feedback.className = 'strength-feedback text-muted small mt-1';
            feedback.innerHTML = strength.feedback.map(f => `<div>• ${f}</div>`).join('');
            
            if (!meter.querySelector('.strength-feedback')) {
                meter.appendChild(feedback);
            }
        } else {
            const feedback = meter.querySelector('.strength-feedback');
            if (feedback) feedback.remove();
        }
    }

    static calculateStrength(password) {
        let score = 0;
        const feedback = [];
        
        if (password.length === 0) {
            return { score: 0, feedback: [] };
        }
        
        // Length check
        if (password.length < 6) {
            feedback.push('Use at least 6 characters');
        } else if (password.length >= 8) {
            score++;
        }
        
        // Character variety checks
        if (/[a-z]/.test(password)) score++;
        else feedback.push('Add lowercase letters');
        
        if (/[A-Z]/.test(password)) score++;
        else feedback.push('Add uppercase letters');
        
        if (/[0-9]/.test(password)) score++;
        else feedback.push('Add numbers');
        
        if (/[^A-Za-z0-9]/.test(password)) score++;
        else feedback.push('Add special characters');
        
        // Common password check
        const commonPasswords = ['password', '123456', 'qwerty', 'admin', 'letmein'];
        if (commonPasswords.includes(password.toLowerCase())) {
            score = Math.max(0, score - 2);
            feedback.push('Avoid common passwords');
        }
        
        return { score: Math.min(3, score), feedback };
    }
}

// Auto-initialize if password inputs exist
document.addEventListener('DOMContentLoaded', function() {
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach(input => {
        if (input.id === 'password' || input.name === 'password') {
            PasswordStrength.init('#' + input.id);
        }
    });
});

// Make available globally
window.PasswordStrength = PasswordStrength;
}
